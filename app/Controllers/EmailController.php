<?php

namespace App\Controllers;

use App\Models;
use App\Models\Donation;
use Config\Services;
use Config\Email;
use App\Controllers\PdfController;

class EmailController extends BaseController
{
    protected $helpers = ['form'];

    public function __construct()
    {
    }



    /* =================================== */
    //
    //  All SMTP setting is in 'app/config/Email.php'; 
    //  
    /* =================================== */

    public function sendDonationCertificate($payment_id)
    {

        
        //$PDF = new PdfController();
        $DonationModel = new Donation();
        $email = new Email();
        $DonaterData = $DonationModel->getDonationbyPaymentID($payment_id);
        $NgoHeadName =env('ngoOwner');
        $post=env('ownerPosition');
        $Address = env('ngoAdress');
        $DonaterName = $DonaterData['name'];
        $Amount = $DonaterData['amount'];
        $OrgName = env('appName');
        $website = env('app.baseURL');
        $to = $DonaterData['email'];
        
        $from = $email->fromEmail;
        
        $QRCode = $website.'qrcodes/'.$payment_id.'.png';
        $PDFurl = $website.'donationpdf/'.$payment_id.'.pdf';

        
        $messageTemplatePDF = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
                            <html>
                            <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
                                <style>*{box-sizing:border-box;font-family: DejaVu Sans, sans-serif;}body{margin:0;padding:0}#m_MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.m_desktop_hide,.m_desktop_hide table{display:none;max-height:0;overflow:hidden}.m_image_block img+div{display:none}@media (max-width:720px){.m_mobile_hide{display:none}.m_row-content{width:100%!important}.m_stack .m_column{width:100%;display:block}.m_mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.m_desktop_hide,.m_desktop_hide table{display:table!important;max-height:none!important}.m_row-2 .m_column-1 .m_block-2.m_text_block td.m_pad{padding:20px 0!important}.m_row-2 .m_column-1{padding:30px 10px!important}}
                                </style>
                            </head>
                            <body>
                                <u></u>
                                <div style="style="background-color:#f5f5f5;margin:0;padding:0">
                                    <table class="m_nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#fff">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <table class="m_row m_row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="100%" style="font-weight:400;text-align:left;padding-bottom:15px;padding-top:15px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_image_block m_block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                            <tr>
                                                                            <td class="m_pad" style="width:100%">
                                                                                <div class="m_alignment" align="left" style="line-height:10px">
                                                                                    <div style="max-width:194px">
                                                                                    <img src="data:image/png;base64,'.base64_encode(file_get_contents(env('appLogoPath'))).'" style="display:block;height:20px;border:0;width:auto;"></div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="m_row m_row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f5f5f5;border-radius:0;color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="100%" style="font-weight:400;text-align:left;padding-bottom:30px;padding-left:45px;padding-right:45px;padding-top:30px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_text_block m_block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad">
                                                                                <div style="font-family:sans-serif">
                                                                                    <div style="font-size:12px;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;color:#000;line-height:1.2">
                                                                                        <p style="margin:0;font-size:12px;text-align:center"><strong><span style="font-size:26px">Thank You for Your Generous Donation</span></strong></p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                        <table class="m_text_block m_block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad" style="padding-bottom:20px;padding-left:60px;padding-right:60px;padding-top:20px">
                                                                                <div style="font-family:sans-serif">
                                                                                    <div style="font-size:14px;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;color:#000;line-height:1.2">
                                                                                        <p style="margin:0">Dear, '.$DonaterName.'</p>
                                                                                        <br>
                                                                                        <p>With immense gratitude, we acknowledge and appreciate your generous donation of ₹'.$Amount.' to '.env('appName').'. Your support is instrumental in driving positive change and advancing our mission to uplift rural areas through research, education, and comprehensive training.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">Your contribution aligns seamlessly with our goal of improving the quality of education in India rural and educationally backward areas. It will enable us to continue addressing socio-economic challenges, nurturing spiritual well-being, and creating sustainable impacts in various fields and sectors.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">The ₹'.$Amount.' you have generously donated will be utilized to support educational support, healthcare initiatives, skill development programs, etc. Your financial contribution plays a vital role in providing basic needs, education, healthcare, and more to those who need it most.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">As we work towards fostering positive change, we commit to keeping you informed about the impact of your donation. Regular updates will showcase the tangible outcomes and transformations made possible through your support.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">Once again, thank you for being a beacon of hope and a catalyst for positive change. Your generosity is a testament to your commitment to making a difference in the lives of those less fortunate.</p>
                                                                                        <br>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="m_row m_row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f5f5f5;border-radius:0;color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="50%" style="font-weight:400;text-align:left;padding-bottom:5px;padding-left:45px;padding-top:5px;vertical-align:middle;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_paragraph_block m_block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad" style="padding-bottom:10px;padding-left:60px;padding-right:10px;padding-top:10px">
                                                                                <div style="color:#000;direction:ltr;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;letter-spacing:0;line-height:120%;text-align:left">
                                                                                    <p style="margin:0;margin-bottom:16px">Warm regards,</p>
                                                                                    <p style="margin:0">'.$NgoHeadName.'<br>'.$post.'<br>'.env('appName').'</p>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td class="m_column m_column-2" width="50%" style="font-weight:400;text-align:left;padding-bottom:5px;padding-top:5px;vertical-align:middle;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_image_block m_block-1" width="100%" border="0" cellpadding="25" cellspacing="0" role="presentation">
                                                                            <tr>
                                                                            <td class="m_pad">
                                                                                <div class="m_alignment" align="center" style="line-height:10px">
                                                                                    <div style="max-width:158px"><img src="data:image/png;base64,'.base64_encode(file_get_contents($QRCode)).'" style="display:block;height:auto;border:0;width:100%" width="158" alt="qrcode" title="qrcode"></div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="m_row m_row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f5f5f5;color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="100%" style="font-weight:400;text-align:left;padding-bottom:25px;padding-top:25px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_text_block m_block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad">
                                                                                <div style="font-family:sans-serif">
                                                                                    <div style="font-size:12px;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;color:#555;line-height:1.2">
                                                                                        <p style="margin:0;font-size:14px;text-align:center"><span style="font-size:12px"><strong>Our mailing address:</strong></span></p>
                                                                                        <p style="margin:0;font-size:14px;text-align:center"><span style="font-size:12px">'.$Address.'</span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </body>
                            </html>
        ';
        $messageTemplateHTML = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
                            <html>
                            <head>
                                <META http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <style>*{box-sizing:border-box}body{margin:0;padding:0}#m_MessageViewBody a{color:inherit;text-decoration:none}p{line-height:inherit}.m_desktop_hide,.m_desktop_hide table{display:none;max-height:0;overflow:hidden}.m_image_block img+div{display:none}@media (max-width:720px){.m_mobile_hide{display:none}.m_row-content{width:100%!important}.m_stack .m_column{width:100%;display:block}.m_mobile_hide{min-height:0;max-height:0;max-width:0;overflow:hidden;font-size:0}.m_desktop_hide,.m_desktop_hide table{display:table!important;max-height:none!important}.m_row-2 .m_column-1 .m_block-2.m_text_block td.m_pad{padding:20px 0!important}.m_row-2 .m_column-1{padding:30px 10px!important}}</style>
                            </head>
                            <body>
                                <u></u>
                                <div style="style="background-color:#f5f5f5;margin:0;padding:0">
                                    <table class="m_nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#fff">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <table class="m_row m_row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="100%" style="font-weight:400;text-align:left;padding-bottom:15px;padding-top:15px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_image_block m_block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                                            <tr>
                                                                            <td class="m_pad" style="width:50%">
                                                                                <div class="m_alignment" align="left" style="line-height:10px">
                                                                                    <div style="max-width:194px">
                                                                                    <img src="'.env('appLogoPath').'" style="display:block;height:20px;border:0;width:auto;"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                             <p>'.env('appName').'</p>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="m_row m_row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f5f5f5;border-radius:0;color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="100%" style="font-weight:400;text-align:left;padding-bottom:30px;padding-left:45px;padding-right:45px;padding-top:30px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_text_block m_block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad">
                                                                                <div style="font-family:sans-serif">
                                                                                    <div style="font-size:12px;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;color:#000;line-height:1.2">
                                                                                        <p style="margin:0;font-size:12px;text-align:center"><strong><span style="font-size:26px">Thank You for Your Generous Donation</span></strong></p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                          <table class="m_text_block m_block-2" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad" style="padding-bottom:20px;padding-left:60px;padding-right:60px;padding-top:20px">
                                                                                <div style="font-family:sans-serif">
                                                                                    <div style="font-size:14px;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;color:#000;line-height:1.2">
                                                                                        <p style="margin:0">Dear, '.$DonaterName.'</p>
                                                                                        <br>
                                                                                        <p>With immense gratitude, we acknowledge and appreciate your generous donation of ₹'.$Amount.' to '.env('appName').'. Your support is instrumental in driving positive change and advancing our mission to uplift rural areas through research, education, and comprehensive training.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">Your contribution aligns seamlessly with our goal of improving the quality of education in India rural and educationally backward areas. It will enable us to continue addressing socio-economic challenges, nurturing spiritual well-being, and creating sustainable impacts in various fields and sectors.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">The ₹'.$Amount.' you have generously donated will be utilized to support educational support, healthcare initiatives, skill development programs, etc. Your financial contribution plays a vital role in providing basic needs, education, healthcare, and more to those who need it most.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">As we work towards fostering positive change, we commit to keeping you informed about the impact of your donation. Regular updates will showcase the tangible outcomes and transformations made possible through your support.</p>
                                                                                        <br>
                                                                                        <p style="margin:0">Once again, thank you for being a beacon of hope and a catalyst for positive change. Your generosity is a testament to your commitment to making a difference in the lives of those less fortunate.</p>
                                                                                        <br>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="m_row m_row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f5f5f5;border-radius:0;color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="50%" style="font-weight:400;text-align:left;padding-bottom:5px;padding-left:45px;padding-top:5px;vertical-align:middle;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_paragraph_block m_block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad" style="padding-bottom:10px;padding-left:60px;padding-right:10px;padding-top:10px">
                                                                                <div style="color:#000;direction:ltr;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;letter-spacing:0;line-height:120%;text-align:left">
                                                                                    <p style="margin:0;margin-bottom:16px">Warm regards,</p>
                                                                                    <p style="margin:0">'.$NgoHeadName.'<br>'.$post.'<br>'.env('appName').'</p>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td class="m_column m_column-2" width="50%" style="font-weight:400;text-align:left;padding-bottom:5px;padding-top:5px;vertical-align:middle;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_image_block m_block-1" width="100%" border="0" cellpadding="25" cellspacing="0" role="presentation">
                                                                            <tr>
                                                                            <td class="m_pad">
                                                                                <div class="m_alignment" align="center" style="line-height:10px">
                                                                                    <div style="max-width:158px"><img src="'.$QRCode.'" style="display:block;height:auto;border:0;width:100%" width="158" alt="qrcode" title="qrcode"></div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table class="m_row m_row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table class="m_row-content m_stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background-color:#f5f5f5;color:#000;width:700px;margin:0 auto" width="700">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="m_column m_column-1" width="100%" style="font-weight:400;text-align:left;padding-bottom:25px;padding-top:25px;vertical-align:top;border-top:0;border-right:0;border-bottom:0;border-left:0">
                                                                        <table class="m_text_block m_block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="word-break:break-word">
                                                                            <tr>
                                                                            <td class="m_pad">
                                                                                <div style="font-family:sans-serif">
                                                                                    <div style="font-size:12px;font-family:&#39;Open Sans&#39;,&#39;Helvetica Neue&#39;,Helvetica,Arial,sans-serif;color:#555;line-height:1.2">
                                                                                        <p style="margin:0;font-size:14px;text-align:center"><span style="font-size:12px"><strong>Our mailing address:</strong></span></p>
                                                                                        <p style="margin:0;font-size:14px;text-align:center"><span style="font-size:12px">'.$Address.'</span></p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </body>
                            </html>
        ';
        
        //$message = $messageTemplateHTML.'<br><a href="'.$PDFurl.'" style="width:90px;height:38px;padding:5px;display:grid:place-items:center;color:white;text-decoration:none;background-color:#0d6efd;" download>Download PDF</a>';
        //$PDF->generatePDF($messageTemplatePDF,$payment_id);
        
        $subject = 'Donation Cetificate from '.$OrgName;
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom($from, $OrgName);
        $email->setSubject($subject);
        $email->setMessage($messageTemplateHTML);
        $email->setMailType('html');  
    
        if ($email->send()) {
                return 1;
        } else {
                $data = $email->printDebugger(['headers']);
                 //print_r($data);
                echo "<script>alert('Some Error Occured While sending E-Mail');</script>";
        }
    }
}
