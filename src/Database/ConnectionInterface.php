<?php

namespace Fox\Database;

/**
 * The main interface for connections of databases
 * PHP version >= 7.0
 *
 * @category Database
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
interface ConnectionInterface
{
    /**
     * This method will find data from database
     *
     * @param mixed  $select The select fields
     * @param string $table  The table name
     * @param string $query  The query to run
     *
     * @return array
     */
    public function find(string $select, string $table, ?string $query = null);

    /**
     * This method will find a record from database
     *
     * @param string $select The select fields
     * @param string $table  The table name
     * @param string $query  The query to run
     *
     * @return mixed
     */
    public function findOne(string $select, string $table, ?string $query = null);

    /**
     * This method will insert data to database
     *
     * @param string $table     The table name
     * @param array  $dataArray The data array to be insert
     *
     * @return bool
     */
    public function insert(string $table, array $dataArray);
}