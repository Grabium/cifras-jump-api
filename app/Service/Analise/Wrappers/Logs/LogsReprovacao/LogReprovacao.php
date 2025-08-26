<?php

namespace App\Service\Analise\Wrappers\Logs\LogsReprovacao;

//use App\Service\Entidade\Acorde\Acorde;

class LogReprovacao
{
    /**
     * Create a new class instance.
     * Furturamente a lista devereá vir do DB.
    **/

    private string $sinal;
    private int|string $indiceAcordesAAnalisarQueue;
    private array $logContent;

    public function __construct(int $indiceAcordesAAnalisarQueue, string $sinal)
    {
        $this->indiceAcordesAAnalisarQueue = $indiceAcordesAAnalisarQueue;
        $this->sinal = $sinal;
    }
    

    public function log(int $code, string|null $method = null, string|null $line = null): void
    {
        $methodAndLine = "In $method" ?? "";
        $methodAndLine .= " - In line: $line." ?? "";

        $cause = LogReprovacaoList::get($code);
        $message = "The chord '$this->sinal' ($this->indiceAcordesAAnalisarQueue) was rejected. Cause: $cause.";

        $this->logContent = ['message' => $message, 'metadata' => $methodAndLine];
    }

    public function getMessage(bool $dump = false): string|array
    {
        return ($dump) ? $this->logContent['message'] : $this->logContent;
    }

    public function print(): void
    {
        echo $this->logContent["metadata"].' '.$this->logContent["message"].PHP_EOL;
    }
}
