<?php 
namespace Tests\Unit\Service\Analise\Analise;

use App\Service\Analise\Analise\AnaliseIterador;
use App\Service\Analise\Wrappers\Wrapper;
use App\Service\Entidade\Acorde\Acorde;
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
        $acorde = new Acorde();
        $acorde->set($actual);
        $wrapper = new Wrapper($acorde);
        $analiseIterador = new AnaliseIterador($wrapper);

        

        $this->assertEquals($expected, $analiseIterador->analisar());
    }

    public static function dataProviders(): array
    {

        //'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE'
        return [
            'C - apr'    => ['C ', 'INSERIR_EM_APROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'CC - rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],

        ];
    }
}
