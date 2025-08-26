<?php

namespace App\Service\Entidade\Acorde\Log;

class LogAcorde
{
    private string $message = '';
    private string $methodAndLine = '';

    public function set(string $message, string|null $methodAndLine = null): void
    {
        $this->message = $message;
        $this->methodAndLine = $methodAndLine ?? null ;
    }

    public function dump(): array
    {
        return ['message' => $this->message, 'metadata' => $this->methodAndLine];
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
