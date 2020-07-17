<?php

namespace Fox\Console;

/**
 * The class to hold the arguments data
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class CommandArgument implements CommandArgumentInterface
{
    /**
     * The name of argument
     *
     * @var string
     */
    private $name;

    /**
     * A flag to determine what if the argument is mandatory or not
     *
     * @var bool
     */
    private $isMandatory = true;

    /**
     * The value of argument
     *
     * @var string
     */
    private $value;

    /**
     * Parameter constructor.
     *
     * @param string $name The name of argument
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Set the flag to determine what if the argument is mandatory or not
     *
     * @param bool $isMandatory The mandatory flag
     *
     * @return CommandArgument
     */
    public function setIsMandatory(bool $isMandatory): CommandArgument
    {
        $this->isMandatory = $isMandatory;
        return $this;
    }

    /**
     * Get the mandatory flag
     *
     * @return bool
     */
    public function isMandatory(): bool
    {
        return $this->isMandatory;
    }

    /**
     * Get the name of argument
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of argument
     *
     * @param string $value The value to be set
     *
     * @return CommandArgumentInterface
     */
    public function setValue(?string $value)
    {
        if ($this->isMandatory && empty($value)) {
            echo "The " . $this->getName() . " is required.";
            exit;
        }
        $this->value = $value;
        return $this;
    }

    /**
     * Get the value of argument
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
