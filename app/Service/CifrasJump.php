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

    public function converter(string $texto, int $fator)
    {
        $textoObj = $this->mediador->textoFactory($texto);
        $acordesQueue = $this->mediador->getAcordesQueue($textoObj->textoOriginal);
        $this->mediador->analiseFactory($acordesQueue)->run();
        
    }
}
