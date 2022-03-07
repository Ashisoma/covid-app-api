<?php
require_once "functions.php";

use controllers\utils\Utility;
use \Firebase\JWT\JWT;
use models\SessionManager;

$token = $_SERVER['HTTP_TOKEN'];

try {
    $publicKey = file_get_contents(__DIR__ . '/mykey.pub');
    $jwt = JWT::decode($token, $publicKey, array('RS256'));
    $decoded_array = (array) $jwt;
} catch (\Throwable $e) {
    Utility::logError($e->getCode(), $e->getMessage());
    $session = SessionManager::where('jwt', $token)->first();
    if ($session != null){
        $session->active = 0;
        $session->save();
    }
    http_response_code(401);
    die($e->getMessage());
}
