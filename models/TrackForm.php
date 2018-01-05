<?php

namespace app\models;

use Yii;
use yii\base\Model;
use SoapClient;
use SoapParam;

class TrackForm extends Model
{
    public $track;
    public $result = 'test';

    public function rules()
    {
        return [
            ['track', 'required'],
        ];
    }
    public function getTrackData()
    {
        $wsdlurl = 'https://tracking.russianpost.ru/rtm34?wsdl';
        $login = "DFgtYRUBIXFMVH";
        $password = "HBvdxI61WWlM";

        $client2 = new SoapClient($wsdlurl, array('trace' => 1, 'soap_version' => SOAP_1_2));

        $params3 = array ('OperationHistoryRequest' => array ('Barcode' => $this->track, 'MessageType' => '0','Language' => 'RUS'),
            'AuthorizationHeader' => array ('login'=>$login,'password'=>$password));

        $this->result = $client2->getOperationHistory(new SoapParam($params3,'OperationHistoryRequest'));
    }
}