<?php

namespace Fox\Router;

use Fox\Exception\NotFoundException;

/**
 * The main router class to manage the urls and route them to correct controller automatically
 * PHP version >= 7.0
 *
 * @category Helper
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class Router
{
    /**
     * The URL
     *
     * @var string
     */
    private $url;

    /**
     * @var
     */
    private $sections;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];
        $this->setSections();
    }

    /**
     * Explode the URL to sections
     *
     * @return void
     */
    private function setSections()
    {
        $sections = explode("/", $this->url);
        $key = array_search(getenv("BLOG_NAME"), $sections);
        unset($sections[$key]);
        $this->sections = array_values(array_filter($sections));
    }

    /**
     * Get the controller namespace
     *
     * @return string
     * @throws NotFoundException
     */
    public function getControllerNamespace()
    {
        if (isset($this->sections[0]) && !empty($this->sections[0])) {
            $controllerName = $this->sections[0];
        } else {
            throw new NotFoundException();
        }
        $controllerNamespace = "App\\Http\\Controllers\\" . ucfirst($controllerName) . "Controller";
        if (!class_exists($controllerNamespace)) {
            throw new NotFoundException();
        }
        return $controllerNamespace;
    }


    /**
     * Get the action name
     *
     * @return string
     */
    public function getAction()
    {
        if (isset($this->sections[1]) && !empty($this->sections[1])) {
            $sections = explode("?", $this->sections[1]);
            $actionName = $sections[0];
        } else {
            $actionName = "index";
        }
        return $actionName;
    }
}