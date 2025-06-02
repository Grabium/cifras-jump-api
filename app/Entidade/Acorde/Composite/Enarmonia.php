<?php

namespace App\Entidade\Acorde\Composite;

class Enarmonia extends AcordeComposicao
{  
   /**
   * 
   * @throws \TypeError
   * 
   *******/
    public function validate(mixed $key)
    {
        if($key !== '#' && $key !== 'b' && $key != 'NaoTestado'){
            throw new \TypeError('Enarmonia apenas aceita [#] ou [b] como valor.');
        }
    }
}
