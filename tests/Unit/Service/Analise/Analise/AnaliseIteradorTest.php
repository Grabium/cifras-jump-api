<?php 
namespace Tests\Unit\Service\Analise\Analise;

use App\Service\Analise\Analise;
use App\Service\Entidade\Acorde\Acorde;
use App\Service\Entidade\Acorde\Cifra\Cifra;
use App\Service\Queues\GerenciadorQueues;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class AnaliseIteradorTest extends TestCase
{
    #[DataProvider('dataProviders')]
    public function testAnalisar(string $input, string $expected): void
    {
        //dump('novo teste =====', $input, $expected);
        
        $cifra = new Cifra($input);
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
            'C ok'    => ['C ', 'INSERIR_EM_APROVADO'],
            'CC Rep'    => ['CC ', 'INSERIR_EM_REPROVADO'],
            'C ok error'    => ['C ', 'error'],
        ];
    }
}
