<?php

namespace Fox\Console;

use Fox\Collection\Collection;
use Fox\Collection\CollectionInterface;

/**
 * The command object that holds command data
 * PHP version >= 7.0
 *
 * @category Console
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class SignatureParser
{
    /**
     * The signature
     *
     * @var string
     */
    private $signature;

    /**
     * The action of signature
     *
     * @var string
     */
    private $action;

    /**
     * The arguments of signature
     *
     * @var CollectionInterface
     */
    private $arguments;

    /**
     * Signature constructor.
     *
     * @param string $signatureText
     */
    public function __construct(string $signatureText)
    {
        $this->signature = $signatureText;
        $this->setAction();
        $this->setArguments();
    }

    /**
     * @return void
     */
    private function setAction()
    {
        preg_match_all("/^([^{]+)\s{/", $this->signature, $matches);
        $this->action = isset($matches[1][0]) ? $matches[1][0] : null;
    }

    /**
     * Set the CommandArguments objects of the command
     *
     * @return void
     */
    private function setArguments()
    {
        # A pattern to find all the arguments text
        preg_match_all("/{([^}]+)}/", $this->signature, $matches);
        if ($this->shouldSetArguments($matches)) {
            $argumentsTextList = $matches[1];
            $this->arguments = new Collection();
            foreach ($argumentsTextList as $argumentText) {
                $commandArgument = CommandArgumentFactory::create($argumentText);
                $this->arguments->add($commandArgument, $commandArgument->getName());
            }
        }
    }

    /**
     * @param $matches
     *
     * @return bool
     */
    private function shouldSetArguments($matches): bool
    {
        return !empty($this->signature) && isset($matches[1]);
    }

    /**
     * Get the action
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
}
