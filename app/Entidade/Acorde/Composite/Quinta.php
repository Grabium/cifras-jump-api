<?php

namespace App\Entidade\Acorde\Composite;

class Quinta
{
    
    public string $sinal;

    /**
     * 
     * @throws \TypeError
     * 
     *******/  
    public function __construct(mixed $key = 'NaoTestado')
    {
        $this->validate($key);
        $this->sinal = $key;
    }

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
