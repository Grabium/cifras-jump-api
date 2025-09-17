<?php

namespace App\Service\Analise\Analise;

use App\Service\Analise\AnaliseList;
use App\Service\Analise\Wrappers\Wrapper;
use App\Service\Detail\RejectDetail;

/***
 * Serve de interface da abstração AnaliseAbstract
 */
class AnaliseIterador extends AnaliseAbstract
{
    private AnaliseAbstract $analise;
    
    public function __construct(Wrapper $wrapper)
    {
        parent::__construct($wrapper, __CLASS__);
    }

    public function analisar(): int | string
    {

        while(true){

            $caractere = $this->sinal->getCurrent();
            
            if(!array_key_exists($caractere, AnaliseList::get())){
                RejectDetail::log('009', __METHOD__, __LINE__, $this->sinal->getFullString());
                return 'INSERIR_EM_REPROVADO';
            }

            $nomeDaClasseAnalise = 'App\\Service\\Analise\\Analise\\'.AnaliseList::get()[$caractere];
            $this->analise = new $nomeDaClasseAnalise($this->wrapperMemento, $nomeDaClasseAnalise);
                    
            $acaoDoIterador = $this->analise->analisar();
            
            switch ($acaoDoIterador) {

                case 'INSERIR_EM_APROVADO':
                    return $acaoDoIterador;

                case 'INSERIR_EM_REPROVADO':
                    return $acaoDoIterador;

                case 'CHAMAR_PROXIMO_CARACTERE':
                    $acaoDoIterador = 1;

                default://recebe um int para pular os characteres desnecessários.
                    $this->sinal->next($acaoDoIterador);
                    break;
            }
        }
    }
}
