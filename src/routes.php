<?php
use Slim\Http\Request;
use Slim\Http\Response;

// Post : Create recipient
$app->post('/recipient', 'VoucherPool\Controllers\RecipientController::create')->setName('Recipient');

// Get : Voucher - code and email check its valid
$app->get('/voucher', 'VoucherPool\Controllers\VouchersController::redeem')->setName('Vouchers');

// Get : Voucher/Generate - for each recipient with expiration date
$app->get('/vouchers/generate', 'VoucherPool\Controllers\VouchersController::generate')->setName('Generate Vouchers');

// Get : Voucher/Email - list all voucher of email
$app->get('/vouchers/byemail', 'VoucherPool\Controllers\VouchersController::ByEmail')->setName('Voucher by Email');