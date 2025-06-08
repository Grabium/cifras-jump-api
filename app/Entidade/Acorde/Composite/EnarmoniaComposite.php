<?php

namespace App\Entidade\Acorde\Composite;

class EnarmoniaComposite extends Composite
{  
   /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        if($key !== '#' && $key !== 'b' && $key != 'natural' && $key != 'NaoTestado'){
            throw new \TypeError('Enarmonia apenas aceita [#] ou [b] como valor.');
        }
    }
}
