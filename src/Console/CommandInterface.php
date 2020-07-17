<?php

namespace Fox\Console;

use Fox\Collection\CollectionInterface;

/**
 * The interface for the commands
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
interface CommandInterface
{
    /**
     * Get the namespace
     *
     * @return string
     */
    public function getNamespace(): string;

    /**
     * Get the signature
     *
     * @return string
     */
    public function getAction(): string;

    /**
     * Get the arguments
     *
     * @return CollectionInterface
     */
    public function getArguments(): CollectionInterface;

    /**
     * Run the command
     *
     * @param array $argumentsValues The array of arguments's values
     *
     * @return void
     */
    public function run(array $argumentsValues);
}
