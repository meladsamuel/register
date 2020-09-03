<?php
namespace shfretak\models;
class IMEIOrderModel extends AbstractModel {
    public $imei_order_id;
    public $imei_order;

    protected static $tableName = 'imei_order';
    protected static $primeryKey = 'imei_order_id';
    protected static $tableSchema = [
        'imei_order_id' => self::DATA_TYPE_INT,
        'imei_order' => self::DATA_TYPE_STR
    ];

    public function imei_check_number($code) {
        $sum = 0;
        for($i=0; $i<14; $i++){
            $digit = (int) $code[$i];
            if($i%2 != 0){
                $digit *=2;
                if ($digit > 9) $digit -=9;
            }
            $sum += $digit;
        }
        return (string) (($sum * 9) % 10);

    }
}