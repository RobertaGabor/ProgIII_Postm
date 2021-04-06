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
}


?>