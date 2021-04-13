<?php
include_once "archivos.php";
class Usuario
{
	public $usuario; #cambiare a protected 
	public $clave;
	public $mail;
	public $id;
	public $fecha;


	public function __construct($us,$ma,$cl)
	{
		if($us!=null&&$ma!=null&&$cl!=null)
		{
			$this->usuario=$us;
			$this->clave=$cl;
			$this->mail=$ma;	
			$this->id=$this->setID();	
			$this->fecha=date('d/m/Y h:i:s');

		}

	}


	public function __toString()
	{
		return $this->usuario. " - ". $this->clave. " - ". $this->mail. " - ". $this->id. " - ". $this->fecha;
	}

	private function setID()
	{
		$list=Archivos::readJson("usuarios");

		if($list==2)
		{
			echo "No se encuentra el archivo";
		}
		elseif ($list==-1) 
		{
			echo "Archivo vacio";
			return 1;
			
		}
		else
		{
			echo "Se leyo correctamente";
			$total=sizeof($list);
			$aux= $list[$total-1]['id']+1;
			return $aux;
			
		}
	}



}


?>