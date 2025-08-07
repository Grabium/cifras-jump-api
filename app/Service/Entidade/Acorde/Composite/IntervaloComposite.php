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

    public function validate(mixed $key)
    {
        $regexs[0] = '^[#b]?([234567]|(9)|(10)|(11)|(12)|(13)|(14))$';
        $regexs[1] = '^([234567]|(9)|(10)|(11)|(12)|(13)|(14))[+-]?$';
        $regexs[2] = '^NaoTestado$';

        $flag = false;

        foreach ($regexs as $regex) {
            $flag = (preg_match('/' . $regex . '/', $key)) ? true : $flag;
        }

        if (!$flag) {
            throw new \TypeError('Intervalo numérico inválido: ' . $key . '.');
        }
    }

    public function get(): string
    {
        $intervalo = '';

        foreach ($this->sinais as $k => $sinal) {
            $intervalo .= ($k == 0) ? $sinal : '/' . $sinal;
        }

        return $intervalo;
    }
}
