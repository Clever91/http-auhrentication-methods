<?php

include_once "auth.php";

header("Content-Type: application/json");
if (!login()) {
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode(["login" => false]);
    exit();
}

echo json_encode(["token" => BEARER_TOKEN]);
exit();