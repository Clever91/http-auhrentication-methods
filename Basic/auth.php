<?php

const USERNAME = "username";
const USERPASS = "userpass";

function basic_authenticate() {
    if (!isset($_SERVER["HTTP_AUTHORIZATION"])) {
        return false;
    }
    if ($_SERVER["PHP_AUTH_USER"] != USERNAME || $_SERVER["PHP_AUTH_PW"] != USERPASS) {
        return false;
    }
    return true;
}