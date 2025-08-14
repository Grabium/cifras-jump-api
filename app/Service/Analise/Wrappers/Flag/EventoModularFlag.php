<?php

namespace App\Service\Analise\Wrappers\Flag;


/**
 * Caracterizado por qualquer conjunto de caracteres dentro de "//" ou "()".
 * Não é útil settar true caso a análise resolva tudo numa única chamada a AnaliseAbstract::analise(), como é o caso do TomAnalise.
 */
class EventoModularFlag extends Flag
{
    //Toda a lógica está implementada na classe pai.
}