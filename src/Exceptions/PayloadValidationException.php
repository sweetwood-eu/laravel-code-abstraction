<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Exceptions;


use Throwable;

class PayloadValidationException extends \Exception
{
    protected $payload;

    public function getPayload()
    {
        return $this->payload;
    }

    public function setPayload($payload): self
    {
        $this->payload = $payload;
        return $this;
    }
}