<?php

namespace Monkeycorp\Meli\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Monkeycorp\Meli\Repositories\MeliRepository;
use Monkeycorp\Meli\Http\Requests\Users\UpdateMeRequest;

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
     * @return View
     */
    public function me(MeliRepository $meli): View
    {
        $userId = $meli->auth()->getUserId();
        $users = $meli->api()->users();

        $data = [
            'me' => $users->getMe(),
            'payments' => $users->getAcceptedPaymentMethods($userId),
            'address' => $users->getAddresses(),
            'listingTypes' => $users->getAvailableListingTypes(),
            'brands' => $users->getBrands($userId)
        ];

        return view('meli.users.me', $data);
    }

    /**
     * @param MeliRepository $meli
     * @return View
     */
    public function editMe(MeliRepository $meli): View
    {
        $me = $meli->api()->users()->getMe();

        return view('meli.users.updateMe', [
            'me' => $me
        ]);
    }

    /**
     * @param UpdateMeRequest $request
     * @param MeliRepository $meli
     * @return View
     */
    public function updateMe(UpdateMeRequest $request, MeliRepository $meli)
    {
        $users = $meli->api()->users();
        $update = $users->updateMe(
            $request->except('_token')
        );
        
        return view('meli.users.updateMe', [
            'status' => $users->getLastHttpCode(),
            'result' => $update,
            'me' => $users->getMe()
        ]);
    }
}
