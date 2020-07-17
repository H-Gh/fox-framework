<?php

namespace Fox\Console;

use Fox\Collection\CollectionInterface;

/**
 * The command object that holds command data
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class Command implements CommandInterface
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
    private $action;

    /**
     * The arguments of command
     *
     * @var CollectionInterface|CommandArgumentInterface[]
     */
    private $arguments;

    /**
     * Command constructor.
     *
     * @param string                                         $action    The action of command
     * @param CollectionInterface|CommandArgumentInterface[] $arguments The arguments
     * @param string                                         $namespace The command namespace
     */
    public function __construct(string $action, CollectionInterface $arguments, string $namespace)
    {
        $this->action = $action;
        $this->arguments = $arguments;
        $this->namespace = $namespace;
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
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Get the arguments
     *
     * @return CollectionInterface
     */
    public function getArguments(): CollectionInterface
    {
        return $this->arguments;
    }

    /**
     * Run the command
     *
     * @param array $argumentsValues The array of arguments's values
     *
     * @return void
     */
    public function run(array $argumentsValues)
    {
        $this->addValuesToArguments($argumentsValues);
        $namespace = $this->getNamespace();
        $commandInstance = new $namespace($this->arguments);
        $commandInstance->run();
    }

    /**
     * Set the values to the arguments
     *
     * @param array $argumentsValues The values t be assign to the arguments
     *
     * @return void
     */
    private function addValuesToArguments(array $argumentsValues)
    {
        $index = 0;
        foreach ($this->arguments as $argument) {
            $value = $argumentsValues[$index] ?? null;
            $argument->setValue($value);
            $index++;
        }
    }
}
