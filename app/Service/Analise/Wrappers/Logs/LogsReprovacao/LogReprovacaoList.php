<?php

namespace App\Service\Analise\Wrappers\Logs\LogsReprovacao;

class LogReprovacaoList
{
    static public function get(string $code, string $lang = 'pt'): string
    {
        $pt = [
            '001' => 'Caractere pós inversão',
        ];

        return $$lang[$code] ?? "Log Error: code '$code' not search!";
    }
}
