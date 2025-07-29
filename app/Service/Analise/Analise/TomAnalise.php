<?php

namespace App\Service\Analise\Analise;

class TomAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        [$tom, $comandoParaIterador] = $this->getTom();

        //se inversao
        if($this->sinal->getPosition() != 0){

            if(!$this->flag->barra->status()){
                return 'INSERIR_EM_REPROVADO';
            }

            $this->flag->barra->fechar();
            $this->acorde->cifraOriginal->inversao->set($tom);

        }else{

            $this->acorde->cifraOriginal->fundamental->set($tom);
        }

        //se enarmônico
        if(strlen($tom) == 2){
            $this->acorde->enarmonia->set($tom[1]);
        }
        
        return $comandoParaIterador;
    }
    
    private function getTom(): array
    {
        $tom = $this->sinal->getCurrent();
        $regex = '[#b]';

        if(preg_match('/'.$regex.'/', $this->sinal->getNext())){
            $tom .= $this->sinal->getNext();
            $comandoParaIterador = 2;
        }else{
            $comandoParaIterador = 'CHAMAR_PROXIMO_CARACTERE';
        }
        
        return [$tom, $comandoParaIterador];
    }
}
