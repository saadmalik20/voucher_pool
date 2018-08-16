<?php
use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/recipient', 'VoucherPool\Controllers\RecipientController::create')->setName('Recipient');

$app->get('/voucher', 'VoucherPool\Controllers\VouchersController::redeem')->setName('Vouchers');

$app->get('/vouchers/generate', 'VoucherPool\Controllers\VouchersController::generate')->setName('Generate Vouchers');

$app->get('/vouchers/byemail', 'VoucherPool\Controllers\VouchersController::ByEmail')->setName('Voucher by Email');