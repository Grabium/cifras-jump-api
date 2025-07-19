<?php
namespace App\Service\Mediador;

use App\Service\Entidade\Texto\Texto;
use App\Service\Analise\AnaliseBroker;
use App\Service\Queues\GerenciadorQueues;

class Mediador
{
    public function textoFactory(string $texto)
    {
        return new Texto($texto);
    }

    public function factoryGerenciadorQueues(): GerenciadorQueues
    {
        return new GerenciadorQueues();
    }

    public function enfileirarAcordes(GerenciadorQueues $queues, string $texto): void
    {
        $queues->enfileirarAcordes($texto);
    }

    public function analiseBrokerFactory(GerenciadorQueues $queues)
    {
        return new AnaliseBroker($queues);
    }

    public function conversorFactory()
    {
        //return new Conversor($this->request->get('fator'));
    }
}