<?php

namespace App\Controllers;
use App\Models\Donation;

class Home extends BaseController
{
    public function index()
    {
       echo '<script>window.location.href="/"</script>';
       die();
        
    }

    public function thanks($payment_id){
        $Donation = new Donation();
        $DonaterData = $Donation->getDonationbyPaymentID($payment_id);
        if(!$DonaterData){
            return redirect()->route("/");
        }
        $data['DonaterData'] = $DonaterData;

        return 
        view('header').
        view('thanks', $data).
        view('footer');
    }
    public function failure(){
        return 
        view('header').
        view('failed').
        view('footer');
    }
    
}

