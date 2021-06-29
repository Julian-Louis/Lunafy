<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class GreetingController extends Controller
{
    public static function say_hello()
    {

        $carbon = Carbon::now();

        $hour = $carbon->hour;

        if ($hour > 0 && $hour < 6) {
            return "Bonne nuit";
        } elseif ($hour > 6 && $hour < 11) {
            return "Bonjour";
        } elseif ($hour > 11 && $hour < 14) {
            return "Bonne apétit";
        } elseif ($hour > 14 && $hour < 18) {
            return "Bonne après midi";
        } else {
            return "Bonsoir";
        }
    }
}
