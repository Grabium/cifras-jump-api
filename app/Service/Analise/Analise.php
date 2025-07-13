<?php
namespace App\Service\Analise;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Analise\Command\Command;
use App\Service\Analise\Flag\FlagAnalise;
use App\Service\Queues\GerenciadorQueues;

class Analise
{
  private Command $command;
  private array $listaCommand;
  private string $namespaceComand;
  private GerenciadorQueues $queues;

  public function __construct(GerenciadorQueues $queues)
  {
    $this->queues = $queues;
    $this->listaCommand = new CommandList()->get();
    $this->namespaceComand = 'App\\Service\\Analise\\Command\\';
  }

  public function run()
  {
    foreach($this->queues->getAnalisar() as $indiceAcordesAAnalisarQueue => $acorde){

      $chaveDeAcordeRepetido = $this->queues->verificarAcordesRepetidos($indiceAcordesAAnalisarQueue, $acorde);
      if($chaveDeAcordeRepetido){
        $this->queues->inserirEmAprovados($indiceAcordesAAnalisarQueue, $this->queues->getAprovados($chaveDeAcordeRepetido));
        continue;
      }

      $this->iteradorSinal($indiceAcordesAAnalisarQueue, $acorde);

    }

    dd($this->queues->getAprovados());
  }

  

  private function iteradorSinal(int $indiceAcordesAAnalisarQueue, Acorde $acorde)
  {
    $sinalArray = str_split($acorde->get());
    $countSinalArray = count($sinalArray);
    $flag = new FlagAnalise();

    for($keyChar = 0; $keyChar < $countSinalArray; $keyChar++){
    
      $caractere = $sinalArray[$keyChar];

      try {

        $nomeComando = $this->namespaceComand.$this->listaCommand[$caractere];
      
      } catch (\Throwable $th) {
        $this->queues->inserirEmReprovados($indiceAcordesAAnalisarQueue, $acorde);
        return;
      }

      $this->command = new $nomeComando($acorde, $keyChar, $flag);
            
      $acaoDoIterador = $this->command->analisar();

      switch ($acaoDoIterador) {

        case 'INSERIR_EM_APROVADO':
          $this->queues->inserirEmAprovados($indiceAcordesAAnalisarQueue, $acorde);
          return;

        case 'INSERIR_EM_REPROVADO':
          $this->queues->inserirEmReprovados($indiceAcordesAAnalisarQueue, $acorde);
          return;

        case 'CHAMAR_PROXIMO_CARACTERE':
          break;

        default://recebe um int para pular os characteres desnecessários para análise.
          $keyChar += $acaoDoIterador;
          break;

      }
    }
  }
}
