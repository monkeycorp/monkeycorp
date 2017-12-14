<?php

namespace Monkeycorp\Meli\Http\Controllers;

use App\Http\Controllers\Controller;
use Monkeycorp\Meli\Repositories\MeliRepository;

/**
 * Class UserController
 * @package Monkeycorp\Meli\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('meli');
    }

    /**
     * @param MeliRepository $meli
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function me(MeliRepository $meli)
    {
        $me = $meli->api()->users()->getMe();

        return view('meli.me', [
            'me' => $me
        ]);
    }
}
