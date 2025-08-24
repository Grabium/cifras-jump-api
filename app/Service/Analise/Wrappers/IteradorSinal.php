<?php

namespace App\Service\Analise\Wrappers;

class IteradorSinal
{
    private string $sinal = '';
    private array $sinalArray = [];
    private int | null $position = 0;

    public function __construct(null|string $sinal = '')
    {
        $this->set($sinal);
    }

    private function set(string $sinal)
    {
        $this->sinal = $sinal;
        if ($this->count() < 1) {
            throw new \InvalidArgumentException('Quantidade mínima de caracteres é 1.');
        }
        $this->sinalArray = str_split($sinal);
        $this->position = 0;
    }

    public function isDefined(): bool
    {
        if ($this->count() == 0) {
            return false;
        }

        return true;
    }

    public function isValid(int|null $position = null): bool
    {
        $position = (is_null($position)) ? $this->getPosition() : $position;
        return (($position < $this->count()) && ($position >= 0));
    }

    public function count(): int
    {
        return strlen($this->sinal);
    }

    public function getFullString(): string
    {
        return $this->sinal;
    }

    public function getFullArray(): array
    {
        return $this->sinalArray;
    }

    public function getCurrent(): string
    {
        return $this->sinalArray[$this->position];
    }

    public function showCurrent(): void
    {
        echo $this->getCurrent();
    }

    public function dump()
    {
        echo "Crurrent: {$this->getCurrent()}\n";
        echo "Position: {$this->getPosition()}\n";
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $newPosition): bool
    {
        if (!$this->isValid($newPosition)) {
            return false;
        }

        $this->position = $newPosition;
        return true;
    }

    public function equalsPosition(int $assert): bool
    {
        return $this->getPosition() == $assert;
    }

    public function rewind(): void
    {
        $this->setPosition(0);
    }

    public function end(): void
    {
        $this->setPosition($this->count() - 1);
    }

    public function hasNext(int $steps = 1): bool
    {
        $newPosition = ($this->getPosition() + $steps);
        return ($this->isValid($newPosition)) ? true : false;
    }

    public function next(int $steps = 1): bool
    {
        if (!$this->hasNext($steps)) {
            return false;
        }

        $this->position += $steps;
        return true;
    }

    public function getNext(int $steps = 1): bool | string
    {
        if (!$this->next($steps)) {
            return false;
        }

        $caractere = $this->getCurrent();
        $this->prev($steps);
        return $caractere;
    }

    public function hasPrev(int $steps = 1): bool
    {
        $newPosition = ($this->getPosition() - $steps);
        return ($this->isValid($newPosition)) ? true : false;
    }

    public function prev(int $steps = 1): bool
    {
        if (!$this->hasPrev($steps)) {
            return false;
        }

        $this->position -= $steps;
        return true;
    }

    public function getPrev(int $steps = 1): bool | string
    {
        if (!$this->prev($steps)) {
            return false;
        }

        $caractere = $this->getCurrent();
        $this->next($steps);
        return $caractere;
    }

    //Comparadores
    public function equalsCurrent(string $value): bool
    {
        return ($this->getCurrent() === $value);
    }

    public function matchCurrent(string $regex): bool
    {
        return (preg_match('/' . $regex . '/', $this->getCurrent()));
    }

    public function matchNext(string $regex): bool
    {
        return ($this->getNext()) ? preg_match('/' . $regex . '/', $this->getNext()) : false;
    }

    public function matchPrev(string $regex): bool
    {
        return ($this->getPrev()) ? preg_match('/' . $regex . '/', $this->getPrev()) : false;
    }
}
