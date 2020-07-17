<?php

namespace Fox\Console;

/**
 * The class to hold the arguments data
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class CommandArgumentFactory
{
    /**
     * Create an instance of command argument
     *
     * @param string $argumentText
     *
     * @return CommandArgumentInterface
     */
    public static function create(string $argumentText)
    {
        preg_match_all("/^(\?)?(.*)/", $argumentText, $matches);
        $commandArgument = new CommandArgument($matches[2][0]);
        if (isset($matches[1][0]) && !empty($matches[1][0])) {
            $commandArgument->setIsMandatory(false);
        }
        return $commandArgument;
    }
}
