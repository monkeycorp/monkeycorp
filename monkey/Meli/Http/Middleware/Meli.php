<?php

namespace Monkeycorp\Meli\Http\Middleware;

use Closure;
use Carbon\Carbon;
use MercadoLibre\Authentication\Auth;
use Illuminate\Support\Facades\Session;
use Monkeycorp\Meli\Repositories\MeliRepository;

/**
 * Class Meli
 * @package Monkeycorp\Meli\Http\Middleware
 */
class Meli
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var MeliRepository
     */
    protected $meli;

    /**
     * Meli constructor.
     * @param MeliRepository $meli
     */
    public function __construct(MeliRepository $meli)
    {
        $this->meli = $meli;
    }

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
            return response()->redirectToRoute('meli.login');
        }

        $this->session = (object) session()->get('meli');

        if (! $this->isTokenAvailable()) {
            return response()->redirectToRoute('meli.login');
        }

        $credentials = $this->getCredentials();
        $auth = $this->meli->createAuth(
            $credentials['clientId'],
            $credentials['clientSecret'],
            $credentials['site'],
            $credentials['options']
        );

        app()->instance(Auth::class, $auth);

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
     * Get Credentials to create Auth
     *
     * @return array
     */
    private function getCredentials(): array
    {
        return [
            'clientId' => env('MELI_CLIENT_ID'),
            'clientSecret' => env('MELI_CLIENT_SECRET'),
            'site' => env('MELI_SITE'),
            'options' => [
                'redirectUri' => env('MELI_REDIRECT_URI'),
                'accessToken' => $this->session->accessToken,
                'refreshToken' => $this->session->refreshToken,
                'userId' => $this->session->userId
            ]
        ];
    }
}
