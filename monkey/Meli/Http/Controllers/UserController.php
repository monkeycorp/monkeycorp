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
        $userId = $meli->auth()->getUserId();

        $me = $meli->api()->users()->getMe();
        $payments = $meli->api()->users()->getAcceptedPaymentMethods($userId);
        $address = $meli->api()->users()->getAddresses();
        $listingTypes = $meli->api()->users()->getAvailableListingTypes();
        $brands = $meli->api()->users()->getBrands($userId);

        return view('meli.users.me', [
            'me' => $me,
            'payments' => $payments,
            'address' => $address,
            'listingTypes' => $listingTypes,
            'brands' => $brands
        ]);
    }

    public function showUpdateMe(MeliRepository $meli)
    {
        $me = $meli->api()->users()->getMe();

        return view('meli.users.updateMe', [
            'me' => $me
        ]);
    }
}
