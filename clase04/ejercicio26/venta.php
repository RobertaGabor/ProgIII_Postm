<?php

class Venta extends Bridge
{
	public $id;
	public $codigoP;
	public $idUser;
	public $cantidad;
	public $fecha;



	public function __construct($codigo,$user,$canti)
	{
		if(($this->id=Bridge::setID("ventas"))!=0)
		{
			$this->codigoP=$codigo;
			$this->idUser=$user;
			$this->cantidad=$canti;
			$this->fecha=date('d/m/Y h:i:s');
		}

	}


}





?>