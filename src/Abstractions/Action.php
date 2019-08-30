<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Abstractions;


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
        $this->payload = $payload;

        return bool_catch(function () {
            $this->result = $this->action();
        }, $this->exception);
    }

    protected function payload()
    {
        return $this->payload;
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