<?php
namespace sleifer\boleto;

use yii\helpers\VarDumper;

class Boleto{

    private $barcode;
    private $field1;
    private $field2;
    private $field3;
    private $field4;
    private $field5;
    private $type;

    const BOLETO = 0;
    const CONVENIO = 1; 

    function __construct($barcode){
        $barcode = str_replace(['.', '-', ' '], '', $barcode);
        if($barcode[0] == 8){
            $this->formatConvenio($barcode);
            $this->type = self::CONVENIO;
        }else{
            $this->formatBoleto($barcode);
            $this->type = self::BOLETO;
        }
    }

    private function formatBoleto($barcode){
        VarDumper::dump($barcode, 10, true); die(__FILE__ . ' - ' . __LINE__);
    } 

    private function formatConvenio($barcode){

    }

}