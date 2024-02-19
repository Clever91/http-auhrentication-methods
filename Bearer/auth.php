<?php

include_once "../Basic/auth.php";

const BEARER_TOKEN = "this_is_bearer_token";

function bearer_authenticate() 
{
    $head = getallheaders();

    if (!isset($head["Authorization"])) {
        return false;
    }

    list($type, $token) = explode(" ", $head["Authorization"], 2);
    if (strcasecmp($type, "Bearer") !== 0) {
        return false;
    }

    // check token
    if (BEARER_TOKEN != $token) {
        return false;
    }
    
    return true;
}

function login()
{
    if (strtolower($_SERVER["REQUEST_METHOD"]) !== "post") {
        return false;
    }

    if (USERNAME != $_POST["username"] || USERPASS != $_POST["password"]) {
        return false;
    }

    return true;
}