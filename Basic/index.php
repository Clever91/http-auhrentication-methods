<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ERROR);

include_once "auth.php";

if (!basic_authenticate()) {
    header('WWW-Authenticate: Basic realm=Authorization Required');
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

http_response_code(200);
header("Content-Type: application/json");
header("Set-Cookie: mytoken");
echo json_encode(["ok" => true]);
exit();