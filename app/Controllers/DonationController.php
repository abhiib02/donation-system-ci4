<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Donation;

class DonationController extends BaseController
{
    public function index()
    {
        //
    }
    public function DonationForm()
    {
         return 
        view('header').
        view('donate-form').
        view('footer');
    }

    public function authorizeCert($paymentid){
        $Donation = new Donation();
        $data = $Donation->getDonationsbyID($paymentid);
         return 
        view('header').
        view('certificate', $data).
        view('footer');
    }
    public function leaderBoard(){
        $Donation = new Donation();
        $data =  json_encode($Donation->getAllNonAnonymousDonation());
        return $this->response->setJSON($data);
    }
}
