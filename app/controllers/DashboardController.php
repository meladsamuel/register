<?php

namespace shfretak\controllers;

use shfretak\lib\Back;
use shfretak\models\FileServiceOrderModel;
use shfretak\models\IMEIServiceModel;
use shfretak\models\IMEIServiceOrderModel;
use shfretak\models\usersModel;

class DashboardController extends AbstractController
{
    use Back;

    public function defaultAction()
    {
        $this->_data['userNumber'] = usersModel::count();
        $this->_data['IMEINumber'] = IMEIServiceModel::count();
        $this->_data['file'] = FileServiceOrderModel::getOrder(5, true);
        $this->_data['IMEI'] = IMEIServiceOrderModel::getOrder(5, true);
        $this->backHelper($this);
        $this->_template->injectFooterResource('chart', JS.'Chart.min.js', 'main');
        $this->_view();
    }
}