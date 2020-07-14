<?php

namespace Fox\App;

use Dotenv\Dotenv;
use Fox\Console\CommandManager;
use Fox\Database\ConnectionSingleton;
use Fox\Database\ConnectorFactory;
use Fox\Exception\NotFoundException;
use Fox\Exception\Renderer\ExceptionRenderer;
use Fox\Helpers\Url;
use Fox\Router\Router;
use HGh\Handlers\Exception\Facades\Exception;
use Throwable;

/**
 * The application class which run the whole application
 * PHP version >= 7.0
 *
 * @category Application
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class Application
{
    public const RUN_ENV_CLI = 0;
    public const RUN_ENV_WEB = 1;
    public const ENV_DEVELOPMENT = 0;
    public const ENV_PRODUCTION = 1;

    /**
     * The instance of application
     *
     * @var Application
     */
    private static $application;

    /**
     * Application constructor.
     *
     * @throws NotFoundException
     */
    private function __construct()
    {
        session_start();

        $env = Dotenv::createImmutable(Url::basePath());
        $env->load();

        $databaseName = getenv("DATABASE");
        $connector = ConnectorFactory::create($databaseName);
        ConnectionSingleton::setConnector($connector);
    }

    /**
     * Get the instance of application
     *
     * @return Application
     */
    public static function get()
    {
        if (empty(self::$application)) {
            self::$application = new self();
        }
        return self::$application;
    }

    /**
     * Get the environment of app
     *
     * @return array|false|int|string
     */
    public static function env()
    {
        $environment = getenv("APP_ENV");
        if (empty($environment)) {
            $environment = self::ENV_DEVELOPMENT;
        } elseif ($environment == "production") {
            $environment = self::ENV_PRODUCTION;
        }
        return $environment;
    }

    /**
     * A flag to determine what if the app is on debug mode or not
     *
     * @return bool
     */
    public static function debug()
    {
        $debugFlag = getenv("APP_DEBUG");
        if (empty($debugFlag)) {
            $debugFlag = true;
        }
        return $debugFlag == "true";
    }

    /**
     * Run the application
     *
     * @param array $argv The arguments
     *
     * @return void
     * @throws Throwable
     */
    public function run(?array $argv = null)
    {
        try {
            switch (php_sapi_name()) {
                case "cli":
                    $this->runCli($argv);
                    break;
                default:
                    $this->runWeb();
            }
        } catch (Throwable $throwable) {
            $this->handleExceptions($throwable);
        }
    }

    /**
     * @param array|null $argv
     */
    private function runCli(?array $argv = null)
    {
        if (count($argv) == 1) {
            $this->listCommands();
        } else {
            $this->runCommand($argv);
        }
    }

    /**
     * List all commands
     */
    private function listCommands()
    {
        $commandManager = new CommandManager();
        foreach ($commandManager->commands() as $command) {
            echo $command->getSignature() . PHP_EOL;
        }
    }

    /**
     * Run a specific command
     *
     * @param array $argv The arguments
     */
    private function runCommand(array $argv)
    {
        $signature = $argv[1];
        $arguments = array_slice($argv, 2);
        $commandManager = new CommandManager();
        $commandManager->run($signature, $arguments);
    }

    /**
     * @throws NotFoundException
     */
    private function runWeb()
    {
        $router = new Router();
        $controllerNamespace = $router->getControllerNamespace();
        $controller = new $controllerNamespace();
        $action = $router->getAction();
        $controller->$action();
    }

    /**
     * Handle the throwable
     *
     * @param Throwable $throwable The throwable
     *
     * @return void
     * @throws Throwable
     */
    private function handleExceptions(Throwable $throwable)
    {
        (new ExceptionRenderer($throwable))->render();
        Exception::log($throwable, Url::basePath("storage/logs/exceptions.log"));
    }

    /**
     * @return int
     */
    public function getRunEnv()
    {
        if (php_sapi_name() == "cli") {
            return self::RUN_ENV_CLI;
        }
        return self::RUN_ENV_WEB;
    }

}
