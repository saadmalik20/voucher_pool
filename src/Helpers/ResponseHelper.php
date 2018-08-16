<?php
namespace VoucherPool\Helpers;

class ResponseHelper {
    public static function json($data, $response, $code = 200)
    {
        return $response->withHeader('Content-Type', 'application/json')->withStatus($code, 'OK')
        ->withJson($data);
    }
}