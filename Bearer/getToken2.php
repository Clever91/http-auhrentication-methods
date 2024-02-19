<?php

include_once "../Basic/auth.php";
include_once "auth.php";

if (!basic_authenticate()) {
    header('WWW-Authenticate: Basic realm=Authorization Required');
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

header("Content-Type: application/json");
echo json_encode(["token" => BEARER_TOKEN]);
exit();