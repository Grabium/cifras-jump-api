<?php

namespace App\Service\Analise\Analise\Traits;

use App\Service\Entidade\Acorde\Acorde;

trait IntervalosDeduceAnalise
{
    public function deduceInterval(Acorde $acorde)
    {
        $lastInterval = $acorde->intervalo->getEnd();

        [$composite, $valorDoComposite] = $this->getRulesDeduces()[$lastInterval] ?? [null, null] ; 

        if(is_null($composite) || is_null($valorDoComposite)){
            return;
        }

        $acorde->$composite->set($valorDoComposite);
    }

    private function getRulesDeduces(): array
    {
        return [

            'b3' => ['terca', 'menor'],
            '3-' => ['terca', 'menor'],
            '3' => ['terca', 'maior'],
            '#3' => ['terca', 'aumentada'],
            '3+' => ['terca', 'aumentada'],

            'b5' => ['quinta', 'diminuta'],
            '5-' => ['quinta', 'diminuta'],
            '5' => ['quinta', 'justa'],
            '#5' => ['quinta', 'aumentada'],
            '5+' => ['quinta', 'aumentada'],

            '7-' => ['setima', 'diminuta'],
            'b7' => ['setima', 'diminuta'],
            '7' => ['setima', 'menor'],
            '#7' => ['setima', 'maior'],
            '7+' => ['setima', 'maior'],

            'b10' => ['terca', 'menor'],
            '10-' => ['terca', 'menor'],
            '10' => ['terca', 'maior'],
            '#10' => ['terca', 'aumentada'],
            '10+' => ['terca', 'aumentada'],

            'b12' => ['quinta', 'diminuta'],
            '12-' => ['quinta', 'diminuta'],
            '12' => ['quinta', 'justa'],
            '#12' => ['quinta', 'aumentada'],
            '12+' => ['quinta', 'aumentada'],

            'b14' => ['setima', 'diminuta'],
            '14-' => ['setima', 'diminuta'],
            '14' => ['setima', 'menor'],
            '#14' => ['setima', 'maior'],
            '14+' => ['setima', 'maior'],
        ];
    }
}
