<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class QRController extends BaseController
{
    public function index()
    {
        //
    }
    public function generateQRCODE($id){

        $generatorURL = env('app.baseURL')."generateqr.php?";
        $dataURL = env('app.baseURL')."certificate/";
        $data = array(
            'id' => $id,
            'url' => $dataURL,
            'path' => 'qrcodes'
        );
        $qrdata = http_build_query($data);
        
        print_r($generatorURL.urldecode($qrdata));
        
        /*$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $generatorURL.urldecode($qrdata));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_exec($ch);
        curl_close($ch);*/
    }   
}
