<?php

namespace App\Service\Entidade\Acorde\Composite;

class IntervaloComposite extends Composite
{
    public array $sinais = [];

    public function set(mixed $key = 'NaoTestado'): void
    {
        if (!$this->tryValidated($key)) {
            return;
        }

        if (!empty($this->sinais) && $this->sinais[0] === 'NaoTestado') {
            $this->sinais[0] = $key;
            return;
        }

        $this->sinais[] = $key;
    }

    //Salva estaticamente até $cicloFinalizado ser true. Finalmente chama set().
    public function setConcat(bool $cicloFinalizado = false, string $key = ''): void
    {
        static $sinalConcat = '';

        if($key != ''){
            $sinalConcat .= $key;
        }

        if(!$cicloFinalizado){
            return;
        }

        $this->set($sinalConcat);
        $sinalConcat = '';
    }

    public function validate(mixed $key): void
    {

        $regexs[0] = '^[#b]?([234567]|(9)|(10)|(11)|(12)|(13)|(14))$';
        $regexs[1] = '^([234567]|(9)|(10)|(11)|(12)|(13)|(14))[+-]?$';
        $regexs[2] = '^NaoTestado$';

        $flag = false;

        foreach ($regexs as $regex) {
            $flag = (preg_match('/' . $regex . '/', $key)) ? true : $flag;
        }

        if (!$flag) {
            throw new \InvalidArgumentException('Intervalo numérico com formato inválido: ' . $key . '.');
        }
    }

    public function hasDuplicityIntervals(): bool
    {
        $contagemDeIntervalosUnicos = array_count_values($this->sinais);

        foreach($contagemDeIntervalosUnicos as $quantidadeDoIntervaloAtual){
            if($quantidadeDoIntervaloAtual > 1){
                return true;
            }
        }

        return false;
    }
}
