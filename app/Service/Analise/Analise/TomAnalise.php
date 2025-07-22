<?php

namespace App\Service\Analise\Analise;

class TomAnalise extends AnaliseAbstract
{
    public function analisar(): int | string
    {
        $tom = $this->getTom()[0];
        $comandoParaIterador = $this->getTom()[1];

        //se inversao
        if($this->keyChar != 0){

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
        $tom = $this->acorde->get()[$this->keyChar];
        $regex = '[#b]';

        if(preg_match('/'.$regex.'/', $this->acorde->get()[$this->keyChar +1])){
            $tom .= $this->acorde->get()[$this->keyChar +1];
            $comandoParaIterador = 1;
        }else{
            $comandoParaIterador = 'CHAMAR_PROXIMO_CARACTERE';
        }
        
        return [$tom, $comandoParaIterador];
    }
}
