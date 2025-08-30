<?php

namespace App\Service\Queues;

use App\Service\Analise\FinalMatch\NegativoFinalMatch;
use App\Service\Analise\FinalMatch\PositivoFinalMatch;
use App\Service\Analise\FinalSet\NegativoFinalSet;
use App\Service\Analise\FinalSet\PositivoFinalSet;
use App\Service\Entidade\Acorde\Acorde;
use App\Service\Logs\LogReprovacao;

class GerenciadorQueues
{
    private AcordesAprovadosQueue $acordesAprovadosQueue;
    private AcordesReprovadosQueue $acordesReprovadosQueue;
    private AcordesAAnalisarQueue $acordesAAnalisarQueue;

    public function __construct()
    {
        $this->acordesAprovadosQueue = new AcordesAprovadosQueue();
        $this->acordesReprovadosQueue = new AcordesReprovadosQueue();
        $this->acordesAAnalisarQueue = new AcordesAAnalisarQueue();
    }

    public function enfileirarAcordes(string $texto): void
    {
        $this->acordesAAnalisarQueue->enfileirarAcordes($texto);
    }

    public function verificarAcordesRepetidos(string $sinal): bool
    {
        //acordes AmEm não devem pular a análise.
        if(($sinal == 'Am ') || ($sinal == 'Em ')){
            return false;
        }

        $chaveDeAcordeRepetido = array_search($sinal, $this->acordesAprovadosQueue->getSinais());
       
        return $chaveDeAcordeRepetido;
    }

    public function getAllQueues(): array
    {
        return ['A_analisar' => $this->getAnalisar(),
                'Aprovados'  => $this->getAprovados(),
                'Reprovados' => $this->getReprovados(),
        ];
     }

    public function getAprovados(null|int $indice=null):Acorde|array
    {
        return $this->acordesAprovadosQueue->get($indice);
    }

    public function getAnalisar(null|int $indice=null):Acorde|array
    {
        return $this->acordesAAnalisarQueue->get($indice);
    }

    public function getReprovados(null|int $indice=null):Acorde|array
    {
        return $this->acordesReprovadosQueue->get($indice);
    }

    public function inserirEmAprovados(int $indice, Acorde $acorde):void
    {
        (new PositivoFinalSet())->deduce($acorde);
        $this->acordesAprovadosQueue->inserir($indice, $acorde);
    }

    public function inserirEmReprovados(int $indice, Acorde $acorde):void
    {
        (new NegativoFinalSet())->deduce($acorde);
        $this->acordesReprovadosQueue->inserir($indice, $acorde);
        $this->acordesReprovadosQueue->setLog($indice, LogReprovacao::getMessage(true));
    }
}
