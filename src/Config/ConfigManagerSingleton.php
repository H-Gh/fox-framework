<?php

namespace Fox\Config;

use Fox\Helpers\Url;

/**
 * This class will manage config files
 * PHP version >= 7.0
 *
 * @category Config
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class ConfigManagerSingleton
{
    /**
     * @var $this
     */
    private static $instance;

    private array $configs = [];

    /**
     * @return ConfigManagerSingleton
     */
    public static function getInstance(): ConfigManagerSingleton
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        $explodedKey = explode(".", $key);
        if (is_array($explodedKey) && !empty($explodedKey)) {
            $fileName = $explodedKey[0];
            $configKey = isset($explodedKey[1]) ? $explodedKey[1] : null;
            if (!isset($this->configs[$fileName])) {
                $this->setConfig($fileName, $configKey);
            }
            return !empty($configKey) ? $this->configs[$fileName][$configKey] : $this->configs[$fileName];
        }
        return null;
    }

    /**
     * @param mixed       $fileName
     * @param string|null $configKey
     */
    private function setConfig(string $fileName, ?string $configKey): void
    {
        $filePath = Url::basePath("config/$fileName.php");
        if (file_exists($filePath)) {
            $config = include_once $filePath;
            if (!empty($configKey)) {
                $this->configs[$fileName] = $config[$configKey];
            }
            $this->configs[$fileName] = $config;
        }
    }
}
