<?php
namespace VoucherPool\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Query\Builder;
use VoucherPool\Helpers\ResponseHelper;
use VoucherPool\Models\RecipientModel;
use VoucherPool\Models\VoucherModel;
use VoucherPool\Models\VoucherRecipientModel;

class VouchersController
{
	/**
     * @api {get} /vouchers/generate VoucherGenerate
     * @apiVersion 1.0.0
     * @apiName VoucherGenerate
	 * @apiGroup Vouchers
     * @apiHeader {String} Content-Type application/json.
     *
     * @apiParam {number} discount required.
	 * @apiParam {date} expire_at required.
     * 
     * @apiParamExample Request-Example:
     *     {
     *      "discount" : 10,
	 *      "expire_at" : "2018-10-10",
     *     }
     *
     * @apiErrorExample Error-Response: 
     *     HTTP/1.1 400 Bad Request
     *   ["InvalidArgumentException"]
     *
     * @apiErrorExample Error-Response: 
     *     HTTP/1.1 404 Not Found
     *   ["NoteUnavailableException"]
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *   [
     *     "Vouchers generated succesfully"
     *   ] 
     *
     */
    public static function generate(Request $request, Response $response)
	{
		$queryData = $request->getQueryParams();
		if(empty($queryData['discount']) || empty($queryData['expire_at']))
		{
			$response = ResponseHelper::json(["Discount and expire date are required"], $response, 400);
			return $response;
		}

		$recipientList = RecipientModel::all();
		$voucherList = VoucherModel::all();

		foreach($recipientList as $recipient)
		{
			$discountCode = substr(md5(uniqid(mt_rand(), true)), 0, 8);
			foreach($voucherList as $voucher)
			{
				if(array_search($discountCode, $voucherList))
				{
					$discountCode = substr(md5(uniqid(mt_rand(), true)), 0, 8);
				}
				else
				{
					break;
				}
			}
			$voucherModel = new VoucherModel(array(
				'code' => $discountCode,
				'discount' => $queryData['discount'],
				'expire_at' => date('Y-m-d', strtotime($queryData['expire_at']))
			));
			$voucherModel->save();
			
			$voucherRecipientModel = new VoucherRecipientModel(array(
				'voucher_id' => $voucherModel->id,
				'recipient_id' => $recipient->id
			));
			$voucherRecipientModel->save();
		}

		$response = ResponseHelper::json(["Vouchers generated succesfully"], $response);
		return $response;
	}


	/**
     * @api {get} /voucher VoucherRedeem
     * @apiVersion 1.0.0
     * @apiName Recipient
	 * @apiGroup Vouchers
     * @apiHeader {String} Content-Type application/json.
     *
     * @apiParam {string} code required.
	 * @apiParam {string} email required.
     * 
     * @apiParamExample Request-Example:
     *     {
     *      "code" : "a5F128Vu",
	 *      "email" : "saad@test.com",
     *     }
     *
     * @apiErrorExample Error-Response: 
     *     HTTP/1.1 400 Bad Request
     *   ["InvalidArgumentException"]
     *
     * @apiErrorExample Error-Response: 
     *     HTTP/1.1 404 Not Found
     *   ["NoteUnavailableException"]
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *   [
     *     "percentage" : "10"
     *   ] 
     *
     */

	public static function redeem(Request $request, Response $response)
	{
		$queryData = $request->getQueryParams();

		if(empty($queryData['email']) || empty($queryData['code']))
		{
			$response = ResponseHelper::json(["Email and code are required"], $response, 400);
			return $response;
		}

		$checkVoucher = VoucherModel::where("vouchers.code", $queryData['code'])
				->join('voucher_recipient', 'vouchers.id', '=', 'voucher_recipient.voucher_id')
				->join('recipient', 'recipient.id', '=', 'voucher_recipient.recipient_id')
				->where("vouchers.is_used", 0)
				->where("vouchers.expire_at", ">", date('Y-m-d').' 00:00:00')
				->where("recipient.email", $queryData['email'])->first();

		if($checkVoucher)
		{
			$updateVoucher = VoucherModel::find($checkVoucher->id);
			$updateVoucher->is_used = 1;
			$updateVoucher->used_at = date('Y-m-d H:i:s');

			$updateVoucher->save();

			$response = ResponseHelper::json(["percentage" => $checkVoucher->discount], $response);
			return $response;
		}

		$response = ResponseHelper::json(["Voucher not found"], $response, 400);
		return $response;
	}
	
	/**
     * @api {get} /vouchers/byemail VoucherByEmail
     * @apiVersion 1.0.0
     * @apiName VoucherByEmail
	 * @apiGroup Vouchers
     * @apiHeader {String} Content-Type application/json.
     *
	 * @apiParam {string} email required.
     * 
     * @apiParamExample Request-Example:
     *     {
	 *      "email" : "saad@test.com",
     *     }
     *
     * @apiErrorExample Error-Response: 
     *     HTTP/1.1 400 Bad Request
     *   ["InvalidArgumentException"]
     *
     * @apiErrorExample Error-Response: 
     *     HTTP/1.1 404 Not Found
     *   ["NoteUnavailableException"]
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *   [
	 * 		{
     *     		"voucher" : "a5F128Vu",
	 * 	   		"discount" : "10%"
     *   	},
	 * 		{
     *     		"voucher" : "h11C76kn",
	 * 	   		"discount" : "20%"
     *   	}
	 * 	 ] 
     *
     */
	public static function ByEmail(Request $request, Response $response)
	{
		$queryData = $request->getQueryParams();

		if(empty($queryData['email']))
		{
			$response = ResponseHelper::json(["Email is required"], $response, 400);
			return $response;
		}

		$emailVoucherList = RecipientModel::where("recipient.email", $queryData['email'])
				->join('voucher_recipient', 'recipient.id', '=', 'voucher_recipient.recipient_id')
				->join('vouchers', 'vouchers.id', '=', 'voucher_recipient.voucher_id')
				->where("vouchers.is_used", 0)
				->where("vouchers.expire_at", ">", date('Y-m-d').' 00:00:00')
				->get();


		if($emailVoucherList)
		{
			foreach($emailVoucherList as $emailVoucher)
			{
				$responseData[] = [
					"voucher" => $emailVoucher->code,
					"discount" => $emailVoucher->discount."%",
				];
			}
			$response = ResponseHelper::json($responseData, $response);
			return $response;
		}

		$response = ResponseHelper::json(["Vouchers not found"], $response, 400);
		return $response;
	}
}