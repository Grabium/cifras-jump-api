<?php
namespace App\Http\Controllers;

use App\Http\Requests\MainRequest;
use App\Service\Entidade\Texto\Texto;
use App\Service\PreAnalise\PreAnalise;
use App\Service\Analise\Analise;

class MainController extends Controller
{
    private PreAnalise $preAnalise;
    private Texto $textoObj;
    private Analise $analise;

    public function __construct(MainRequest $request)
    {
        $this->preAnalise = new PreAnalise($request);
    }

    public function main()
    {
        $this->preparar();
        $this->analise->run();
    }

    private function preparar()
    {
        $this->textoObj = $this->preAnalise->textoFactory();
        $acordesQueue = $this->preAnalise->getAcordesQueue($this->textoObj->textoOriginal);
        $this->analise = $this->preAnalise->analiseFactory($acordesQueue);
    }
}
