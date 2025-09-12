<?php declare(strict_types=1);
namespace Tests\Unit\Service\Entidade\Acorde\Composite;

use App\Service\Entidade\Acorde\Composite\IntervaloComposite;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;


/**
 * Roda com o comando:
 * ./vendor/bin/phpunit --testdox tests/Unit/Service/Entidade/Acorde/Composite/IntervaloCompositeTest.php
 */

class IntervaloCompositeTest extends TestCase
{
    #[DataProvider('dataProviders')]
    #[TestDox('Inserindo o intervalo $actual e retornando $expected.')]
    public function testInserirApenasUmIntervalo(mixed $actual, string $expected): void
    {
        $intervalo = new IntervaloComposite();

        if($actual == null){
            $intervalo->set();
        }else{
            $intervalo->set($actual);
        }

        $this->assertEquals($expected, $intervalo->get());
    }

    public static function dataProviders(): array
    {
        return [
            'sem parâm => NaoTestado'    => [null, 'NaoTestado'],
            'string vazia => NaoTestado' => ['', 'NaoTestado'],
            'string b2'                  => ['b2', 'b2'],
            'integer 6'                  => [6, '6'],
            'integer 16 => NaoTestado'   => [16, 'NaoTestado'],
            'string #4'                  => ['#4', '#4'],
            'string 7-'                  => ['7-', '7-'],
            'string b10'                 => ['b10', 'b10'],
            'string 13+'                 => ['13+', '13+'],
            'string b => NaoTestado'     => ['b', 'NaoTestado'],
            'string 1 => NaoTestado'     => ['1', 'NaoTestado'],
            'string 0 => NaoTestado'     => ['0', 'NaoTestado'],
            'bool false => NaoTestado'   => [false, 'NaoTestado'],
            'bool true => NaoTestado'    => [true, 'NaoTestado']
        ];
    }
}
