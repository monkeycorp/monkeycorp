<?php

namespace Monkeycorp\Meli\Http\Middleware;

use Closure;
use Carbon\Carbon;
use MercadoLibre\Authentication\Auth;
use Illuminate\Support\Facades\Session;
use MercadoLibre\Endpoints\Api;

class Meli
{
    /**
     * @var Session
     */
    private $session;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! session()->exists('meli')) {
            return response()->redirectToRoute('LoginMercadoLibre');
        }

        $this->session = (object) session()->get('meli');

        if (! $this->isTokenAvailable()) {
            return response()->redirectToRoute('LoginMercadoLibre');
        }

        $auth = $this->generateAuth();
        $api = $this->makeApi($auth);

        $request->attributes->add(['api' => $api]);

        return $next($request);
    }

    /**
     * @return bool
     */
    private function isTokenAvailable(): bool
    {
        return $this->session->tokenExpiresAt > Carbon::now();
    }

    /**
     * @return Auth
     */
    private function generateAuth(): Auth
    {
        return new Auth(
            env('MELI_CLIENT_ID'),
            env('MELI_CLIENT_SECRET'),
            env('MELI_SITE'), [
                'redirectUri' => env('MELI_REDIRECT_URI'),
                'accessToken' => $this->session->accessToken,
                'refreshToken' => $this->session->refreshToken,
                'userId' => $this->session->userId
            ]
        );
    }

    /**
     * @param Auth $auth
     * @return Api
     */
    protected function makeApi(Auth $auth): Api
    {
        return new Api($auth);
    }
}
