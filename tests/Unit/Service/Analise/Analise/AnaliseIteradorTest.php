<?php 
namespace Tests\Unit\Service\Analise\Analise;

use App\Service\Analise\Analise;
use App\Service\Entidade\Acorde\Acorde;
use App\Service\Entidade\Acorde\Cifra\Cifra;
use App\Service\Queues\GerenciadorQueues;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

//./vendor/bin/phpunit --testdox Tests/Unit/Service/Analise/Analise/AnaliseIteradorTest.php

class AnaliseIteradorTest extends TestCase
{
    #[DataProvider('dataProviders')]
    #[TestDox('Analise de $actual deve retornar a action $expected')]
    public function testAnalisar(string $actual, string $expected): void
    {        
        $cifra = new Cifra($actual);
        //dump($cifra);
        $acorde = new Acorde($cifra);
        //dump($acorde);
        $indiceAcordesAAnalisarQueue = 1;
        $analise = new Analise(new GerenciadorQueues());
        //dump($analise);
        $analiseIterador = $analise->factoryAnaliseIterador($acorde, $indiceAcordesAAnalisarQueue);
        //dump($analiseIterador);

        $this->assertEquals($expected, $analiseIterador->analisar());
    }

    public static function dataProviders(): array
    {

        //'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE'
        return [
            'C ok'    => ['C ', 'INSERIR_EM_APROVADO'],//TRAVA O TESTE SEM O ESPAÇO NO FINAL. 
            'CC Rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],

        ];
    }
}
