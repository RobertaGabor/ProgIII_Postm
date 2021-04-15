<?php
include_once "archivos.php";
include_once "bridgeClass.php";
class Usuario extends Bridge
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

			if(($this->id=Bridge::setID("usuarios"))!=0)
			{
				$this->usuario=$us;
				$this->clave=$cl;
				$this->mail=$ma;	
					
				$this->fecha=date('d/m/Y h:i:s');
				$this->foto=$fo;				
			}


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

	public static function buscarUsuarioCodigo($codigo,$array)
	{
		$ret=-1;
		$c=0;
		foreach ($array as $user) 
		{
			if(Usuario::igualarCodigos($codigo,$user))
			{
				$ret=$c;
				
				break;
			}
			$c++;
		}
		return $ret;
	}
	private static function igualarCodigos($c,$u)
	{
		$ret=0;

		if($c==$u['id'])
		{
			$ret=1;
		}
		return $ret;
	}

}


?>