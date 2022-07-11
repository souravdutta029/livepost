<?php

namespace App;

use App\Services\Geolocation\Geolocation;
use App\Services\Geolocation\GeolocationFacade;

class Playground
{
    public function __construct()
    {
        $result = GeolocationFacade::search('a');
        dump ($result);
    }
}
