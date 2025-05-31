<?php

namespace App\Service\Analise;

use App\Entidade\Acorde\Acorde;
use App\Entidade\Acorde\Cifra\CifrasQueue;
use App\Service\Analise\Command\Command;
use App\Service\Analise\Matcheds\Negativo;

class Analise
{
  static public array $cifrasArpovadas;//posui apenas os sinais. Mover para um mediador.
  private Command $command;

  public function run()
  {
    //$cifras = CifrasQueue::getCifras();
    foreach(CifrasQueue::getAcordes() as $indice => $acorde){
      if(in_array($acorde->cifraOriginal->sinal, self::$cifrasArpovadas)){
        //acorde repetido
        //pegue a referência do antigo e salve no lugar do atual
      }

      $this->iteradorSinal($indice, $acorde);

    }

  }

  private function iteradorSinal($indice, Acorde $acorde)
  {
    $listaCommand = new CommandList()->get();
    
    foreach(str_split($acorde->cifraOriginal->sinal) as $key => $caractere){
      
      if(!array_key_exists($caractere, $listaCommand)){
        (new Negativo)->handle($indice, $acorde);
        break;
      }

      $nomeComando = $listaCommand[$caractere];
      $this->command = new $nomeComando($key, $acorde);//fazer a injeção de dependência.
      $this->command->analisar();

    }
  }
}
