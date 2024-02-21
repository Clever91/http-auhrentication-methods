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
 * base64 url decode
 *
 * @param string $json
 * @return string
 */
function base64_url_decode($json)
{
    $remainder = strlen($json) % 4;
    if ($remainder) {
        $padlen = 4 - $remainder;
        $json .= str_repeat('=', $padlen);
    }
    return base64_decode(strtr($json, '-_', '+/'));
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
 * jwt decode
 *
 * @param string $token
 * @return boolean|array
 */
function jwt_decode($token)
{
    // Validation
    $tks = explode(".", $token);
    if (count($tks) != 3) {
        return false;
    }
    
    // Get base64 url string
    list($header64, $payload64, $signature64) = $tks;
    $payload = json_decode(base64_url_decode($payload64), true);

    // Create checking signature hash
    $signature = hash_hmac('sha256', $header64 . "." . $payload64, SECRET_KEY, true);
    $checkingSignature = base64_url_encode($signature);

    // Checking signature
    if ($signature64 != $checkingSignature) {
        return false;
    }

    // checking expire time
    if (time() > intval($payload["exp"])) {
        return false;
    }

    return $payload;
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


/**
 * Get jwt token
 *
 * @return boolean|string 
 */
function getJwtToken()
{
    $head = getallheaders();

    if (!isset($head["Authorization"])) {
        return false;
    }

    list($type, $token) = explode(" ", $head["Authorization"], 2);
    if (strcasecmp($type, "Bearer") !== 0) {
        return false;
    }

    return $token;
}