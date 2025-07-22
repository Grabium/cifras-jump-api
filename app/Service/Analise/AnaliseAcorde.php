<?php

namespace App\Service\Analise;

use App\Service\Entidade\Acorde\Acorde;
use App\Service\Analise\Analise\AnaliseAbstract;
use App\Service\Analise\Flag\FlagAnalise;
use App\Service\Queues\GerenciadorQueues;

class AnaliseAcorde
{
    private GerenciadorQueues $queues;
    private AnaliseAbstract $analise;
    private array $listaAnalise;
    private string $namespaceComand = 'App\\Service\\Analise\\Analise\\';
    

    public function __construct(GerenciadorQueues $queues)
    {
        $this->queues = $queues;
        $this->listaAnalise = new AnaliseList()->get();
    }

    public function iteradorSinal(int $indiceAcordesAAnalisarQueue, Acorde $acorde)
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
