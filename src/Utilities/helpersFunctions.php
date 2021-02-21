<?php

use Fox\Config\ConfigManagerSingleton;

if (!function_exists("dd")) {
    /**
     * @param $data
     */
    function dd(...$data): void
    {
        var_dump($data);
        die();
    }
}

if (!function_exists("config")) {

    /**
     * @param string $key
     *
     * @return mixed
     */
    function config(string $key)
    {
        return ConfigManagerSingleton::getInstance()->get($key);
    }
}