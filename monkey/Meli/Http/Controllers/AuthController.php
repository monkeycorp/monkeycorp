<?php

namespace Monkeycorp\Meli\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use MercadoLibre\Authentication\Auth;
use Monkeycorp\Meli\Http\Requests\AuthRequest;
use Monkeycorp\Meli\Repositories\MeliRepository;

/**
 * Class AuthController
 * @package Monkeycorp\Meli\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @var Auth
     */
    private $auth;

    /**
     * @var MeliRepository
     */
    protected $meli;

    /**
     * AuthController constructor.
     * @param MeliRepository $meli
     */
    public function __construct(MeliRepository $meli)
    {
        $this->meli = $meli;

        $this->auth = $this->meli->createAuth(
            env('MELI_CLIENT_ID'),
            env('MELI_CLIENT_SECRET'),
            env('MELI_SITE'), [
                'redirectUri' => env('MELI_REDIRECT_URI')
            ]
        );
    }

    /**
     * Get Link to Auth on MercadoLibre - Authentication
     * @return View
     */
    public function index(): View
    {
        session()->remove('meli');

        return view('meli.index', [
            'authLink' => $this->auth->getAuthUrl()
        ]);
    }

    /**
     * @param AuthRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function auth(AuthRequest $request): RedirectResponse
    {
        $code = $request->get('code');
        $this->auth->authorize($code);

        session()->put('meli', [
            'accessToken' => $this->auth->getAccessToken(),
            'refreshToken' => $this->auth->getRefreshToken(),
            'site' => $this->auth->getSite(),
            'tokenExpiresIn' => $this->auth->getAccessTokenExpiresIn(),
            'userId' => $this->auth->getUserId(),
            'tokenExpiresAt' => $this->tokenExpiresAt(
                $this->auth->getAccessTokenExpiresIn()
            )
        ]);

        return redirect('/mercado-libre/users/me');
    }

    /**
     * Datetime when expires token
     *
     * @param int $seconds
     * @return Carbon
     */
    protected function tokenExpiresAt(int $seconds): Carbon
    {
        $now = Carbon::now();

        return $now->addSeconds($seconds);
    }
}
