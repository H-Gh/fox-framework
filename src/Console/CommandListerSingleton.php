<?php

namespace Fox\Console;

use Fox\Collection\Collection;
use Fox\Exception\NotFoundException;
use Fox\Helpers\Url;

/**
 * The class to list the commands
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class CommandListerSingleton
{
    /**
     * The instance of the class
     *
     * @var $this
     */
    private static $instance;

    /**
     * The list of commands
     *
     * @var Collection
     */
    private $commands;

    /**
     * CommandListerSingleton constructor.
     */
    private function __construct()
    {
        $this->setCommands();
    }

    /**
     * Fill the commands collection
     *
     * @return void
     */
    private function setCommands()
    {
        $this->commands = new Collection();
        $paths = glob(Url::basePath("app/Console/Commands/*.php"));
        foreach ($paths as $path) {
            $classNamespace = $this->getNamespace($path);
            if ($this->hasSignature($classNamespace)) {
                $signatureParser = new SignatureParser($classNamespace::SIGNATURE);
                $command = new Command($signatureParser->getAction(), $signatureParser->getArguments(), $classNamespace);
                $this->commands->add($command, $signatureParser->getAction());
            }
        }
    }

    /**
     * Get the instance of the class
     *
     * @return CommandListerSingleton
     */
    public static function get()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get the namespace of the class
     *
     * @param string $path The file path
     *
     * @return string
     */
    private function getNamespace($path): ?string
    {
        $pathInfo = pathinfo($path);
        if (empty($pathInfo["filename"])) {
            return null;
        }
        $classNamespace = "App\Console\Commands\\" . $pathInfo["filename"];
        if (!class_exists($classNamespace)) {
            return null;
        }
        return $classNamespace;
    }

    /**
     * Check what if the class has a command signature or not
     *
     * @param string|null $classNamespace The class namespace
     *
     * @return bool
     */
    private function hasSignature(?string $classNamespace): bool
    {
        return defined($classNamespace . '::SIGNATURE') && !empty($classNamespace::SIGNATURE);
    }

    /**
     * Return all commands collection
     *
     * @return Collection|CommandInterface[]
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Get a specific signature
     *
     * @param string $action
     *
     * @return CommandInterface
     */
    public function find(string $action)
    {
        return $this->commands->get($action);
    }

    /**
     * Get a specific signature
     *
     * @param string $action
     *
     * @return CommandInterface
     * @throws NotFoundException
     */
    public function findOrFail(string $action)
    {
        $command = $this->find($action);
        if(empty($command)) {
            throw new NotFoundException("Command not found.");
        }
        return $command;
    }
}
