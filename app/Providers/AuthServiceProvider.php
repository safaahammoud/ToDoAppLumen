<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

/**
 * In this code, I will check that the user have a valid API key and then append the verified userid to the request.
 * If the API is not verified, it will return Unauthorized.
 */

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {

            if ($request->header('Authorization')) {

                $key = explode(' ',$request->header('Authorization'));
                $user = User::where('api_key', $key[1])->first();

                if(!empty($user)){
                    $request->request->add(['userid' => $user->id]);
                }

                return $user;
            }
        });
    }
}
