<?php

include_once "auth.php";

if (!authenticate()) {
    header('WWW-Authenticate: Basic realm=Authorization Required');
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

http_response_code(200);
header("Content-Type: application/json");
echo json_encode(["ok" => true]);
exit();