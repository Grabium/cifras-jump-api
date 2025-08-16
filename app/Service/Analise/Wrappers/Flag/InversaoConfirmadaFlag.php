<?php

namespace App\Service\Analise\Wrappers\Flag;


/***
 * A flag se abre ao concluir o tom da inversão.
 * Se qualquer caractere deve deve engatilhar outra análise, 
 * com excessão do fecha áspas e space, 
 * isso deverá retornar um INSERIR_EM_REPROVADO.
 */
class InversaoConfirmadaFlag extends Flag
{
    //Toda a lógica está implementada na classe pai.
}
