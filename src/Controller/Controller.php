<?php

namespace Fox\Controller;

use Fox\Helpers\Url;

/**
 * The main class to define the controllers of application
 * PHP version >= 7.0
 *
 * @category Controller
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
abstract class Controller
{
    /**
     * Render a view
     *
     * @param string $viewPath  the view path
     * @param array  $dataArray The data array
     *
     * @return void
     */
    protected function render($viewPath, ?array $dataArray = null)
    {
        if (!empty($dataArray)) {
            extract($dataArray);
        }
        $layout = file_get_contents(Url::basePath("resources/views/layout.php"));
        $parts = explode("{{ CONTENTS }}", $layout);
        echo $parts[0];
        include(Url::basePath("resources/views/$viewPath.php"));
        echo $parts[1];
    }

    /**
     * Encode data to json and print
     *
     * @param array $dataArray The data array
     */
    protected function json(array $dataArray)
    {
        echo json_encode($dataArray);
    }
}