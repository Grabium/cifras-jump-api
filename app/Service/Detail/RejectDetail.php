<?php

namespace App\Service\Detail;

class RejectDetail
{
    /**
     * Create a new class instance.
     * Furturamente a lista devereá vir do DB.
     **/

    private static int|string $indiceAcordesAAnalisarQueue = '';
    private static array $logContent = [];

    private function __construct() {}

    //Analise
    public static function acordeID(int $indiceAcordesAAnalisarQueue)
    {
        self::reset();
        self::$indiceAcordesAAnalisarQueue = $indiceAcordesAAnalisarQueue;
    }

    private static function reset(): void
    {
        self::$indiceAcordesAAnalisarQueue = '';
        self::$logContent = [];
    }


    //ConcretesAnalise
    public static function log(string $codeMessage, string $method, string $line, string $sinal): void
    {

        $methodAndLine = "In $method" ?? "";
        $methodAndLine .= " - In line: $line." ?? "";

        

        $cause = RejectListDetail::get($codeMessage);

        $message = "The text part '" . $sinal . "'";

        if(self::$indiceAcordesAAnalisarQueue != ''){
            
            $indexCharater = self::getIndexCharater();
            $message .= "($indexCharater character)";

        }

        $message .= "  is not a cypher correctly written. Cause: $cause.";

        self::$logContent = ['message' => $message, 'methodAndLine' => $methodAndLine];
    }

    //incompleto, pois não leva em consideraçao os números como 11, 12, 21 ,22 ...
    private static function getIndexCharater(): string
    {
        $ordinal = ['1' => 'st', '2'=>'nd', '3'=>'rd'];

        try {
            $indexCharater = self::$indiceAcordesAAnalisarQueue.$ordinal[self::$indiceAcordesAAnalisarQueue];
        } catch (\Throwable $th) {
            $indexCharater = self::$indiceAcordesAAnalisarQueue.'th';
        }finally{
            return $indexCharater;
        }
    }

    //FinalSet/Negativo
    public static function getMessage(bool $dump = false): string
    {
        return ($dump) ? self::$logContent['message'] . ' ' . self::$logContent['methodAndLine'] : self::$logContent['message'];
    }
}
