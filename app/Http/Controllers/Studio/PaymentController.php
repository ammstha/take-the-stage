<?php

namespace App\Http\Controllers\Studio;

use App\EventDateTime;
use App\Http\Controllers\Controller;
use App\PerformerEntry;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;


class PaymentController extends Controller
{
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);


    }

    public function payWithpaypal(Request $request)
    {
            $competionDetails= $request->get('competitionDetails');
            Session::put('competionDetails', $competionDetails);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Item 1')/** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));

        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));


        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('studio.status'))/** Specify return URL **/
        ->setCancelUrl(URL::route('studio.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
//            dd('amrit');
        }
        \Session::put('error', 'Unknown error occurred');
        return redirect()->back();
    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        $competionDetails=Session::get('competionDetails');
//        dd($competionDetails);
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {


            \Session::put('error', 'Payment failed');
            return redirect()->back();
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {

            $performerEntries=PerformerEntry::where('status', '=', '0')->get();
            foreach($performerEntries as $performerEntry){
                $performerEntry->status=1;
                $performerEntry->save();
            }



            foreach($competionDetails as   $key => $value){
                $newarray[$value['id']][$key] = $value;
            }


            foreach($newarray as $competiondetails){

                foreach ($competiondetails as $competiondetail){
                    //get one competition detail

                    $events=EventDateTime::where('competition_details_id',$competiondetail['id'])->get();
                    foreach ($events as $event) {
                        //while negative

                        while ($event->remainingTime >= 5) {
                            $remainTimeFirst = $event->remainingTime;
                            if($competiondetail['division'] == "Solo"){
                                $minus= 4;
                            }
                            if($competiondetail['division'] == "Duo/Trio"){
                                $minus= 4;
                            }
                            if($competiondetail['division'] == "Small Group"){
                                $minus= 4;
                            }
                            if($competiondetail['division'] == "Large Group"){
                                $minus= 5;
                            }
                            if($competiondetail['division'] == "Line"){
                                $minus= 6;
                            }

                            $remainTimeAfter = $remainTimeFirst - $minus;
                            if ($competiondetail['exceed']) {
                                $remainTimeAfter = $remainTimeFirst - $minus - 2 ;
                            }

                            $event->update(['remainingTime' => $remainTimeAfter]);
                            break;
                        }
                        break;
                    }
                }
            }


            \Session::put('success', 'Payment success');
            return redirect()->route('studio.performerEntry.index');
        }
        \Session::put('error', 'Payment failed');

        return redirect()->route('studio.performerEntry.index');
    }
}

