<?php

namespace App\Http\Controllers;

use Log;
use Hash;
use Validator;
use App\Models\User;
use Illuminate\Http\Request;

use App\Services\EmailService;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Login de usuario
     *
     * POST /api/auth/login
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        try {
            // Validar datos de entrada
            $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string', 'min:8'],
                //'client_id' => ['required', 'string'],
                //'client_secret' => ['required', 'string'],
            ]);

            // Obtenemos los datos por email
            $user = User::where('email', $request->email)->firstOrFail();

            // Validamos la contraseña
            if (Hash::check($request->password, $user->password)) {
                //$token = $user->createToken('API Access Token');

                return response()->json([
                    'success' => true,
                    'message' => 'Login exitoso',
                    'data' => [
                        'user' => UserResource::make($user),
                        'roles' => $user->getRoleNames() ?? [],
                        'permissions' => $user->getAllPermissions()->pluck('name') ?? [],
                        //'token' => $token->plainTextToken
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'These credentials do not match our records.'
                ], 404);
            }
        } catch (\Exception $e) {
            Log::error('Error en login: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al iniciar sesión',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Registrar un nuevo usuario
     *
     * POST /api/auth/register
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            // Retornar errores de validación
            if ($request->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $request->errors()
                ], 422);
            }

            // Crear nuevo usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->address,
            ]);

            // Asignar rol por defecto (user)
            if ($user && method_exists($user, 'assignRole')) {
                $user->assignRole('user');
            }

            // Enviar correo de bienvenida
            $this->emailService->sendBladeMail(
                $user->email,
                'Bienvenido a ' . config('app.name'),
                'emails.welcome',
                ['user' => $user],
                [
                    'from' => [
                        'email' => config('mail.from.address'),
                        'name' => config('app.name')
                    ]
                ]
            );

            Log::info("Nuevo usuario registrado: {$user->email}");

            return response()->json([
                'success' => true,
                'message' => 'Usuario registrado exitosamente. Por favor, verifica tu correo electrónico.',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'created_at' => $user->created_at
                ]
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error en registro de usuario: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al registrar el usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout del usuario
     *
     * POST /api/auth/logout
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            // Revocar el token actual
            $user = $request->user();
            $user->token()->revoke();

            Log::info("Usuario {$user->email} cerró sesión");

            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada exitosamente'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error en logout: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar sesión',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener información del usuario autenticado
     *
     * GET /api/auth/me
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autenticado'
                ], 401);
            }

            $roles = $user->getRoleNames();
            $permissions = $user->getPermissionsViaRoles()->pluck('name');

            return response()->json([
                'user' => $user,
                'roles' => $roles,
                'permissions' => $permissions,
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error al obtener información del usuario autenticado: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al obtener información del usuario autenticado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar información del usuario autenticado
     *
     * PUT /api/auth/update-profile
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autenticado'
                ], 401);
            }

            // Validar datos
            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|required|string|max:255',
                'phone' => 'sometimes|nullable|string|max:20',
                'address' => 'sometimes|nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Actualizar usuario
            $user->update($request->only('name', 'phone', 'address'));

            Log::info("Usuario {$user->email} actualizó su perfil");

            return response()->json([
                'success' => true,
                'message' => 'Perfil actualizado exitosamente',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'address' => $user->address,
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error al actualizar perfil: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar perfil',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cambiar contraseña del usuario autenticado
     *
     * POST /api/auth/change-password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No autenticado'
                ], 401);
            }

            // Validar datos
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Verificar contraseña actual
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'La contraseña actual es incorrecta'
                ], 401);
            }

            // Actualizar contraseña
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            // Revocar todos los tokens anteriores
            $user->tokens()->delete();

            Log::info("Usuario {$user->email} cambió su contraseña");

            return response()->json([
                'success' => true,
                'message' => 'Contraseña actualizada exitosamente. Inicia sesión nuevamente.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error al cambiar contraseña: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al cambiar contraseña',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Solicitar restablecimiento de contraseña
     *
     * POST /api/auth/forgot-password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        try {
            // Validar email
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Buscar usuario
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                // Por seguridad, no revelamos si el usuario existe o no
                return response()->json([
                    'success' => true,
                    'message' => 'Si el correo existe en nuestro sistema, recibirás instrucciones de restablecimiento'
                ], 200);
            }

            // Generar token de restablecimiento
            $resetToken = \Illuminate\Support\Str::random(64);

            // Guardar token en cache (válido por 1 hora)
            \Illuminate\Support\Facades\Cache::put(
                "password_reset_{$resetToken}",
                $user->id,
                \Carbon\Carbon::now()->addHour()
            );

            // Enviar correo
            $this->emailService->sendMarkdownMail(
                $user->email,
                'Restablecer tu contraseña',
                'emails.password-reset',
                [
                    'user' => $user,
                    'resetUrl' => url("/api/auth/reset-password/{$resetToken}")
                ],
                [
                    'from' => [
                        'email' => config('mail.from.address'),
                        'name' => config('app.name')
                    ]
                ]
            );

            Log::info("Solicitud de restablecimiento de contraseña para: {$user->email}");

            return response()->json([
                'success' => true,
                'message' => 'Si el correo existe en nuestro sistema, recibirás instrucciones de restablecimiento'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error en olvido de contraseña: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al procesar solicitud',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restablecer contraseña con token
     *
     * POST /api/auth/reset-password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        try {
            // Validar datos
            $validator = Validator::make($request->all(), [
                'token' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error en la validación de datos',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Verificar token
            $userId = \Illuminate\Support\Facades\Cache::get("password_reset_{$request->token}");

            if (!$userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'El token de restablecimiento es inválido o ha expirado'
                ], 401);
            }

            // Buscar usuario
            $user = User::find($userId);

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ], 404);
            }

            // Actualizar contraseña
            $user->update([
                'password' => Hash::make($request->password)
            ]);

            // Revocar todos los tokens
            $user->tokens()->delete();

            // Eliminar token de cache
            \Illuminate\Support\Facades\Cache::forget("password_reset_{$request->token}");

            Log::info("Contraseña restablecida para: {$user->email}");

            return response()->json([
                'success' => true,
                'message' => 'Contraseña restablecida exitosamente. Inicia sesión con tu nueva contraseña.'
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error en restablecimiento de contraseña: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al restablecer contraseña',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
