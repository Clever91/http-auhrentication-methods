<?php

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