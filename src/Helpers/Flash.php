<?php

namespace Fox\Helpers;

/**
 * A helper to help application to manage the flash messages
 * PHP version >= 7.0
 *
 * @category Helper
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class Flash
{
    /**
     * Add flash message to session
     *
     * @param string $key   The key of flash message
     * @param mixed  $value The value of flash message
     */
    public static function addFlash($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get the flash message from session
     *
     * @param string $key The key of flash
     *
     * @return mixed
     */
    public static function getFlash($key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }

        return null;
    }
}