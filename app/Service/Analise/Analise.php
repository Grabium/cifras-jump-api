<?php

namespace App\Service\Analise;

use App\Entidade\Acorde\Acorde;
use App\Entidade\Acorde\Cifra\CifrasQueue;
use App\Service\Analise\Matched\NegativoMatched;
use App\Service\Analise\Command\Command;
use App\Entidade\Aprovados\AprovadosQueue;
use App\Service\Analise\Matched\PositivoMatched;

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
    $chaveDeAcordeRepetido = array_search($acorde->cifraOriginal->sinal, AprovadosQueue::getSinais());
      
    if($chaveDeAcordeRepetido){
      (new PositivoMatched($indice, AprovadosQueue::$cifrasArpovadas[$chaveDeAcordeRepetido], 0))->handle();
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
        
        (new NegativoMatched($indice, $acorde, $key))->handle('');
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
