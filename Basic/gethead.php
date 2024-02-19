<?php

include_once "auth.php";

if (!basic_authenticate()) {
    http_response_code(401);
} else {
    http_response_code(200);
}

header("Content-Type: application/json");
echo json_encode(getallheaders());
exit();