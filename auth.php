<?php

use controllers\utils\Utility;

session_start();
if (!isset($_SESSION['user'])) {
    http_response_code(401);
    Utility::logError(401, "User not authenticated,..");
    die(401);
}
if (!isset($_SESSION['expires_at'])) {
    http_response_code(401);
    Utility::logError(401, "User not authenticated,..");
    die(401);
} else {
    if (time() > $_SESSION['expires_at']) {
        session_unset();
        session_destroy();
        http_response_code(401);
        Utility::logError(401, "Session expired");
        die(401);
    } else {
        //Refresh token...
        $_SESSION['expires_at'] = time() + ($_ENV['SESSION_DURATION'] * 60);
    }
}
