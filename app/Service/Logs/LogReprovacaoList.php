<?php

namespace App\Service\Logs;

class LogReprovacaoList
{
    public static function get(string $code, string $lang = 'pt'): string
    {
        $pt = [
            '001' => 'Caractere pós inversão',
            '002' => 'Intervalo duplicado',
            '003' => 'Inconsistência na análise de intervalos',
            '004' => 'Parêntesis sucedendo outro parêntesis ou uma barra',
            '005' => 'Fecha parêntesis indevido',
            '006' => 'Barras duplicadas',
            '007' => 'Aguardando o segundo algarismo para completar a análise de intervalo',
            '008' => 'Aguardando o algarismo suceder o # ou b para intervalo',

            '009' => 'Sem análise para este caractere',
            '010' => 'Caractere "d" inserido indevidamente',
            '011' => 'Caractere ")" inserido indevidamente',
            '012' => 'Inversão não segue adequadamente a barra',
            '013' => 'Caractere "m" inserido indevidamente',
            '014' => 'Caractere "m" posicionado indevidamente',

            '015' => 'Caractere indevido para análise de intervalos',
            '016' => 'Caractere "#" ou "b" seguindo outro caractere "#" ou "b"',
            '017' => 'Caractere entre "2" e "9" duplicado ou inserido indevidamente após o caractere "1"',
            '018' => 'Caracetere "+" ou "-" inserido indevidamente',
            '019' => 'Caractere "1" inserido indevidamente',

            
        ];

        return $$lang[$code] ?? "Log Error: code '$code' not search!";
    }
}
