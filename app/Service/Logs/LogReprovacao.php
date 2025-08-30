<?php

namespace App\Service\Logs;

class LogReprovacao
{
    /**
    * Create a new class instance.
    * Furturamente a lista devereá vir do DB.
    **/

    private static string $sinal;
    private static int|string $indiceAcordesAAnalisarQueue;
    private static array $logContent;

    private function __construct(){}

    //Analise
    public static function acordeID(int $indiceAcordesAAnalisarQueue, string $sinal)
    {
        self::reset();
        self::$indiceAcordesAAnalisarQueue = $indiceAcordesAAnalisarQueue;
        self::$sinal = $sinal;
    }

    private static function reset(): void
    {
        self::$sinal = '';
        self::$indiceAcordesAAnalisarQueue = '';
        self::$logContent = [];
    }
    

    //ConcretesAnalise
    public static function log(string $codeMessage, string $method, string $line): void
    {
        
        $methodAndLine = "In $method" ?? "";
        $methodAndLine .= " - In line: $line." ?? "";

        $cause = LogReprovacaoList::get($codeMessage);
        $message = "The chord '".self::$sinal."' (index: ".self::$indiceAcordesAAnalisarQueue.") was rejected. Cause: $cause.";

        self::$logContent = ['message' => $message, 'methodAndLine' => $methodAndLine];
    }

    //FinalSet/Negativo
    public static function getMessage(bool $dump = false): string
    {
        return ($dump) ? self::$logContent['message'].' '.self::$logContent['methodAndLine']: self::$logContent['message'];
    }
}
