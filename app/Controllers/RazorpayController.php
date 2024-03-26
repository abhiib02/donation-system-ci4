<?php


namespace App\Controllers;
require_once $_SERVER["DOCUMENT_ROOT"].env('folderPath')."vendor/autoload.php";
use App\Controllers\BaseController;
use App\Controllers\QRController;
use App\Controllers\EmailController;
use App\Models\Donation;
use Config\Services;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController extends BaseController
{

    public function __construct()
    {
      
    }
    
    public function pay(){
        $session = Services::session();
        $api = new Api(env('razorKey'), env('razorSecret'));

        $total_amount = $_SESSION['payable_amount'] = $this->request->getPost('amount');
        $data['name'] = $this->request->getPost('name');
        $data['email'] = $this->request->getPost('email');
        $data['contact'] = $this->request->getPost('contact');
        $data['citizen'] = $this->request->getPost('citizen');
        $data['anonymous'] = $this->request->getPost('anonymous');

        $data['ORDER_ID']=$data['name'].$data['email'];

          $rules = $this->validate([
                'amount' => 'required',
                'name' => 'required',
                'email' => 'required|valid_email',
                'contact' => 'required',
                'citizen' => 'required',
            ]);
          if (!$rules) {
              echo '<script>alert("Some Input is Invalid");window.location.href="/donate-form";</script>';
              die();
          }

        $session->set(['payable_amount'=>$total_amount]);

        $razorpayOrder = $api->order->create(array(
            'receipt'         => $data['ORDER_ID'],
            'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ));
        
        $amount = $razorpayOrder['amount'];
        $razorpayOrderId = $razorpayOrder['id'];

        $session->set(['razorpay_order_id'=>$razorpayOrderId]);

        $data = $this->prepareData($amount,$razorpayOrderId,$data);

        return view('razorpay',['data'=>$data]);
    }

    public function prepareData($amount,$razorpayOrderId,$data)
  {
    $data = array(
      "key" => env('razorKey'),
      "amount" => $amount,
      "name" => env('appName'),
      "description" => "Donation to ".env('appName'),
      "image" => env('appLogoPath'),
      "prefill" => array(
        "name"  => $data['name'],
        "email"  => $data['email'],
        "contact" => $data['contact'],
        "citizen" => $data['citizen'],
        "anonymous"=> $data['anonymous'],
      ),
      "notes"  => array(
        "address"  => "",
        "merchant_order_id" => rand(),
      ),
      "theme"  => array(
        "color"  => env('appThemeHex')
      ),
      "order_id" => $razorpayOrderId,
    );
    return $data;
  }


    public function verify() //This function verifies the payment,after successful payment
  {
      
    
     $session = Services::session();
     
    $success = true;
    
    $error = "payment_failed";
    
    if (empty($_POST['razorpay_payment_id']) === false) {
        
      $api = new Api(env('razorKey'), env('razorSecret'));
      
    try {
        
        $attributes = array(
          'razorpay_order_id' => $session->get('razorpay_order_id'),
          'razorpay_payment_id' => $this->request->getPost('razorpay_payment_id'),
          'razorpay_signature' => $this->request->getPost('razorpay_signature')
        );
        
        $api->utility->verifyPaymentSignature($attributes);
        
      } catch(SignatureVerificationError $e) {
          
        $success = false;
        
        $error = 'Razorpay_Error : ' . $e->getMessage();
      }
    }
    if ($success === true) {
        
      //////////////////////////////////////////////////
      //                                              //
      // Call this function from where ever you want  //
      // to save save data before of after the payment//
      //                                              //
      //////////////////////////////////////////////////
      
      $DonaterData = $this->saveDonaterData();
      
      
      return redirect()->to(env('app.baseURL')."thanks/".$DonaterData['payment_id']);
  
      
      
    } else {
        
      return redirect()->to(env('app.baseURL')."failed");
      //redirect(base_url().'payment/paymentFailed');
      
    }
  }
  public function saveDonaterData()
  { 
    $QRController = new QRController();
    $Donation = new Donation();
    $session = Services::session();

        $data['name'] = $this->request->getPost('name');
        $data['email'] = $this->request->getPost('email');
        $data['contact'] = $this->request->getPost('contact');
        $data['amount'] = $session->get('payable_amount');
        $data['citizen'] = $this->request->getPost('citizen');
        $data['anonymous'] = $this->request->getPost('anonymous');
        $data['payment_id'] = $this->request->getPost('razorpay_payment_id');
        
    $QRController->generateQRCODE($data['payment_id']);
    $Donation->insertDonation($data);
    $this->sendEmail($data['payment_id']);
    
    return $data;
  }

  public function sendEmail($payment_id){
      $EmailController = new EmailController();
      $EmailController->sendDonationCertificate($payment_id);
  }

}