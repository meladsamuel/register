<?php


namespace shfretak\controllers;


use shfretak\lib\Helper;
use shfretak\lib\InputFilter;
use shfretak\lib\Massenger;
use shfretak\lib\validate;
use shfretak\models\CurrencyModel;
use shfretak\models\CurrencyTranslationModel;

class CurrenciesController extends AbstractController
{
    use validate;
    use InputFilter;
    use Helper;
    private $_addRole = [
        'currency'          => 'req|alpha|equal(3)',
        'currency_name_en'  => 'req|alpha|max(40)',
        'currency_name_ar'  => 'req|alpha|max(40)',
        'currency_amount'   => 'req|num',
    ];
    private $_editRole = [
        'currency_amount'   => 'req|num',
    ];
    public function defaultAction() {
        $this->language->load('currencies\manage');
        $this->language->load('currencies\messages');
        $this->language->load('template\common');
        $this->language->load('validations\errors');
        $this->_data['currencies'] = CurrencyModel::getAllOne();

        $this->_template->injectFooterResource('dataTable', JS.'dataTable.js', 'main');
        $this->_view();
    }
    public function addAction() {
        $this->language->load('template\common');
        $this->language->load('currencies\form');
        $this->language->load('currencies\messages');
        $this->language->load('validations\errors');

        if (isset($_POST['submit']) && $this->isValid($this->_addRole, $_POST)) {
            $currency = new CurrencyModel();
            $code = $this->filterString($_POST['currency']);
            $currency->currency_code = $code;
            $currency->currency_amount = $this->filterString($_POST['currency_amount']);

            if (CurrencyModel::currencyExisting($currency->currency_code)) {
                $this->massenger->add($this->language->get('message_currency_existing'), Massenger::APP_MESSAGE_ERROR);
                $this->redirect('/currencies/add');
            }

            if($currency->save(false)){
                foreach ($this->_webLan as $lan) {
                    $currencyTranslation = new CurrencyTranslationModel();
                    $currencyTranslation->currency_code = $code;
                    $currencyTranslation->language_code = $lan;
                    $currencyTranslation->currency_name = $this->filterString($_POST['currency_name_'.$lan]);
                    if($currencyTranslation->save()) $this->massenger->add($this->language->get('message_add_success'));
                    else $this->massenger->add($this->language->get('message_add_failed'), Massenger::APP_MESSAGE_ERROR);
                }
            }else {
                $this->massenger->add($this->language->get('message_add_failed'), Massenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/currencies');
        }
        $this->_view();
    }
    public function editAction() {
        $id = $this->filterString($this->_params[0]);
        $currency = CurrencyModel::getByPK($id);
        if($currency == false) $this->redirect('/currencies');
        $this->language->load('currencies\form');
        $this->language->load('template\common');
        $this->language->load('validations\errors');
        $this->language->load('currencies\messages');
        $this->_data['currency'] = $currency;
        if (isset($_POST['submit']) && $this->isValid($this->_editRole, $_POST)) {
            $currency->currency_amount = $this->filterString($_POST['currency_amount']);
            $this->session->currency_amount = $currency->currency_amount;
            if($currency->save())
                 $this->massenger->add($this->language->get('message_add_success'));
            else
                $this->massenger->add($this->language->get('message_add_failed'), Massenger::APP_MESSAGE_ERROR);
            $this->redirect('/currencies');
        }
        $this->_view();
    }
    public function deleteAction() {
        $id = $this->filterString($this->_params[0]);
        $currency = CurrencyModel::getByPK($id);
        if($currency == false) $this->redirect('/currencies');
        $currency->delete();
        $this->redirect('/currencies');
    }
}