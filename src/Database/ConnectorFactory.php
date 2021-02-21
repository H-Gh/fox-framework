<?php

namespace Fox\Database;

use Fox\Exception\NotFoundException;

/**
 * The factory to create a connector to a database
 * PHP version php >= 7.0
 *
 * @category Database
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class ConnectorFactory
{
    /**
     * @param string $databaseName The database name, like mysql or mongo
     *
     * @return ConnectorInterface
     * @throws NotFoundException
     */
    public static function create($databaseName = null)
    {
        $namespace = "Fox\Database\\" . ucfirst(strtolower($databaseName)) . "Connector";
        if (class_exists($namespace)) {
            return new $namespace();
        }
        throw new NotFoundException("The connector was not found.");
    }
}
