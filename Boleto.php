<?php
namespace sleifer\boleto;

use DateTime;
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
    private $error;

    const BOLETO = 0;
    const CONVENIO = 1; 

    function __construct($barcode){

        if(!BoletoValidator::valida($barcode)){
            $this->error = 'Código de barras inválido!';
            return false;
        }

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

        $this->setValue(substr($barcode, 37, 10));
        $this->setDueDate(substr($barcode, 33, 4));

        VarDumper::dump($this->due_date, 10, true); die(__FILE__ . ' - ' . __LINE__);
       
        VarDumper::dump($barcode, 10, true); die(__FILE__ . ' - ' . __LINE__);
    } 

    private function formatConvenio($barcode){
        VarDumper::dump($barcode, 10, true); die(__FILE__ . ' - ' . __LINE__);
    }

    private function setValue($value){
        $this->value = substr_replace(ltrim($value, 0), '.', -2, 0);
    }

    private function setDueDate($days = null){
        if($days){
            $this->due_date =  date('Y-m-d', strtotime($days . " days",strtotime('1997-10-07')));
        }else{
            $this->due_date = null;
        }
    }

}