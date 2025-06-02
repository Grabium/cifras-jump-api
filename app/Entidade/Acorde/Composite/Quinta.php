<?php

namespace App\Entidade\Acorde\Composite;

class Quinta extends AcordeComposicao
{
    /**
     * 
     * @throws \TypeError
     * 
     *******/  
    public function validate(mixed $key)
    {
        $regex = '(diminuta|justa|aumentada|NaoTestado)';
        if(!preg_match('/'.$regex.'/', $key)){
            throw new \TypeError('Quinta aceita apenas [diminuta|justa|aumentada|NaoTestado] como valor.');
        }
    }
    
}
