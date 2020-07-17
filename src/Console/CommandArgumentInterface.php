<?php

namespace Fox\Console;

use Fox\Exception\RequiredArgumentException;

/**
 * The interface for the command argument
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
interface CommandArgumentInterface
{
    /**
     * Get the name of argument
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the mandatory flag
     *
     * @return bool
     */
    public function isMandatory(): bool;

    /**
     * Set the value of argument
     *
     * @param string $value The value to be set
     *
     * @return CommandArgumentInterface
     */
    public function setValue(?string $value);

    /**
     * Get the value of argument
     *
     * @return string
     */
    public function getValue();
}
