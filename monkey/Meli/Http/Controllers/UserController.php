<?php

namespace Monkeycorp\Meli\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Monkeycorp\Meli\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function me(Request $request)
    {
        $me = $request->get('api')
            ->users()
            ->getMe();

        return view('meli.me', [
            'me' => $me
        ]);
    }
}
