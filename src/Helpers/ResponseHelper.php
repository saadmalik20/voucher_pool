<?php
namespace VoucherPool\Helpers;

class ResponseHelper {
    public static function json($data, $response, $code = 200)
    {
        $response = $response->withHeader('Content-Type', 'application/json');
		$response = $response->withStatus($code, 'OK');
		$response = $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));
		return $response;
    }
}