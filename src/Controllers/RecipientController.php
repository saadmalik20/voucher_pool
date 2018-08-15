<?php
namespace VoucherPool\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use VoucherPool\Helpers\ResponseHelper;
use VoucherPool\Models\RecipientModel;


class RecipientController
{
    public static function create(Request $request, Response $response)
	{
		$postData = $request->getParsedBody();
		if(empty($postData['name']) || empty($postData['email']))
		{
			$response = ResponseHelper::json(["Recipient name and email are required"], $response);
			return $response;
		}
		
		$recipient = new RecipientModel(array(
			'name' => $postData['name'],
			'email' => $postData['email'],
		));
		$recipient->save();
		
		$response = ResponseHelper::json(["Recipient created succesfully"], $response);
		return $response;
	}
}