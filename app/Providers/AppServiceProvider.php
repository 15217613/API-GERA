<?php

namespace App\Providers;

use Carbon\CarbonInterval;
use Dedoc\Scramble\Scramble;
use Laravel\Passport\Passport;
use Illuminate\Support\ServiceProvider;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Deshabilitar rutas de Passport (Habilitar si se usa grant_type password)
        // Passport::ignoreRoutes();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Habilitar el grant_type password
        Passport::enablePasswordGrant();

        // Expiracion del token personal
        Passport::personalAccessTokensExpireIn(CarbonInterval::days(1));

        // Expiracion del token password
        Passport::tokensExpireIn(CarbonInterval::days(1));

        // Expiracion del refresh token
        Passport::refreshTokensExpireIn(CarbonInterval::days(30));

        // Configurar la seguridad de la documentacion con bearer
        /*
        Scramble::configure()
        ->withDocumentTransformers(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer') // Agregar seguridad a la documentacion con bearer

                // SecurityScheme::apiKey('query', 'api_token'); // Agregar seguridad a la documentacion con api_token
                // SecurityScheme::http('bearer', 'JWT'); // Agregar seguridad a la documentacion con JWT
                // SecurityScheme::http('basic'); // Agregar seguridad a la documentacion con basic
                // SecurityScheme::oauth2()
                // ->flow('authorizationCode', function (OAuthFlow $flow) {
                //     $flow
                //         ->authorizationUrl(config('app.url').'/oauth/authorize')
                //         ->tokenUrl(config('app.url').'/oauth/token')
                //         ->addScope('*', 'all');
                // }); // Agregar seguridad a la documentacion con oauth2
            );
        });
        */
    }
}
