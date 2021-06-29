<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;

class InvoicesController extends Controller
{
    //

    public static function make($user, $price, $status, $name)
    {


        $invoices = Invoices::insertGetId([
            'customer_id' => $user->id,
            'price' => $price,
            'status' => $status,
            'product_name' => $name,
        ]);

        Notification::send($user, new InvoicePaid($user->id));

        return $invoices;


    }

}
