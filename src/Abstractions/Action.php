<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Abstractions;


use SweetwoodEU\Laravel\CodeAbstraction\Exceptions\PayloadValidationException;

abstract class Action
{
    private $payload;
    private $result;
    private $exception;

    abstract protected function action();

    public function __invoke($payload = null): bool
    {
        return $this->run($payload);
    }

    public function run($payload = null): bool
    {
        if (!$this->validatePayload($payload)) {
            $this->exception = (new PayloadValidationException("Payload could not be validated."))->setPayload($payload);
            return false;
        }

        $this->payload = $payload;

        return bool_catch(function () {
            $this->result = $this->action();
        }, $this->exception);
    }

    protected function payload()
    {
        return $this->payload;
    }

    protected function validatePayload($payload): bool
    {
        return true;
    }

    public function result()
    {
        return $this->result;
    }

    public function resultOrThrow()
    {
        if ($this->exception) {
            throw $this->exception;
        }

        return $this->result();
    }

    public function exception()
    {
        return $this->exception;
    }
}