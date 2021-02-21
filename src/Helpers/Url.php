<?php

namespace Fox\Helpers;

/**
 * A helper to help the application to manage the urls
 * PHP version >= 7.0
 *
 * @category Helper
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class Url
{
    /**
     * Get the base path
     *
     * @param string $path Relative path from base of app
     *
     * @return string
     */
    public static function basePath(string $path = "")
    {
        return __DIR__ . "/../../../../../$path";
    }

    /**
     * Redirect page to another URL
     *
     * @param string $url The URL
     */
    public static function redirect(string $url)
    {
        header("Location: $url");
    }

    /**
     * Generate the URL string
     *
     * @param string $url The URL
     *
     * @return string
     */
    public static function to(string $url)
    {
        $baseFolder = pathinfo(realpath(self::basePath()));
        return sprintf("%s://%s%s", isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'], "/" . $baseFolder["basename"] . "/" . $url);
    }
}