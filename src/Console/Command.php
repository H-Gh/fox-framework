<?php

namespace Fox\Console;

/**
 * The command object that holds command data
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class Command
{
    /**
     * The command class namespace
     *
     * @var string
     */
    private $namespace;

    /**
     * The signature of command
     *
     * @var string
     */
    private $signature;

    /**
     * Command constructor.
     *
     * @param string $namespace The command namespace
     */
    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
        $this->signature = $namespace::SIGNATURE;
    }

    /**
     * Get the namespace
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Get the signature
     *
     * @return string
     */
    public function getSignature(): string
    {
        return $this->signature;
    }


}
