<?php

namespace Fox\Console;

use Fox\Collection\Collection;

/**
 * The abstract class of console
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
abstract class Console
{
    public const SIGNATURE = null;

    /**
     * The arguments collection
     *
     * @var Collection|CommandArgumentInterface[]
     */
    private $arguments;

    /**
     * Console constructor.
     *
     * @param Collection|CommandArgumentInterface[] $arguments The arguments collection
     */
    public function __construct(Collection $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @param string $argumentName
     *
     * @return string
     */
    public function argument(string $argumentName)
    {
        /** @var CommandArgumentInterface $argument */
        $argument = $this->arguments->get($argumentName);
        return $argument->getValue();
    }
}
