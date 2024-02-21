<?php

include_once "../env.php";

/**
 * base64 url encode
 * this kind of function doesn't exist in php
 * so we custom create it
 * 
 * @param string $json
 * @return string
 */
function base64_url_encode($json)
{
    // replace + with -, / with _ and = with ''
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($json));
}

/**
 * jwt encode
 *
 * @param array $payload
 * @param integer $time
 * @return string
 */
function jwt_encode($payload = [], $time = 3600)
{
    // Create token header and payload
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload["exp"] = time() + $time;

    // Encode header and payload to Base64Url String
    $base64UrlHeader = base64_url_encode($header);
    $base64UrlPayload = base64_url_encode(json_encode($payload));

    // Create signature hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET_KEY, true);
    $base64UrlSignature = base64_url_encode($signature);

    return $base64UrlHeader.".".$base64UrlPayload.".".$base64UrlSignature;
}

/**
 * Login
 *
 * @return boolean
 */
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
