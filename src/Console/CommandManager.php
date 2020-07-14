<?php

namespace Fox\Console;

use Fox\Collection\Collection;
use Fox\Helpers\Url;

/**
 * The main file to handle the console requests
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class CommandManager
{
    /**
     * Return all commands array
     *
     * @return Collection|Command[]
     */
    public function commands()
    {
        $commands = new Collection();
        $paths = glob(Url::basePath("app/Console/Commands/*.php"));
        foreach ($paths as $path) {
            $classNamespace = $this->getNamespace($path);
            if ($this->hasSignature($classNamespace)) {
                $commands->add(new Command($classNamespace));
            }
        }
        return $commands;
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
        return defined($classNamespace . '::SIGNATURE');
    }

    /**
     * Run a command
     *
     * @param string $signature The command signature
     * @param array  $arguments The arguments to path to the command
     */
    public function run(string $signature, array $arguments)
    {
        $commands = $this->commands();
        foreach ($commands as $command) {
            if ($command->getSignature() == $signature) {
                $namespace = $command->getNamespace();
                $commandInstance = new $namespace($arguments);
                $commandInstance->run();
            }
        }
    }
}
