<?php
namespace App\Service\Analise;

use App\Service\Analise\Analise\AnaliseIterador;
use App\Service\Entidade\Acorde\Acorde;
use App\Service\Queues\GerenciadorQueues;
use App\Service\Analise\Wrappers\Wrapper;

class Analise
{
  private GerenciadorQueues $queues;
  private array $analiseList = [];

  public function __construct(GerenciadorQueues $queues)
  {
    $this->queues = $queues;
    $this->analiseList = new AnaliseList()->get();   
  }

  private function factoryAnaliseIterador(Acorde $acorde):AnaliseIterador
  {
    $wrapper = new Wrapper($acorde);
    return new AnaliseIterador($wrapper, $this->analiseList);
  }

  public function run():array
  {
    foreach($this->queues->getAnalisar() as $indiceAcordesAAnalisarQueue => $acorde){

      $chaveDeAcordeRepetido = $this->queues->verificarAcordesRepetidos($indiceAcordesAAnalisarQueue, $acorde);
      if($chaveDeAcordeRepetido){
        $this->queues->inserirEmAprovados($indiceAcordesAAnalisarQueue, $this->queues->getAprovados($chaveDeAcordeRepetido));
        continue;
      }

      $analiseIterador = $this->factoryAnaliseIterador($acorde);
      $acaoDoIterador = $analiseIterador->analisar();

      switch ($acaoDoIterador) {

        case 'INSERIR_EM_APROVADO':
          $this->queues->inserirEmAprovados($indiceAcordesAAnalisarQueue, $acorde);
          break;

        case 'INSERIR_EM_REPROVADO':
          $this->queues->inserirEmReprovados($indiceAcordesAAnalisarQueue, $acorde);
          break;
      }

    }

    return $this->queues->getAllQueues();
    //dd($this->queues->getAllQueues());
  }

}
