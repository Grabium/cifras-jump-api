<?php declare(strict_types=1);
namespace Tests\Unit\Service\Analise\Analise;

use App\Service\Analise\Analise\AnaliseIterador;
use App\Service\Analise\Wrappers\Wrapper;
use App\Service\Entidade\Acorde\Acorde;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

//./vendor/bin/phpunit --testdox Tests/Unit/Service/Analise/Analise/AnaliseIteradorTest.php

class AnaliseIteradorTest extends TestCase
{
    
    

    #[DataProvider('dataProviders')]
    public function testInstanciarAcorde(array $actual, array $expected): array
    {
        $acorde = new Acorde();
        $acorde->set($actual[0], $actual[1]);

        $this->assertEquals($expected[0], $acorde->get());

        return ['acorde' => $acorde, 'expected' => $expected[1]];
    }
    
    
    //#[TestDox('Analise de $acordeEComandodoIterador["acorde"] deve retornar a action $acordeEComandodoIterador["expected"]')]
    #[Depends('testInstanciarAcorde')]
    public function testAnalisar(array $acordeEComandodoIterador): void
    {   
        $wrapper = new Wrapper($acordeEComandodoIterador['acorde']);
        $analiseIterador = new AnaliseIterador($wrapper);

        $this->assertEquals($acordeEComandodoIterador['expected'], $analiseIterador->analisar());
    }

    public static function dataProviders(): array
    {
        return [

            //Aprovados.
            'C'     => [['C ', false], ['C ', 'INSERIR_EM_APROVADO']],
            'F2/b10'    => [['F2/b10 ', false], ['F2/b10 ', 'INSERIR_EM_APROVADO']],
            'C#m5-'    => [['C#m5- ', false], ['C#m5- ', 'INSERIR_EM_APROVADO']],
            'Dm/Bb'    => [['Dm/Bb ', false], ['Dm/Bb ', 'INSERIR_EM_APROVADO']],
            'Am'    => [['Am ', false], ['Am ', 'INSERIR_EM_APROVADO']],
            'Am7'    => [['Am7 ', false], ['Am7 ', 'INSERIR_EM_APROVADO']],
            'Bdim'    => [['Bdim ', false], ['Bdim ', 'INSERIR_EM_APROVADO']],
            'Bbdim'    => [['Bbdim ', false], ['Bbdim ', 'INSERIR_EM_APROVADO']],
            'C sem espaco mas forcado'    => [['C', true], ['C ', 'INSERIR_EM_APROVADO']],



            //Reprovados.
            'Abuntu'    => [['Abuntu ', false], ['Abuntu ', 'INSERIR_EM_REPROVADO']],
            'CC'    => [['CC ', false], ['CC ', 'INSERIR_EM_REPROVADO']],
            'A sem espaco'    => [['A', false], ['INVALID ', 'INSERIR_EM_REPROVADO']]

        ];
    }
}
