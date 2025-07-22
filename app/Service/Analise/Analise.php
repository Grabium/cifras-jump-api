<?php
namespace App\Service\Analise;

use App\Service\Queues\GerenciadorQueues;

class Analise
{
  private GerenciadorQueues $queues;
  private AnaliseAcorde $analiseAcorde;

  public function __construct(GerenciadorQueues $queues)
  {
    $this->queues = $queues;
    $this->analiseAcorde = new AnaliseAcorde($this->queues);
  }

  public function run()
  {
    foreach($this->queues->getAnalisar() as $indiceAcordesAAnalisarQueue => $acorde){

      $chaveDeAcordeRepetido = $this->queues->verificarAcordesRepetidos($indiceAcordesAAnalisarQueue, $acorde);
      if($chaveDeAcordeRepetido){
        $this->queues->inserirEmAprovados($indiceAcordesAAnalisarQueue, $this->queues->getAprovados($chaveDeAcordeRepetido));
        continue;
      }

      $this->analiseAcorde->iteradorSinal($indiceAcordesAAnalisarQueue, $acorde);

    }

    dd($this->queues->getAprovados());
  }

}
