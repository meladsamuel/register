<?php


namespace shfretak\controllers;

use realTime\Notify;

class TestController extends AbstractController
{


    function defaultAction() {
        new Notify();

    }

    public function cryptoCurrencyAction()
    {

    }


}