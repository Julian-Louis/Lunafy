<?php

namespace App\Http\Controllers;

use Auth;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Input;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PPConnectionException;
use PayPal\Rest\ApiContext;
use Redirect;
use URL;


class PaymentController extends Controller
{
    private $_api_context;


    public function __construct()
    {
        $this->middleware('auth');


        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }


    public function payWithpaypal(Request $request)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $user = Auth::user();

        $item_1->setName('Ajout de crédit #' . $user->id)
        ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Ajout de crédit' . $request->get('userid'));

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status'))/
        ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));



        try {

            $payment->create($this->_api_context);

        } catch (PPConnectionException $ex) {

            if (Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/add-balance');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/add-balance');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }


        Session::put('paypal_payment_id', $payment->getId());
        Session::put('amount', $request->get('amount'));

        if (isset($redirect_url)) {


            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/add-balance');

    }

    public function getPaymentStatus()
    {
        $user = Auth::user();

        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('/add-balance');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));


        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Le paiement a bien été effectué');
            $user->balance += Session::get('amount');
            $user->save();


            $invoices = InvoicesController::make($user, Session::get('amount'), 'paid', "Ajout de crédit");


            return Redirect::to('/invoices/' . $invoices);

        }

        \Session::put('error', 'Le paiements a échoué. ');
        return Redirect::to('/add-balance');

    }

}
