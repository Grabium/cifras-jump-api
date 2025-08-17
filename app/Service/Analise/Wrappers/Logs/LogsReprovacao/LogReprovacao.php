<?php

namespace App\Service\Analise\Wrappers\Logs\LogsReprovacao;

//use App\Service\Entidade\Acorde\Acorde;

class LogReprovacao
{
    /**
     * Create a new class instance.
     * Furturamente a lista devereá vir do DB.
     */
    public function __construct(int $indiceAcordesAAnalisarQueue, string $sinal)
    {
        //
    }

    public function log(int $code, array $info = null, bool $dump = false): void
    {
        //
    }
}
