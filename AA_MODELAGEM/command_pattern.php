<?php
abstract class Command
{
  public Acorde $acorde;
  public int $key;
  
  public function __construct(Acorde $acorde, int $key)
  {
    $this->acorde = $acorde;
    $this->key  = $key;
  }
  
  abstract function analisar();
}

class SpaceCommand extends Command
{
  public function analisar()
  {
    echo $this->acorde->sinal.'- é acorde'.PHP_EOL;
    echo 'É acorde.'.PHP_EOL;
  }
}

class MenorCommand extends Command
{
  public function analisar()
  {
    //testar o membro this-acorde e this-key aqui
    //chamar MenorTipo daqui e setar caso positivo
    echo 'Menor'.PHP_EOL;
  }
}

class EnarmoniaCommand extends Command
{
  public function analisar()
  {
    //testar o membro this-acorde e this-key aqui
    //chamar EnarmoniaTipoTipo daqui e setar caso positivo
    echo 'Enarmoia.'.PHP_EOL;
  }
}



class Analise
{
  public Acorde $acorde;
  public array  $comandos;
  public Command $command;
  
  public function __construct(Acorde $acorde)
  {
    echo 'Cifra: '.PHP_EOL;var_dump($acorde);
    $this->acorde = $acorde;
    $this->comandos = (new ListaComandos)->get();
  }
  
  public function analisar()
  {
    foreach(str_split($this->acorde->sinal) as $key => $caractere){
      if($key == 0){continue;}
      
      if(!array_key_exists($caractere, $this->comandos)){
        echo $this->acorde->sinal.'não é acorde'.PHP_EOL;
        break;
      }
      
      $nomeComando = $this->comandos[$caractere];
      $this->command = new $nomeComando($this->acorde, $key);//fazer a injeção de dependência.
      $this->command->analisar();
    }
  }
}

class ListaComandos
{
  public function get()
  {
    return [
      ' '=> 'SpaceCommand',
      'm'=> 'MenorCommand',
      '#'=>'EnarmoniaCommand',
      'b'=>'EnarmoniaCommand'
    ];
  }
}

class TrinarioString
{
  public bool|string $valor;//não testado
  
  public function __construct(mixed $valor = 'NaoTestado')
  {
    try {
      if((!is_string($valor))&&($valor !== false)){
        throw new TypeError('Trinario apenas aceita string ou false como valor');
      }
    } catch(TypeError $e) {
      echo $e->getMessage();
      die();
    }
    $this->valor = $valor;  
  }
  
  public function get()
  {
    return $this->valor;
  }
}

interface Tipo
{
  //
}

class EnarmoniaTipo implements Tipo
{
  public string $sinal;
  
  public function __construct(mixed $susOuBemol = 'NaoTestado')
  {
    $this->setSusOuBemol($susOuBemol);
  }
  
  public function setSusOuBemol(mixed $susOuBemol = 'NaoTestado')
  {
    try{
      if($susOuBemol !== '#' && $susOuBemol !== 'b' && $susOuBemol != 'NaoTestado'){
        throw new TypeError('Enarmonia apenas aceita [#] ou [b] como valor.');
      }
    }catch(TypeError $e){
      echo $e->getMessage();
      die();
    }
    
    $this->sinal = $susOuBemol;
  }
}

class Acorde
{
  public string $sinal;
  public TrinarioString $inversao;
  public TrinarioString $terca;
  public TrinarioString $quinta;
  public Tipo $enarmonia;
  
  public function __construct(string $protot)
  {
    $this->sinal = $protot;
    $this->inversao = new TrinarioString();
    $this->terca = new TrinarioString();
    $this->quinta = new TrinarioString();
    $this->enarmonia = new EnarmoniaTipo();
  }
}

//análise talvez tenha que implementar command.php
$protot = fgets(STDIN);//recebe a entrada 'Cm'
$protot .= ' ';
$acorde = new Acorde($protot);
//echo 'valor é: ';var_dump($acorde);
$analise = new Analise($acorde);
$analise->analisar();
