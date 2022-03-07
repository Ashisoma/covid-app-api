<?php

define("LOGS_DIR", $_ENV["LOGS_DIR"]);

//Error reponses
define('INVALID_DATA_RESPONSE_CODE', 411);
define('FORBIDDEN_RESPONSE_CODE', 403);
define('UNAUTHORIZED_RESPONSE_CODE', 401);
define('SYSTEM_ERROR_CODE', -1);
define('PRECONDITION_FAILED_ERROR_CODE', 412);
define('SUCCESS_CODE', 200);
define("PERM_ACCESS_APP", "8");

define('UUID', $_ENV["APP_UUID"]);
define("TOKEN_TIME", $_ENV['TOKEN_TIME']);

function myJsonResponse($code, $message, $data = null) {
    $response = [];
    $response['code'] = $code;
    $response['message'] = $message;
    $response['data'] = $data;
    return json_encode($response);
}

function logError($code, $message) {
    if (!is_dir(LOGS_DIR)) {
        mkdir(LOGS_DIR);
    }
    $handle = fopen(LOGS_DIR . "errors.txt", 'a');
    $data = date("Y-m-d H:i:s ", time());
    $data .= "      Code " . $code;
    $data .= "      Message " . $message;
    $data .= "\n";
    fwrite($handle, $data);
    fclose($handle);
}
