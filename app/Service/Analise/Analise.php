<?php

namespace App\Service\Analise;

use App\Entidade\Acorde\Acorde;
use App\Entidade\Acorde\Cifra\CifrasQueue;
use App\Service\Analise\Matcheds\Negativo;
use App\Service\Analise\Command\Command;
use App\Entidade\Aprovados\AprovadosQueue;
use App\Service\Analise\Matcheds\Positivo;

class Analise
{
  private Command $command;
  private array $listaCommand;
  private string $namespaceComand;

  public function __construct()
  {
    $this->listaCommand = new CommandList()->get();
    $this->namespaceComand = 'App\\Service\\Analise\\Command\\';
  }

  public function run()
  {
    foreach(CifrasQueue::getAcordes() as $indice => $acorde){

      $chaveDeAcordeRepetido = array_search($acorde->cifraOriginal->sinal, AprovadosQueue::getSinais());
      
      if($chaveDeAcordeRepetido){
        (new Positivo($indice, AprovadosQueue::$cifrasArpovadas[$chaveDeAcordeRepetido], 0))->handle();
        continue;
      }

      $this->iteradorSinal($indice, $acorde);

    }

    dd(AprovadosQueue::$cifrasArpovadas);
  }

  private function iteradorSinal($indice, Acorde $acorde)
  {
    foreach(str_split($acorde->cifraOriginal->sinal) as $key => $caractere){
      
      //caso Command não exista:
      if(!array_key_exists($caractere, $this->listaCommand)){
        (new Negativo($indice, $acorde, $key))->handle();
        return;
      }

      $nomeComando = $this->namespaceComand.$this->listaCommand[$caractere];
      $this->command = new $nomeComando($indice, $acorde, $key);

      if($this->command->analisar()){
        return;
      }

    }
  }
}
