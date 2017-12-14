<?php

namespace Monkeycorp\Meli\Repositories;

use MercadoLibre\Authentication\Auth;
use MercadoLibre\Endpoints\Api;

/**
 * Class MeliRepository
 * @package Monkeycorp\Meli\Repositories
 */
class MeliRepository
{
    /**
     * @return Api
     */
    public function api(): Api
    {
        return app()->make(Api::class, [
            'auth' => app()->make(Auth::class)
        ]);
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $site
     * @param array $options
     * @return Auth
     */
    public function createAuth(
        string $clientId,
        string $clientSecret,
        string $site,
        array $options = []
    ) {
        return new Auth($clientId, $clientSecret, $site, $options);
    }
}