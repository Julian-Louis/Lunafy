<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use nickurt\PleskXml\Api\Plesk;

class CustomersController extends Controller
{
    //
    public function getIndex(Plesk $plesk)
    {
        $customers = $plesk->customers()->all();

        //
    }
}
