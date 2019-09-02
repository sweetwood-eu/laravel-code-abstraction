<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Abstractions;


use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use SweetwoodEU\Laravel\CodeAbstraction\Exceptions\PayloadValidationException;

abstract class Action
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        return bool_catch(function () use ($payload) {
            if ($payload) {
                $this->setPayload($payload);
            }

            $this->result = $this->action();
        }, $this->exception);
    }

    public function handle()
    {
        if (!$this->run()) {
            $this->resultOrThrow();
        }
    }

    protected function payload()
    {
        return $this->payload;
    }

    public function setPayload($payload = null): self
    {
        if (!$this->validatePayload($payload)) {
            throw (new PayloadValidationException("Payload could not be validated."))->setPayload($payload);
        }

        $this->payload = $payload;
        return $this;
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