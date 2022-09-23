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
    private $value;
    private $due_date;

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

        $this->value = substr_replace(ltrim(substr($barcode, 34, 10), 0), '.', -2, 0);

        VarDumper::dump($this->value, 10, true); die(__FILE__ . ' - ' . __LINE__);


        VarDumper::dump($barcode, 10, true); die(__FILE__ . ' - ' . __LINE__);
    } 

    private function formatConvenio($barcode){
        VarDumper::dump($barcode, 10, true); die(__FILE__ . ' - ' . __LINE__);
    }

    private function setValue($value){

    }

    private function setDueDate($date){

    }

}