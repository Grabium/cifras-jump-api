<?php 
namespace Tests\Unit\Service\Entidade\Acorde\Composite;

use App\Service\Entidade\Acorde\Composite\IntervaloComposite;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class IntervaloCompositeTest extends TestCase
{
    /**
     * @dataProvider dataProviders
     * @group unitarios
     */
    public function testInserirApenasUmIntervalo(mixed $key, string $expected): void
    {
        $intervalo = new IntervaloComposite();

        if($key == null){
            $intervalo->set();
        }else{
            $intervalo->set($key);
        }
        

        $this->assertSame($expected, $intervalo->get());
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
