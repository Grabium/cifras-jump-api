<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Service\Analise\Analise\AnaliseIterador;

class ExampleTest extends TestCase
{
    /**
     * @dataProviders dataProviders
     * @group feature
     */
    public function testAcordePorAcorde(string $key, string $expected): void
    {
        $fator = 1;
        $formulario = ['texto' => [$key[0]], 'fator'=> $fator];
        $response = $this->post('/api/main', $formulario);


        //$response->assertStatus(200); // Verifica se a resposta é 200 OK

        //Dica: depure $response antes de seguir.
        //dd($response);
        //$this->assertSame($expected, $response->get());
        

        //Falta o retorno do MainController ao invés de um "dd('Acordes aprovados: ',$this->queues->getAprovados());" em App/Http/Service/Analise/Analise.php line:52

    }

    public function dataProviders(): array 
    {
        return [
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
            'caso' => ['input','output'],
        ];
    }
}
