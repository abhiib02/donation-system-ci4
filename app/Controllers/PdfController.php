<?php

namespace App\Controllers;
require_once $_SERVER["DOCUMENT_ROOT"].env('folderPath')."vendor/autoload.php";
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;

class PdfController extends BaseController
{
    public function index()
    {
        //
    }
    public function generatePDF($content,$paymentID){

        $html = $content;

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        file_put_contents($_SERVER['DOCUMENT_ROOT'].env('folderPath').'donationpdf/'.$paymentID.'.pdf', $output);
    }
}
