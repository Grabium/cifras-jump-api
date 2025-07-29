<?php

namespace App\Service\Analise\Analise;

use App\Service\Analise\Wrappers\Wrapper;


/***
 * Serve de interface da abstração AnaliseAbstract
 */
class AnaliseIterador extends AnaliseAbstract
{
    private AnaliseAbstract $analise;
    private array $analiseList;
    
    public function __construct(Wrapper $wrapper, array $analiseList)
    {
        parent::__construct($wrapper);
        $this->analiseList = $analiseList;
    }

    public function analisar(): int | string
    {

        while(true){
            
            $caractere = $this->sinal->getCurrent();
            
            try {

                $nomeDaClasseAnalise = 'App\\Service\\Analise\\Analise\\'.$this->analiseList[$caractere];
            
            } catch (\Throwable $th) {
                return 'INSERIR_EM_REPROVADO';
            }

            $this->analise = new $nomeDaClasseAnalise($this->wrapperMemento);
                    
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
