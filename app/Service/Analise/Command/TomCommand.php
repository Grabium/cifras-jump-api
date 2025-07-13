<?php

namespace App\Service\Analise\Command;

use App\Service\Analise\Matched\TomFundamentalMatched;
use App\Service\Analise\Matched\EnarmoniaMatched;
use App\Service\Analise\Matched\TomInversaoMatched;

class TomCommand extends Command
{
    /*****
   * @param void
   * @return string - 'INSERIR_EM_REPROVADO', 'INSERIR_EM_APROVADO' ou 'CHAMAR_PROXIMO_CARACTERE', que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   */
    public function analisar(): int | string
    {
        $tom = $this->getTom()[0];//var_dump($this);
        $comandoParaIterador = $this->getTom()[1];

        //processar se é uma inversao
        if($this->keyChar != 0){

            //falhar se não proceder uma barra
            if(!$this->flag->barra->status()){
                return 'INSERIR_EM_REPROVADO';
            }

            $this->flag->barra->fechar();
            (new TomInversaoMatched($this->acorde, $this->keyChar))->handle($tom);

        }else{

            (new TomFundamentalMatched($this->acorde, $this->keyChar))->handle($tom);
        }

        //caso enarmônico
        if(strlen($tom) == 2){
            (new EnarmoniaMatched($this->acorde, $this->keyChar))->handle($tom[1]);
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
