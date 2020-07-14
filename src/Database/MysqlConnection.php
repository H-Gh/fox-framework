<?php

namespace Fox\Database;

use Fox\Helpers\ArrayHelper;
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
class MysqlConnection implements ConnectionInterface
{
    private $pdo;

    /**
     * MysqlConnection constructor.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * This method will find data from database
     *
     * @param string $select The select fields
     * @param string $table  The table name
     * @param string $query  The query to run
     *
     * @return array
     */
    public function find(string $select, string $table, ?string $query = null)
    {
        if (is_array($select)) {
            $select = implode(",", $select);
        }
        $prepared = $this->pdo->prepare("SELECT $select FROM $table $query");
        $prepared->execute();

        return $prepared->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * This method will find a record from database
     *
     * @param string $select The select fields
     * @param string $table  The table name
     * @param string $query  The query to run
     *
     * @return mixed
     */
    public function findOne(string $select, string $table, ?string $query = null)
    {
        if (is_array($select)) {
            $select = implode(",", $select);
        }
        $prepared = $this->pdo->prepare("SELECT $select FROM $table $query");
        $prepared->execute();

        return $prepared->fetch();
    }

    /**
     * This method will insert data to database
     *
     * @param string $table     The table name
     * @param array  $dataArray The data array to be insert
     *
     * @return bool
     */
    public function insert(string $table, array $dataArray)
    {
        $valuesNames = ArrayHelper::implode(array_keys($dataArray), ":");
        $columns = ArrayHelper::implode(array_keys($dataArray));
        $prefixedDataArray = ArrayHelper::addPrefixToKeys($dataArray, ":");
        $prepared = $this->pdo->prepare("INSERT INTO $table $columns VALUES $valuesNames");
        return $prepared->execute($prefixedDataArray);
    }
}