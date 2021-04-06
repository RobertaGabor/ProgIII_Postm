<?php
include_once "archivos.php";
class Usuario
{
	public $usuario;
	public $clave;
	public $mail;

	public function __construct($us,$ma,$cl)
	{
		$this->usuario=$us;
		$this->clave=$cl;
		$this->mail=$ma;
	}

	function __toString()
	{
		return $this->usuario. " - ". $this->clave. " - ". $this->mail;
	}

	static function listar($arrayTipo)
	{
		$union="";
		$union.="<ul>";
		foreach ($arrayTipo as $user) 
		{
			$union.="<li\>";
			$union.=$user->__toString();
			$union.="<li\>";
		}
		$union.="<ul\>";

		return $union;

	}

	public function BuscarUser()
	{
		$asw="";
		$registradosArray=Archivos::readCSV("usuarios");
		foreach ($registradosArray as $value) {
			if($this->mail == $value->mail && $this->clave == $value->clave && $this->usuario == $value->usuario)
			{
				$asw="Verificado";
				break;
			}
			elseif(($this->mail!=$value->mail||$this->usuario!=$value->usuario)&&$this->clave==$value->clave)
			{
				$asw="Error en los datos";
				break;
			}
			else
			{
				$asw="Usuario no registrado";

			}

		}
		return $asw;
	}
}


?>