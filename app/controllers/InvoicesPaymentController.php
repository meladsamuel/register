<?php


namespace shfretak\controllers;


use shfretak\lib\Back;
use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\models\PaymentChargeModel;
use shfretak\models\PaymentNetworkModel;

class InvoicesPaymentController extends AbstractController
{
    use InputFilter;
    use Helper;
    use Back;
    public function defaultAction() {
        $this->language->load('template/common');
        $this->language->load('InvoicesPayment/default');
        $this->_data['charges'] = PaymentChargeModel::getAlls();
        $this->_template->injectFooterResource('dataTable', JS.'dataTable.js', 'main');
        $this->_template->injectFooterResource('getter', JS.'getter.js', 'dataTable');
        $this->backHelper($this);
        $this->_view();
    }
    public function showAction() {
        $chargeId = $this->filterString($this->_params[0]);
        $this->language->load('template/common');
        $this->language->load('InvoicesPayment/default');
        $charge = PaymentChargeModel::getAllByPK($chargeId);
        if($charge == false) $this->redirect('/InvoicesPayment');
        $this->_data['charge'] = $charge;

        $this->_template->swapTemplate([':view' => 'actionView']);
        $this->_view(true);
    }
}