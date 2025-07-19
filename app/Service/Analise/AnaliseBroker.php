<?php
namespace App\Service\Analise;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Analise\Analise\Analise;
use App\Service\Analise\Flag\FlagAnalise;
use App\Service\Queues\GerenciadorQueues;

class AnaliseBroker
{
  private Analise $analise;
  private array $listaAnalise;
  private string $namespaceComand;
  private GerenciadorQueues $queues;

  public function __construct(GerenciadorQueues $queues)
  {
    $this->queues = $queues;
    $this->listaAnalise = new AnaliseList()->get();
    $this->namespaceComand = 'App\\Service\\Analise\\Analise\\';
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

        $nomeComando = $this->namespaceComand.$this->listaAnalise[$caractere];
      
      } catch (\Throwable $th) {
        $this->queues->inserirEmReprovados($indiceAcordesAAnalisarQueue, $acorde);
        return;
      }

      $this->analise = new $nomeComando($acorde, $keyChar, $flag);
            
      $acaoDoIterador = $this->analise->analisar();

      switch ($acaoDoIterador) {

        case 'INSERIR_EM_APROVADO':
          $this->queues->inserirEmAprovados($indiceAcordesAAnalisarQueue, $acorde);
          return;

        case 'INSERIR_EM_REPROVADO':
          $this->queues->inserirEmReprovados($indiceAcordesAAnalisarQueue, $acorde);
          return;

        case 'CHAMAR_PROXIMO_CARACTERE':
          break;

        default://recebe um int para pular os characteres desnecessários, julgados assim pelo analise, para análise.
          $keyChar += $acaoDoIterador;
          break;

      }
    }
  }
}
