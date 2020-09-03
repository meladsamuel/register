<?php

namespace shfretak\controllers;

use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;
use CoinbaseCommerce\Resources\Checkout;
use CoinbaseCommerce\Webhook;
use shfretak\lib\Back;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\PaymentChargeModel;
use shfretak\models\PaymentCheckoutModel;
use shfretak\models\PaymentNetworkModel;
use shfretak\models\UsersModel;

class PaymentController extends AbstractController
{
    use validate;
    use InputFilter;
    use Helper;
    use Back;
    protected array $_actionRole = [
        'amount' => 'req|num',
        'cryptoCurrency' => 'req|alpha' //TODO : FIX IT
    ];


    public function defaultAction()
    {
        var_dump($this->session->u);
    }

    public function cryptoCurrencyAction()
    {

        if (isset($this->session->checkout_time) && ((time() - $this->session->checkout_time) / 60 <= 60)) $this->redirect('/payment/payNow');
        $this->language->load('template/common');
        $this->language->load('payment/cryptoCurrency');

        $apiClientObj = ApiClient::init('750ae083-a073-4add-b279-804a1d945308');
        $apiClientObj->setTimeout(3);

        if (isset($_POST['amount']) && isset($_POST['cryptoCurrency']) && $this->isValid($this->_actionRole, $_POST)) {
            $this->session->paymentType = $this->filterString($_POST['cryptoCurrency']);
            $this->session->checkout_time = $time = time();
            $username = $this->session->u->user_name;
            $name = sha1(time() . $username);
            $amount = $this->filterFloat($_POST['amount']);

            $Checkout = new Checkout();
            $Checkout->name = "checkout__$name";
            $Checkout->description = "checkout for  $username  and created at  $time";
            $Checkout->local_price = ['amount' => $amount, 'currency' => 'USD'];
            $Checkout->pricing_type = 'fixed_price';
            $Checkout->requested_info = ['email'];
            try {
                $Checkout->save();
            } catch (\Exception $exception) {
                $this->massenger->add('Enable to create charge. Error: ' . $exception->getMessage(), Massenger::APP_MESSAGE_ERROR);
            }
            if ($Checkout->id) {
                $check = new PaymentCheckoutModel();
                $check->checkout_id = $Checkout->id;
                $check->checkout_name = $Checkout->name;
                $check->checkout_description = $Checkout->description;
                $check->checkout_pricing_type = $Checkout->pricing_type;
                $check->checkout_local_price_amount = $Checkout->local_price['amount'];
                if ($check->save(false))
                    $this->massenger->add('Successfully created new checkout with id: ' . $Checkout->id);

                $chargeObj = new Charge();
                $chargeObj->name = "charge_$name";
                $chargeObj->local_price = ['amount' => $amount, 'currency' => 'USD'];
                $chargeObj->metadata = ['username' => $username, 'checkout' => $Checkout->id];
                $chargeObj->pricing_type = 'fixed_price';
                try {
                    $chargeObj->save();
                } catch (\Exception $e) {
                    $this->massenger->add('Enable to create charge. Error: ' . $e->getMessage(), Massenger::APP_MESSAGE_ERROR);
                }

                if ($chargeObj->id) {
                    $charge = new PaymentChargeModel();
                    $charge->charge_id = $chargeObj->id;
                    $charge->charge_name = $chargeObj->name;
                    $charge->charge_user_id = $this->session->u->user_id;
                    $charge->charge_created_at = date('Y-m-d H:i:s', strtotime($chargeObj->created_at));
                    $charge->charge_expires_at =  date('Y-m-d H:i:s', strtotime($chargeObj->expires_at));
                    $charge->charge_addresses_bitcoin = $chargeObj->addresses['bitcoin'];
                    $charge->charge_addresses_ethereum = $chargeObj->addresses['ethereum'];
                    $charge->charge_addresses_litecoin = $chargeObj->addresses['litecoin'];
                    $charge->charge_addresses_bitcoincash = $chargeObj->addresses['bitcoincash'];
                    $charge->charge_addresses_usdc = $chargeObj->addresses['usdc'];
                    $charge->charge_checkout_id = $Checkout->id;

                    if ($charge->save(false)) {
                        $this->massenger->add("Successfully created new charge with id: $chargeObj->id");
                        $this->session->chargeId = $chargeObj->id;
                    }
                }
            }

            $this->redirect('/payment/payNow');
        }
        $this->backHelper($this);
        $this->_template->injectHeaderResource('selector', CSS . 'selector.css', 'back');
        $this->_template->injectFooterResource('selector', JS . 'selector.js', 'back');
        $this->_view();
    }

