<?php

ini_set('display_errors', 1);
error_reporting(E_ERROR);

include_once "../../env.php";
include_once "jwt.php";

header("Content-Type: application/json");

function failResponse()
{
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["auth" => false]);
    exit();
}


$token = getJwtToken();
if ($token === false) {
    failResponse();
}

$payload = jwt_decode($token);
if ($payload === false) {
    failResponse();
}

echo json_encode($payload);
exit();