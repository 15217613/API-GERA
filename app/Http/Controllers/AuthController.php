<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use DB;
use Hash;
use Http;
use Cache;
use Spatie\Permission\Models\Role;
use Validator;
use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

use App\Services\EmailService;

class AuthController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * auth.login
     *
     * Obtiene un token de acceso para el usuario
     *
     * PERSONAL ACCESS TOKEN:
     * {
     *   "grant_type": "personal",
     *   "email": "email@example.com",
     *   "password": "password-here"
     * }
     *
     * PASSWORD GRANT:
     * {
     *   "grant_type": "password",
     *   "client_id": "client-id-here",
     *   "client_secret": "client-secret-here",
     *   "email": "email@example.com",
     *   "password": "password-here"
     * }
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request)
    {
        try {
            // Valida grant_type
            $grantType = $request->input('grant_type', 'personal'); // Por defecto: personal

            if (!in_array($grantType, ['personal', 'password'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid grant_type. Use: personal or password',
                    'errors' => [
                        'grant_type' => ['The grant_type must be: personal or password']
                    ]
                ], 422);
            }

            // Obtenemos las reglas de validación
            $rules = $request->rules();

            // Validamos los datos
            $validator = Validator::make($request->all(), $rules, [
                'email.required' => 'Email is required',
                'email.email' => 'Email must be valid',
                'password.required' => 'Password is required',
                'client_id.required' => 'Client ID is required for grant_type password',
                'client_secret.required' => 'Client secret is required for grant_type password',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Buscar y validar usuario
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid credentials'
                ], 401);
            }

            // Verificar que el usuario esté activo
            if (!$user->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your account has been deactivated'
                ], 403);
            }

            // Generar token según grant_type
            if ($grantType === 'personal') {
                return $this->handlePersonalGrant($user, $request);
            } else {
                return $this->handlePasswordGrant($user, $request);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing login request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Manejar Personal Access Token Grant
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handlePersonalGrant(User $user, Request $request)
    {
        try {
            // Crear Personal Access Token
            $tokenResult = $user->createToken('Personal Access Token');
            $accessToken = $tokenResult->accessToken;

            // Actualizar último login
            $user->update(['last_login_at' => now()]);

            // Obtener roles y permisos
            $roles = $user->getRoleNames();
            $permissions = $user->getAllPermissions()->pluck('name');

            return response()->json([
                'success' => true,
                'message' => 'Successful login',
                'data' => [
                    'grant_type' => 'personal',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'is_active' => $user->is_active,
                        'roles' => $roles,
                        'permissions' => $permissions,
                        'last_login_at' => $user->last_login_at
                    ],
                    'access_token' => $accessToken,
                    'token_type' => 'Bearer',
                    // Personal access tokens no tienen refresh token
                ]
            ], 200);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Manejar Password Grant con OAuth2
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function handlePasswordGrant(User $user, Request $request)
    {
        try {
            // Validar que el cliente exista y NO esté revocado
            $client = Client::where('id', $request->client_id)
                ->where('revoked', false)
                ->first();

            if (!$client) {
                return response()->json([
                    'success' => false,
                    'message' => 'Client not found or revoked'
                ], 401);
            }

            // Verificar el client_secret
            if (!Hash::check($request->client_secret, $client->secret)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Client credentials are invalid'
                ], 401);
            }

            // Verificar que el cliente soporte password grant (Passport con UUIDs)
            if (!in_array('password', $client->grant_types)) {
                return response()->json([
                    'success' => false,
                    'message' => 'This client does not support password grant_type',
                    'debug' => [
                        'client_id' => $client->id,
                        'grant_types_soportados' => $client->grant_types
                    ]
                ], 403);
            }

            // Hacer request interno a /oauth/token de Passport
            $response = Http::asForm()->post(url('/oauth/token'), [
                'grant_type' => 'password',
                'client_id' => $request->client_id,
                'client_secret' => $request->client_secret,
                'username' => $request->email,
                'password' => $request->password,
                'scope' => '*',
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al generar token OAuth',
                    'error' => $response->json()
                ], $response->status());
            }

            $tokenData = $response->json();

            // Actualizar último login
            $user->update(['last_login_at' => now()]);

            // Obtener roles y permisos
            $roles = $user->getRoleNames();
            $permissions = $user->getAllPermissions()->pluck('name');

            return response()->json([
                'success' => true,
                'message' => 'Successful login',
                'data' => [
                    'grant_type' => 'password',
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'is_active' => $user->is_active,
                        'roles' => $roles,
                        'permissions' => $permissions,
                        'last_login_at' => $user->last_login_at
                    ],
                    'access_token' => $tokenData['access_token'],
                    'refresh_token' => $tokenData['refresh_token'],
                    'token_type' => $tokenData['token_type'],
                    'expires_in' => $tokenData['expires_in'],
                ]
            ], 200);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * auth.refresh
     *
     * Refresh Token - Renovar access token usando refresh token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'refresh_token' => 'required|string',
                'client_id' => 'required|string',
                'client_secret' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Buscar refresh token
            $refreshToken = $this->refreshTokenRepository->find($request->refresh_token);

            if (!$refreshToken || $refreshToken->revoked) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or revoked refresh token'
                ], 401);
            }

            // Verificar expiración
            if ($refreshToken->expires_at < now()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Refresh token has expired'
                ], 401);
            }

            // Obtener el access token original
            $oldToken = $this->tokenRepository->find($refreshToken->access_token_id);

            if (!$oldToken) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access token not found'
                ], 404);
            }

            // Validar cliente
            $client = Client::where('id', $request->client_id)
                ->where('revoked', false)
                ->first();

            if (!$client || $client->id !== $oldToken->client_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid client'
                ], 401);
            }

            // Verificar client_secret
            if (!Hash::check($request->client_secret, $client->secret)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid client credentials'
                ], 401);
            }

            // Revocar tokens antiguos
            $this->tokenRepository->revokeAccessToken($oldToken->id);
            $this->refreshTokenRepository->revokeRefreshToken($refreshToken->id);

            // Crear nuevos tokens
            $expiresAt = new DateTimeImmutable();
            $expiresAt = $expiresAt->add(new \DateInterval('PT1H')); // 1 hora

            $newToken = $this->tokenRepository->create([
                'id' => Str::uuid()->toString(),
                'user_id' => $oldToken->user_id,
                'client_id' => $client->id,
                'scopes' => $oldToken->scopes,
                'revoked' => false,
                'expires_at' => $expiresAt,
            ]);

            $refreshTokenExpiresAt = new DateTimeImmutable();
            $refreshTokenExpiresAt = $refreshTokenExpiresAt->add(new \DateInterval('P30D')); // 30 días

            $newRefreshToken = $this->refreshTokenRepository->create([
                'id' => Str::random(40),
                'access_token_id' => $newToken->id,
                'revoked' => false,
                'expires_at' => $refreshTokenExpiresAt,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Token refreshed successfully',
                'data' => [
                    'access_token' => $newToken->id,
                    'refresh_token' => $newRefreshToken->id,
                    'token_type' => 'Bearer',
                    'expires_in' => 3600,
                ]
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error refreshing token',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * auth.register
     *
     * Registrar un nuevo usuario
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $request)
    {
        // Usar transacción para asegurar que todo se ejecute correctamente
        DB::beginTransaction();

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active ?? true,
            ]);

            // Si se proporciona el rol
            if ($request->has('role') && $request->role) {
                // Verificar que el rol existe
                $roleExists = Role::where('name', $request->role)->exists();

                // Si el rol no existe, se retorna un error
                if (!$roleExists) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'message' => "El rol '{$request->role}' no existe"
                    ], 422);
                }

                // Asignar rol al usuario
                $user->assignRole($request->role);
            } else {
                // Si no se proporciona rol, asigna rol por defecto 'User'
                $user->assignRole('User');
            }

            // Recargar relaciones para incluir en la respuesta
            $user->load('roles', 'permissions');

            // Crear Personal Access Token
            $tokenResult = $user->createToken('Personal Access Token');
            $accessToken = $tokenResult->accessToken;

            // Actualizar último login
            $user->update(['last_login_at' => now()]);

            // Confirmar transacción
            DB::commit();

            return UserResource::make($user)
                ->additional([
                    'success' => true,
                    'message' => 'Usuario creado exitosamente',
                    'data' => [
                        'access_token' => $accessToken
                    ]
                ])
                ->response()
                ->setStatusCode(201);

        } catch (Exception $e) {
            // Revertir cambios si hay error
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Error al crear usuario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * auth.logout
     *
     * Logout del usuario
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

            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada exitosamente'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar sesión',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * auth.me
     *
     * Obtener información del usuario autenticado
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

            return response()->json([
                'success' => true,
                'data' => [
                    new UserResource($user),
                ]
            ], 200);

        } catch (Exception $e) {
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

        } catch (Exception $e) {
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

            return response()->json([
                'success' => true,
                'message' => 'Contraseña actualizada exitosamente. Inicia sesión nuevamente.'
            ], 200);

        } catch (Exception $e) {
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
            $resetToken = Str::random(64);

            // Guardar token en cache (válido por 1 hora)
            Cache::put(
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

            return response()->json([
                'success' => true,
                'message' => 'Si el correo existe en nuestro sistema, recibirás instrucciones de restablecimiento'
            ], 200);

        } catch (Exception $e) {
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
            $userId = Cache::get("password_reset_{$request->token}");

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
            Cache::forget("password_reset_{$request->token}");

            return response()->json([
                'success' => true,
                'message' => 'Contraseña restablecida exitosamente. Inicia sesión con tu nueva contraseña.'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al restablecer contraseña',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
