<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once "auth.php";

header("Content-Type: application/json");

if (!bearer_authenticate()) {
    header('WWW-Authenticate: Bearer realm=Authorization Required');
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["fail" => true]);
    exit();
}

http_response_code(200);
echo json_encode(["ok" => true]);
exit();