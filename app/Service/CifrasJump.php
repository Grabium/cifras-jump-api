<?php
namespace App\Service;

use App\Service\Mediador\Mediador;

/****
 * Fachada do Serviço
 */

class CifrasJump
{
    private Mediador $mediador;

    public function __construct()
    {
        $this->mediador = new Mediador();
    }

    public function converter(string $texto, int $fator): array
    {
        $textoObj = $this->mediador->textoFactory($texto);
        $gerenciadorQueues = $this->mediador->factoryGerenciadorQueues();
        $this->mediador->enfileirarAcordes($gerenciadorQueues, $textoObj->textoOriginal);
        return $this->mediador->analiseFactory($gerenciadorQueues)->run();//queues        
    }
}
