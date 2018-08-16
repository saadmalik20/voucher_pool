<?php
namespace VoucherPool\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use VoucherPool\Helpers\ResponseHelper;
use VoucherPool\Models\RecipientModel;


class RecipientController
{
	/**
     * @api {post} /recipient Recipient
     * @apiVersion 1.0.0
     * @apiName Recipient
	 * @apiGroup Vouchers
     * @apiHeader {String} Content-Type application/json.
     *
     * @apiParam {string} name required.
	 * @apiParam {string} email required.
     * 
     * @apiParamExample Request-Example:
     *     {
     *      "name" : "Saad Malik",
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
     *     "Recipient created succesfully"
     *   ] 
     *
     */
    public static function create(Request $request, Response $response)
	{
		$postData = $request->getParsedBody();
		if(empty($postData['name']) || empty($postData['email']))
		{
			return ResponseHelper::json(["Recipient name and email are required"], $response, 400);
		}
		
		$recipient = new RecipientModel([
			'name' => $postData['name'],
			'email' => $postData['email'],
		]);
		$recipient->save();
		
		return ResponseHelper::json(["Recipient created succesfully"], $response);
	}
}