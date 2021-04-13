<?php
include_once "archivos.php";
class Usuario
{
	public $usuario; #cambiare a protected //se rompe todo a la mierda si cambio
	public $clave;
	public $mail;
	public $id;
	public $fecha;
	public $foto;


	public function __construct($us,$ma,$cl,$fo)
	{
		if($us!=null&&$ma!=null&&$cl!=null&&$fo!=null)
		{
			$this->usuario=$us;
			$this->clave=$cl;
			$this->mail=$ma;	
			$this->id=$this->setID();	
			$this->fecha=date('d/m/Y h:i:s');
			$this->foto=$fo;

		}

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

	static function listar($arrayTipo)
	{
		$union="";
		$union.="<ul>";
		foreach ($arrayTipo as $user) 
		{
			$union.="<li>";
			$union.=$user['usuario']. " - ". $user['clave']. " - " ;
			$union.='<img width="100" height="100" src="/Usuario/Fotos/'.$user["id"]."_".$user["usuario"]."_".$user["foto"]["name"].'">';
			$union.="<li\>";
		}
		$union.="<ul\>";

		return $union;

	}

}


?>