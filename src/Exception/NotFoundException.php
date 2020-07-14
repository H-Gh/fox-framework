<?php

namespace Fox\Exception;

use HGh\Handlers\Exception\Exceptions\BaseException;
use HGh\Handlers\Exception\Interfaces\ShouldPublish;
use Throwable;

/**
 * The main exception for not found exceptions in app
 * PHP version >= 7.0
 *
 * @category Exception
 * @package  Fox
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     null
 */
class NotFoundException extends BaseException implements ShouldPublish
{
    /**
     * CasinoException constructor.
     *
     * @param string         $message  The message of Exception
     * @param int            $code     The code of Exception
     * @param Throwable|null $previous The previous throwable used for the exception chaining.
     */
    public function __construct(
        $message = "Not found.",
        $code = 404,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
