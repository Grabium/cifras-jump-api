<?php

namespace App\Service\Analise;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Entidade\Acorde\Cifra\CifrasQueue;
use App\Service\Analise\Command\Command;
use App\Service\Entidade\Aprovados\AprovadosQueue;
use App\Service\Analise\FinalMatch\PositivoFinalMatch;
use App\Service\Analise\FinalMatch\NegativoFinalMatch;

class Analise
{
  private Command $command;
  private array $acordesQueue;
  private array $listaCommand;
  private string $namespaceComand;

  public function __construct(array $acordesQueue)
  {
    $this->acordesQueue = $acordesQueue;
    $this->listaCommand = new CommandList()->get();
    $this->namespaceComand = 'App\\Service\\Analise\\Command\\';
  }

  public function run()
  {
    foreach($this->acordesQueue as $indice => $acorde){

      $chamarProximoAcorde = $this->verificarAcordesRepetidos($indice, $acorde);
      if($chamarProximoAcorde){
        continue;
      }

      $this->iteradorSinal($indice, $acorde);

    }

    dd(AprovadosQueue::$cifrasArpovadas);
  }

  private function verificarAcordesRepetidos(int $indice, Acorde $acorde): bool
  {

    //acordes AmEm não devem pular a análise.
    if(($acorde->cifraOriginal->sinal == 'Am ') || ($acorde->cifraOriginal->sinal == 'Em ')){
      return false;
    }

    $chaveDeAcordeRepetido = array_search($acorde->cifraOriginal->sinal, AprovadosQueue::getSinais());
      
    if($chaveDeAcordeRepetido){
      (new PositivoFinalMatch($indice, AprovadosQueue::$cifrasArpovadas[$chaveDeAcordeRepetido]))->deduce();
      return true;
    }

    return false;
  }

  private function iteradorSinal(int $indice, Acorde $acorde)
  {
    foreach(str_split($acorde->cifraOriginal->sinal) as $key => $caractere){
    
      try {

        $nomeComando = $this->namespaceComand.$this->listaCommand[$caractere];
      
      } catch (\Throwable $th) {
        
        (new NegativoFinalMatch($indice, $acorde))->deduce();
        return;

      }

      $this->command = new $nomeComando($indice, $acorde, $key);
      $chamarProximoAcorde = $this->command->analisar();

      if($chamarProximoAcorde){
        return;
      }

    }
  }
}
