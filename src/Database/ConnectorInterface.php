<?php

namespace Fox\Database;

/**
 * The main interface for connectors of databases
 * PHP version >= 7.0
 *
 * @category Database
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
interface ConnectorInterface
{
    /**
     * Connect to database
     *
     * @return mixed
     */
    public function connect();
}