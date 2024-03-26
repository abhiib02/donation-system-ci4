<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('thanks/(:any)', 'Home::thanks/$1');
$routes->get('failed', 'Home::failure');

// Get Route For Show Payment Form
//$routes->get('donate-form', 'DonationController::DonationForm');

// Get Route For Show Payment Form
$routes->get('api/donations', 'DonationController::leaderBoard');

// Process Payment Route
$routes->post('paydonation', 'RazorpayController::pay');

// Post Route For making Payment Request
$routes->post('verifyDonation', 'RazorpayController::verify');

// certificate authentication via qrcode;
$routes->get('certificate/(:any)', 'DonationController::authorizeCert/$1');

$routes->get('sendTest', 'EmailController::sendTest');

$routes->get('genqr/(:any)', 'QRController::generateQRCODE/$1');
//https://maharshingo.com/donation/index.php/QRController/generateQRCODE/1