<?php

namespace Fox\Database;

/**
 * The main database connector
 * PHP version >= 7.0
 *
 * @category Database
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class ConnectionSingleton
{
    /**
     * @var ConnectorInterface $connector
     */
    private static $connector = null;

    /**
     * @var self
     */
    private static $instance = null;

    /**
     * ConnectionSingleton constructor.
     */
    private function __construct()
    {
        self::$instance = self::$connector->connect();
    }

    /**
     * @return ConnectionInterface
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            new self();
        }

        return self::$instance;
    }

    /**
     * @param ConnectorInterface $connector
     *
     * @return void
     */
    public static function setConnector(ConnectorInterface $connector)
    {
        self::$connector = $connector;
    }
}