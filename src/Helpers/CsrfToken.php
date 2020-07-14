<?php

namespace Fox\Helpers;

use Exception;

/**
 * A helper to help the application to manage the CSRF token
 * PHP version >= 7.0
 *
 * @category Helper
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class CsrfToken
{
    /**
     * Create a new CSRF token
     *
     * @return string
     * @throws Exception
     */
    public static function create()
    {
        if (function_exists('mcrypt_create_iv')) {
            $_SESSION['_csrf_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        } else {
            $_SESSION['_csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
        return $_SESSION["_csrf_token"];
    }

    /**
     * Validate a given token by comparing it with the data in session
     *
     * @param string $token
     *
     * @return bool
     */
    public static function validate(string $token)
    {
        if (!isset($_SESSION["_csrf_token"])) {
            return false;
        }
        $storesToken = $_SESSION["_csrf_token"];
        unset($_SESSION["_csrf_token"]);
        if (hash_equals($storesToken, $token)) {
            return true;
        }

        return false;
    }
}