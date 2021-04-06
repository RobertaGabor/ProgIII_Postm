<?php

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
}


?>