<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Services;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Session;


class Order extends Controller
{


    //
    function index(Products $products, Services $services, Request $request)
    {


        $domain = Str::lower($request->get('domainname'));

        if (!isset($domain)) {

            Session::put('error', 'Veuillez saisir un nom de domaine');
            return Redirect::to('/order');

        }

        if (!preg_match('/^(?!\-)(?:(?:[a-zA-Z\d][a-zA-Z\d\-]{0,61})?[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/', $domain)) {

            Session::put('error', 'Veuillez saisir un nom de domaine valide');
            return Redirect::to('/order');
        }

        $user = Auth::user();


        $price = $products->price;
        $package = $products->billing_name;
        $stock = $products->stock;
        $balance = $user->balance;


        if ($price > $balance) {
            Session::put('error', "Vous n'avez pas assez de crédit.");
            return Redirect::to('/order');

        }
        if ($products->name == "FY-FREE") {
            $ohoho = Services::where([
                'customer_id' => $user->id,
                'product_id' => 1
            ])->get();

            if ($ohoho->count() >= 1) {
                Session::put('error', "Vous avez déjà un hébergement gratuit.");
                return Redirect::to('/order');
            }


        }

        if (isset($stock) && $stock == 0) {

            Session::put('error', "Il n'y as plus de stock.");
            return Redirect::to('/order');
        } else {

            $user->balance -= $products->price;
            $user->save();


            $invoices = InvoicesController::make($user, $products->price, 'paid', $products->name);

            $carbon = Carbon::now();
            $password = '*!' . Str::random(10) . '*' . Str::random(8) . '!@';
            $passwordplesk = '*!' . Str::random(10) . '*' . Str::random(8) . '!@';

            Services::create([
                'customer_id' => $user->id,
                'status' => "active",
                'product_id' => $products->id,
                'hostname' => $domain,
                'password' => $password,
                'nodes' => 'Storm',
                'register_date' => $carbon->toDateTimeString(),
                'end_date' => $carbon->addMonth()->toDateTimeString()
            ]);

            $data['id'] = $user->id;
            $data['first_name'] = $user->first_name;
            $data['last_name'] = $user->last_name;
            $data['username'] = Str::lower($user->last_name . $user->first_name . $user->id);
            $data['email'] = $user->email;
            $data['password'] = $password;
            $data['passwordplesk'] = $passwordplesk;
            $data['hostname'] = $domain;
            $data['billing_name'] = $package;


            PleskAPI::createUser($data);


            return Redirect::to('/invoice/' . $invoices);

        }


    }
}
