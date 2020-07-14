<?php

namespace Fox\Database;

use HGh\Helpers\ClassHelper;
use ReflectionException;

/**
 * The base model
 * PHP version >= 7.0
 *
 * @category Database
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class Model
{
    /**
     * The connection
     *
     * @var ConnectionInterface
     */
    private $connection;

    /**
     * @var array
     */
    private $findResult = [];

    protected $table;

    protected $primaryColumn;

    /**
     * Model constructor.
     *
     * @throws ReflectionException
     */
    public function __construct()
    {
        $this->connection = ConnectionSingleton::getInstance();
        $this->table = ClassHelper::getName(static::class) . "s";
    }

    /**
     * @param $columnName
     *
     * @return mixed
     */
    public function __get($columnName)
    {
        if (isset($this->findResult[$columnName])) {
            return $this->findResult[$columnName];
        }

        return null;
    }

    /**
     * @param mixed  $select
     * @param string $query
     *
     * @return Model
     */
    public function findByColumn($select, ?string $query = null)
    {
        $this->findResult = $this->connection->find($select, $this->table, $query);
        return $this;
    }

    /**
     * @param mixed $select
     * @param       $value
     *
     * @return Model
     */
    public function findOneByColumn($select, $value)
    {
        if (is_string($value)) {
            $value = "\"$value\"";
        }
        $this->findResult = $this->connection->findOne($select, $this->table, "WHERE " .
            $this->primaryColumn .
            "=" .
            $value);
        return $this;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->findResult;
    }

    /**
     * @param array $dataArray
     *
     * @return mixed
     */
    public function insertData(array $dataArray)
    {
        return $this->connection->insert($this->table, $dataArray);
    }

    /**
     * @return int
     */
    public function count()
    {
        if (!is_countable($this->findResult)) {
            return 0;
        }
        return count($this->findResult);
    }

    /**
     * @param        $select
     * @param string $query
     *
     * @return Model
     */
    public static function find($select, ?string $query = null)
    {
        return (new static())->findByColumn($select, $query);
    }

    /**
     * @param array $dataArray
     *
     * @return Model
     */
    public static function insert(array $dataArray)
    {
        return (new static())->insertData($dataArray);
    }

    /**
     * @param $select
     * @param $value
     *
     * @return Model
     */
    public static function findOne($select, $value)
    {
        return (new static())->findOneByColumn($select, $value);
    }
}