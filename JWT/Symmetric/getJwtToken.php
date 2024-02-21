<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ERROR);

include_once "../../env.php";
include_once "jwt.php";

header("Content-Type: application/json");
if (!login()) {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["login" => false]);
    exit();
}

$payload = [
    "user_id" => 1234,
    "role" => "moderator"
];

// expire time 30 min
echo json_encode(["token" => jwt_encode($payload, 30*60)]);
exit();