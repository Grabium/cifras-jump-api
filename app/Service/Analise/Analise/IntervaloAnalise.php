<?php

namespace App\Service\Analise\Analise;

use App\Service\Analise\Analise\AnaliseAbstract;

class IntervaloAnalise extends AnaliseAbstract
{
	public function analisar(): int | string
	{
		if($this->filtrosPreAnalise() == 'INSERIR_EM_REPROVADO'){
            return 'INSERIR_EM_REPROVADO';
        }

		$function = $this->runRegex($this->sinal->getCurrent());

		try {

			$acaoDoIterador = $this->$function(); //chame a função de acordo com o 1° regexs aporvado

		} catch (\Throwable $th) {
			return 'INSERIR_EM_REPROVADO';
		}

		$this->acorde->intervalo->setConcat(false, $this->sinal->getCurrent());
		
		$this->flag->eventoModular->abrir();
		

		return $acaoDoIterador;
	}

	private function runRegex(string $caractere): false | string
	{
		$regexs['sustenidoBemol'] = '^[#b]$';
		$regexs['doisANove'] = '^[2345679]$';
		$regexs['dezena'] = '^1$';
		$regexs['maisOuMenos'] = '^[-+]$';
		$segundoAlgarismo = '^[01234]$';


		$function = false;

		//resolve qualquer inconsistência para segundo algarismo.
		if ($this->flag->intervaloComDezena->status() && preg_match('/' . $segundoAlgarismo . '/', $caractere)) {
			
			return 'segundoAlgarismo';
		}

		foreach ($regexs as $matchFunction => $regex) {
			
			$function = (preg_match('/' . $regex . '/', $caractere)) ? $matchFunction : $function;
			
			if ($function === $matchFunction) {
				break; //achou a primeira função em regexs.
			}
		}

		return $function;
	}

	private function sustenidoBemol(): string
	{
		if ($this->flag->eventoModular->status()) {
			return 'INSERIR_EM_REPROVADO';
		}

		//caso seja consistente.
		$this->flag->intervaloComsustenidoBemol->abrir();
		$this->flag->possivelIntervalo->abrir();
		$this->flag->aguardandoQualquerAlgarismo->abrir();
		return 'CHAMAR_PROXIMO_CARACTERE';
	}

	private function doisANove(): string
	{
		//Analisando inconsistências para dois a nove.
		$algarismosDuplicados = (($this->flag->eventoModular->status()) && (!$this->flag->intervaloComsustenidoBemol->status()));
		if ($algarismosDuplicados || $this->flag->intervaloComDezena->status()) {
			return 'INSERIR_EM_REPROVADO';
		}

		//caso seja consistente.
		$this->flag->possivelIntervalo->abrir();
		$this->flag->aguardandoQualquerAlgarismo->fechar();
		return 'CHAMAR_PROXIMO_CARACTERE';
	}

	private function maisOuMenos(): string
	{
		if ((!$this->flag->possivelIntervalo->status()) || ($this->flag->intervaloComsustenidoBemol->status())) {
			return 'INSERIR_EM_REPROVADO';
		}

		return 'CHAMAR_PROXIMO_CARACTERE';
	}



	private function dezena(): string
	{
		//verificando inconsistências para dezena.
		$evento = ($this->flag->possivelIntervalo->status() || $this->flag->eventoModular->status());
		$susBemolFechado = (!$this->flag->intervaloComsustenidoBemol->status());


		if ($evento && $susBemolFechado) {
			return 'INSERIR_EM_REPROVADO';
		}

		//caso seja consistente.
		$this->flag->possivelIntervalo->abrir();
		$this->flag->intervaloComDezena->abrir();
		return 'CHAMAR_PROXIMO_CARACTERE';
	}

	private function segundoAlgarismo(): string
	{
		//Inconsistências já foram analisadas para chamar este método em runRegex()
		$this->flag->segundoAgarismo->abrir();
		$this->flag->aguardandoQualquerAlgarismo->fechar();
		return 'CHAMAR_PROXIMO_CARACTERE';
	}
}
