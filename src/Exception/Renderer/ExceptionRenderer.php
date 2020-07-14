<?php

namespace Fox\Exception\Renderer;

use Fox\App\Application;
use Throwable;

/**
 * The main class to handle the exceptions
 * PHP version >= 7.0
 *
 * @category Exception
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class ExceptionRenderer
{
    /**
     * The throwable
     *
     * @var Throwable
     */
    private $throwable;

    /**
     * ExceptionHandler constructor.
     *
     * @param Throwable $throwable The throwable
     */
    public function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
    }

    /**
     * @return $this
     * @throws Throwable
     */
    public function render()
    {
        switch (Application::get()->getRunEnv()) {
            case Application::RUN_ENV_CLI:
                $this->renderForCli();
                break;
            default:
                $this->renderForWeb();
        }
        return $this;
    }

    /**
     * Render the throwable for CLI
     *
     * @throws Throwable
     */
    private function renderForCli(): void
    {
        throw $this->throwable;
    }

    /**
     * Render the throwable for the web
     */
    private function renderForWeb(): void
    {
        $throwable = $this->throwable;
        if (Application::debug()) {
            include(__DIR__ . "/fullExceptionView.php");
        } else {
            include(__DIR__ . "/minimalExceptionView.php");
        }
    }
}