    public function payNowAction()
    {
        if (!isset($this->session->chargeId)) $this->redirect('/payment/cryptoCurrency');
        $apiClientObj = ApiClient::init('750ae083-a073-4add-b279-804a1d945308');
        $apiClientObj->setTimeout(3);

        try {
            $charge = Charge::retrieve($this->session->chargeId);
            $this->_data['charge'] = $charge;
            setcookie('cryptoCurrency', $charge->expires_at, time() + 3600); // expire after one day of creation

        } catch (\Exception $exception) {
            $this->massenger->add('Enable to retrieve charge. Error: ' . $exception->getMessage());
        }
        $charge = PaymentChargeModel::getByPK($this->session->chargeId);
        $this->language->load('payment/payNow');
        $this->backHelper($this);
        $this->_template->injectFooterResource('cryptoCurrency', JS . 'cryptoCurrencyTime.js', 'back');
        $this->_view();
    }

    public function serverAction()
    {
        $secret = '750ae083-a073-4add-b279-804a1d945308';
        $headerName = 'X-Cc-Webhook-Signature';
        $headers = getallheaders();
        $signraturHeader = isset($headers[$headerName]) ? $headers[$headerName] : null;
        $payload = trim(file_get_contents('php://input'));

        try {
            $event = Webhook::buildEvent($payload, $signraturHeader, $secret);
            http_response_code(200);
            file_put_contents('C:\Users\hp\Desktop\php\php.txt', $payload);
            $oldData1 = file_get_contents('C:\Users\hp\Desktop\php\log1.txt');
            $oldData2 = file_get_contents('C:\Users\hp\Desktop\php\log2.txt');
            file_put_contents('C:\Users\hp\Desktop\php\log1.txt', $oldData1 . "\n\n" . $payload);
            file_put_contents('C:\Users\hp\Desktop\php\log2.txt', $oldData2 . "\n\n" . $payload);
            if ($event->type == 'charge:pending') {
                $payNetwork = new PaymentNetworkModel();
                $payNetwork->charge_id = $event->data->id . '=';
                $payNetwork->charge_network = $event->data->payments[0]['network'];
                $payNetwork->charge_transaction_id = $event->data->payments[0]['transaction_id'];
                $payNetwork->charge_value_local = $event->data->payments[0]['value']['local']['amount'];
                $payNetwork->charge_value_crypto = $event->data->payments[0]['value']['crypto']['amount'];
                $payNetwork->save(false);

            }
            if ($event->type == 'charge:confirmed') {
                $payNetwork = new PaymentNetworkModel();
                $payNetwork->charge_id = $event->data->id;
                $payNetwork->charge_network = $event->data->payments[0]['network'];
                $payNetwork->charge_transaction_id = $event->data->payments[0]['transaction_id'];
                $payNetwork->charge_value_local = $event->data->payments[0]['value']['local']['amount'];
                $payNetwork->charge_value_crypto = $event->data->payments[0]['value']['crypto']['amount'];
                $payNetwork->save(false);
                $charge = PaymentChargeModel::getByPK($event->data->id);
                $user = UsersModel::getByPK($charge->charge_user_id);
                $user->user_balance += $event->data->payments[0]['value']['local']['amount'];
                $user->save();
            }
            echo sprintf('Successfully verified event with id %s and type %s.', $event->id, $event->type);

        } catch (\Exception $exception) {
            http_response_code(400);
            echo 'Error occurred. ' . $exception->getMessage();
        }
    }

    public function pushAction()
    {
        ob_start();
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
        set_time_limit(30);
        while (true) {
            $charge = PaymentNetworkModel::getByPK($this->session->chargeId);
            $charge2 = PaymentNetworkModel::getByPK($this->session->chargeId . '=');
            echo $charge == false ? "event: getData\ndata: nothing \n\n" : "event: success\ndata: done\n\n";
            if ($charge !== false) {
                $user = UsersModel::getByPK($this->session->u->user_id);
                $this->session->u->user_balance = $user->user_balance;
            }
            if ($charge2 !== false) {
                echo "event: process\ndata: done\n\n";
            }
            ob_end_flush();
            flush();
            sleep(1);
        }
    }
}