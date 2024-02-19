<?php

include_once "auth.php";

if (!authenticate()) {
    header('WWW-Authenticate: Basic unauthorized');
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

http_response_code(201); //202, 203, 204
header("Content-Type: application/json");
echo json_encode(["created" => true]);
exit();