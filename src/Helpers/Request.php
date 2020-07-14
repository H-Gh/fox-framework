<?php

namespace Fox\Helpers;

/**
 * A helper to help the application to manage the http requests
 * PHP version >= 7.0
 *
 * @category Helper
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class Request
{
    /**
     * Check what if the incoming request has the given key or not
     *
     * @param string $parameter The parameter name
     *
     * @return bool
     */
    public static function hasNot($parameter)
    {
        return !isset($_REQUEST[$parameter]);
    }

    /**
     * Check what if the given parameter is empty or not
     *
     * @param string $parameter The parameter name
     *
     * @return bool
     */
    public static function empty($parameter)
    {
        return isset($_REQUEST[$parameter]) && empty($_REQUEST[$parameter]);
    }

    /**
     * Get the parameter value from request
     *
     * @param string $parameter  The parameter
     * @param null   $validation The validation value
     *
     * @return string
     */
    public static function get(string $parameter, $validation = null)
    {
        $value = null;
        if (isset($_REQUEST[$parameter])) {
            $value = trim(htmlspecialchars($_REQUEST[$parameter]));
        }
        if (empty($value)) {
            $value = filter_var($value, $validation);
        }
        return $value;
    }
}