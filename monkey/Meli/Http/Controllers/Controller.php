<?php

namespace Monkeycorp\Meli\Http\Controllers;

use MercadoLibre\Endpoints\Api;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }
}