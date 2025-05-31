<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PreparacaoDados\PreparacaoDadosController;
use App\Http\Requests\MainRequest;
use App\Entidade\Texto\Texto;
use App\Service\Analise\Analise;

class MainController extends Controller
{
    private PreparacaoDadosController $preparacao;
    private Analise $analise;
    public string $textoOriginal;
    

    public function __construct(MainRequest $request)
    {
        $this->textoOriginal = new Texto($request->get('texto'))->textoOriginal;
        $this->preparacao = new PreparacaoDadosController();
        $this->analise = new Analise();
    }

    public function main()
    {
        $this->preparacao->preparar($this->textoOriginal);
        $this->analise->run();
    }
}
