<?php

namespace Fox\Database;

use PDO;

/**
 * The mysql connection to a mysql database
 * PHP version >= 7.4
 *
 * @category Database
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class MysqlConnector implements ConnectorInterface
{

    /**
     * Connect to database
     *
     * @return mixed
     */
    public function connect()
    {
        return new MysqlConnection(new PDO('mysql:host=' . getenv("MYSQL_HOST") . ';dbname=' . getenv("MYSQL_DATABASE"),
                getenv("MYSQL_USERNAME"), getenv("MYSQL_PASSWORD")));
    }
}