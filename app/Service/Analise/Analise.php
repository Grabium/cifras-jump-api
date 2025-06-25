<?php
namespace App\Service\Analise;

use App\Service\Entidade\Acorde\Acorde;
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
    foreach($this->acordesQueue as $indiceAcordesQueue => $acorde){

      $chamarProximoAcorde = $this->verificarAcordesRepetidos($indiceAcordesQueue, $acorde);
      if($chamarProximoAcorde){
        continue;
      }

      $this->iteradorSinal($indiceAcordesQueue, $acorde);

    }

    dd(AprovadosQueue::$cifrasArpovadas);
  }

  private function verificarAcordesRepetidos(int $indiceAcordesQueue, Acorde $acorde): bool
  {

    //acordes AmEm não devem pular a análise.
    if(($acorde->cifraOriginal->sinal == 'Am ') || ($acorde->cifraOriginal->sinal == 'Em ')){
      return false;
    }

    $chaveDeAcordeRepetido = array_search($acorde->cifraOriginal->sinal, AprovadosQueue::getSinais());
      
    if($chaveDeAcordeRepetido){
      (new PositivoFinalMatch($indiceAcordesQueue, AprovadosQueue::$cifrasArpovadas[$chaveDeAcordeRepetido]))->deduce();
      return true;
    }

    return false;
  }

  private function iteradorSinal(int $indiceAcordesQueue, Acorde $acorde)
  {
    $sinalArray = str_split($acorde->get());
    $countSinalArray = count($sinalArray);

    for($keyChar = 0; $keyChar < $countSinalArray; $keyChar++){
    
      $caractere = $sinalArray[$keyChar];

      try {

        $nomeComando = $this->namespaceComand.$this->listaCommand[$caractere];
      
      } catch (\Throwable $th) {
        (new NegativoFinalMatch($indiceAcordesQueue, $acorde))->deduce();
        return;
      }

      $this->command = new $nomeComando($indiceAcordesQueue, $acorde, $keyChar);
      
      $acaoDoIterador = $this->command->analisar();

      switch ($acaoDoIterador) {
        case 'CHAMAR_PROXIMO_ACORDE':
          return;
          break;
        case 'CHAMAR_PROXIMO_CARACTERE':
          break;
        default:
          $keyChar += $acaoDoIterador;
          break;
      }
    }
  }
}
