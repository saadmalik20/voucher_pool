<?php

namespace Tests\Functional;

use VoucherPool\Models\RecipientModel;

class VouchersTest extends BaseTestCase
{
    public function testPostRecipient($options = [])
    {
        $randString = substr(md5(uniqid(mt_rand(), true)), 0, 10);
        $options = ["name" => $randString, "email" => $randString."@test.com"];

        $response = $this->runApp('POST', '/recipient', $options);
        $response->getBody()->rewind();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Recipient created succesfully', json_decode($response->getBody())[0]);
    }

    public function testGenerateVouchers($options = [])
    {
        $options = http_build_query(["discount" => rand(10,100), "expire_at" => date("Y-m-d", strtotime("+1 day"))]);
        
        $response = $this->runApp('GET', '/vouchers/generate?'.$options);
        $response->getBody()->rewind();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Vouchers generated succesfully', json_decode($response->getBody())[0]);
    }

    public function testRedeemVoucher($options = [])
    {
        $recipientData = RecipientModel::select("vouchers.code", "recipient.email")
                ->join('voucher_recipient', 'recipient.id', '=', 'voucher_recipient.recipient_id')
				->join('vouchers', 'vouchers.id', '=', 'voucher_recipient.voucher_id')
				->where("vouchers.is_used", 0)
				->where("vouchers.expire_at", ">", date('Y-m-d').' 00:00:00')
				->first();
        $options = http_build_query(["email" => $recipientData->email, "code" => $recipientData->code]);
        
        $response = $this->runApp('GET', '/voucher?'.$options);
        $response->getBody()->rewind();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('percentage', json_decode($response->getBody(), true));
    }

    public function testVoucherByEmail($options = [])
    {
        $recipientData = RecipientModel::select("recipient.email")
                ->join('voucher_recipient', 'recipient.id', '=', 'voucher_recipient.recipient_id')
				->join('vouchers', 'vouchers.id', '=', 'voucher_recipient.voucher_id')
				->where("vouchers.is_used", 0)
				->where("vouchers.expire_at", ">", date('Y-m-d').' 00:00:00')
                ->first();
                
        $options = http_build_query(["email" => $recipientData->email]);
        
        $response = $this->runApp('GET', '/vouchers/byemail?'.$options);
        $response->getBody()->rewind();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('voucher', json_decode($response->getBody(), true)[0]);
    }

}