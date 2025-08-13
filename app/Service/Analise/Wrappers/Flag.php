<?php

namespace App\Service\Analise\Wrappers;

use App\Service\Analise\Wrappers\Flag\AguardandoQualquerAlgarismoFlag;
use App\Service\Analise\Wrappers\Flag\BarraFlag;
use App\Service\Analise\Wrappers\Flag\EventoModularFlag;
use App\Service\Analise\Wrappers\Flag\IntervaloComDezenaFlag;
use App\Service\Analise\Wrappers\Flag\IntervaloComsustenidoBemolFlag;
use App\Service\Analise\Wrappers\Flag\ParentesisFlag;
use App\Service\Analise\Wrappers\Flag\PossivelIntervaloFlag;
use App\Service\Analise\Wrappers\Flag\SegundoAgarismoFlag;

class Flag
{
	public BarraFlag $barra;
	public ParentesisFlag $parentesis;
	public PossivelIntervaloFlag $possivelIntervalo;
	public IntervaloComsustenidoBemolFlag $intervaloComsustenidoBemol;
	public IntervaloComDezenaFlag $intervaloComDezena;
	public EventoModularFlag $eventoModular;
	public SegundoAgarismoFlag $segundoAgarismo;
	public AguardandoQualquerAlgarismoFlag $aguardandoQualquerAlgarismo;

	public function __construct()
	{
		$this->barra = new BarraFlag();
		$this->parentesis = new ParentesisFlag();
		$this->possivelIntervalo = new PossivelIntervaloFlag();
		$this->intervaloComsustenidoBemol = new IntervaloComsustenidoBemolFlag();
		$this->intervaloComDezena = new IntervaloComDezenaFlag();
		$this->eventoModular = new EventoModularFlag();
		$this->segundoAgarismo = new SegundoAgarismoFlag();
		$this->aguardandoQualquerAlgarismo = new AguardandoQualquerAlgarismoFlag();
	}

	public function fecharTodasAsFlags()
	{
		$atributosArray = get_class_vars(get_class($this));

		foreach ($atributosArray as $nome => $valor){
			$this->$nome->fechar();
		}
	}
}
