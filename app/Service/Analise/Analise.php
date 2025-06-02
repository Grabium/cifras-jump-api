<?php

namespace App\Service\Analise;

use App\Entidade\Acorde\Acorde;
use App\Entidade\Acorde\Cifra\CifrasQueue;
use App\Service\Analise\Matcheds\Negativo;
use App\Service\Analise\Command\Command;
use App\Entidade\Aprovados\AprovadosQueue;

class Analise
{
  private Command $command;

  public function run()
  {
    //$cifras = CifrasQueue::getCifras();
    foreach(CifrasQueue::getAcordes() as $indice => $acorde){
      if(in_array($acorde->cifraOriginal->sinal, AprovadosQueue::$cifrasArpovadas)){
        //acorde repetido
        //pegue a referência do antigo e salve no lugar do atual
      }

      $this->iteradorSinal($indice, $acorde);

    }

    dd(AprovadosQueue::$cifrasArpovadas);
  }

  private function iteradorSinal($indice, Acorde $acorde)
  {
    $listaCommand = new CommandList()->get();
    $namespaceComand = 'App\\Service\\Analise\\Command\\';
    
    foreach(str_split($acorde->cifraOriginal->sinal) as $key => $caractere){
    echo 'analisando :'.$caractere.':'.PHP_EOL;
      if(!array_key_exists($caractere, $listaCommand)){
        (new Negativo($indice, $acorde, $key))->handle();
        return;
      }

      $nomeComando = $namespaceComand.$listaCommand[$caractere];//dd($nomeComando);
      echo 'Chamando :'.$nomeComando.':'.PHP_EOL;
      $this->command = new $nomeComando($indice, $acorde, $key);//fazer a injeção de dependência.
      
      if($this->command->analisar()){
        return;
      }

    }
  }
}
