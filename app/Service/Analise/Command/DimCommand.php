<?php
namespace App\Service\Analise\Command;

use App\Service\Analise\FinalMatch\NegativoFinalMatch;
use App\Service\Analise\Matched\DiminutoMatched;
use App\Service\Analise\Matched\TercaMatched;

class DimCommand extends Command
{
    /*****
   * @param void
   * @return string - CHAMAR_PROXIMO_ACORDE ou CHAMAR_PROXIMO_CARACTERE, que são ações para o iterador de sinal (Analise).
   * @return int - quntidade de caracteres a pular no Analise->iteradorSinal()
   *******/
    public function analisar(): int | string
    {
        $dimString = substr($this->acorde->get(), $this->keyChar, 3);

        if($dimString == 'dim'){
            $acaoDaAnalise = 2;
        }else{
            (new NegativoFinalMatch($this->indiceAcordesQueue, $this->acorde))->deduce();
            return 'CHAMAR_PROXIMO_ACORDE';
        }

        (new TercaMatched($this->indiceAcordesQueue, $this->acorde, $this->keyChar))->handle('menor');
        (new DiminutoMatched($this->indiceAcordesQueue, $this->acorde, $this->keyChar))->handle('diminuta');
        return $acaoDaAnalise;
    }
}