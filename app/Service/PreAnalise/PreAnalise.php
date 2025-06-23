<?php
namespace App\Service\PreAnalise;

use App\Http\Requests\MainRequest;
use App\Service\Entidade\Texto\Texto;
use App\Service\Entidade\Acorde\Cifra\CifrasQueue;
use App\Service\Analise\Analise;

class PreAnalise
{

    private MainRequest $request;

    public function __construct(MainRequest $request)
    {
        $this->request = $request;
    }

    public function textoFactory()
    {
        return new Texto($this->request->get('texto'));
    }

    public function getAcordesQueue(string $texto): array
    {
        $regex = '[ABCDEFG][^\s]*[\t\n\s\r]';//tudo até o primeiro espaço.
        preg_match_all('/'.$regex.'/ ', $texto, $matches, PREG_OFFSET_CAPTURE);
        return (new CifrasQueue())->enfileirarAcordes($matches[0]);
    }

    public function analiseFactory(array $acordesQueue)
    {
        return new Analise($acordesQueue);
    }

    public function conversorFactory()
    {
        //return new Conversor($this->request->get('fator'));
    }
}