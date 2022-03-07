<?php

use controllers\utils\Utility;

require_once "functions.php";
if (isset($_SERVER['HTTP_UUID'])) {

    $UUID = $_SERVER['HTTP_UUID'];

    if ($UUID != UUID) {
        Utility::logError(FORBIDDEN_RESPONSE_CODE, "User not allowed");
        http_response_code(FORBIDDEN_RESPONSE_CODE);
        die("Unauthorized");
    }
} else {
    Utility::logError(FORBIDDEN_RESPONSE_CODE, "User not allowed");
    http_response_code(FORBIDDEN_RESPONSE_CODE);
    die("Unauthorized");
}
