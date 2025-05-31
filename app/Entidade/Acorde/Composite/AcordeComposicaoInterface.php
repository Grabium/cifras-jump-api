<?php

namespace App\Entidade\Acorde\Composite;

interface AcordeComposicaoInterface
{
    public function __construct(mixed $key = 'NaoTestado');

    /**
     * 
     * Apenas valida ou retorna exceção, não altera dados.
     * 
     */
    public function validate(mixed $key);
}
