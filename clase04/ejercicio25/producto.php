<?php

class Producto
{

#si es protected me escribe null en json aun con getter 
	public $codigo;#tiener que ser de 6 cifras
	public $precio;
	public $stock;
	public $id;
	public $nombre;
	public $tipo;


	public function __construct($codigo,$precio,$stock,$nombre,$tipo,$array)
	{
		if(Producto::validarCodigo($codigo)==1&&$precio>0&&$stock>0)
		{
			$this->codigo=$codigo;
			$this->precio=$precio;
			$this->stock=$stock;
			$this->nombre=$nombre;
			$this->tipo=$tipo;
			$this->id=$this->setID($array);
		}

	}





	private function setID($array)#modifico le paso array TEST
	{
		if(sizeof($array)>0)
		{
			echo "Se leyo correctamente\n";
			$total=sizeof($array);
			$aux= $array[$total-1]['id']+1;
			return $aux;			
		}
		else
		{
			echo "Se ha creado el primer producto\n";
			return 1;
		}


	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getTipo()
	{
		return $this->tipo;
	}
	
	public function getPrecio()
	{
		return $this->precio;
	}
	
	public function getStock()
	{
		return $this->stock;
	}

	public function setStock($valor)
	{
		$this->stock=$valor;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getCodigo()
	{
		return $this->codigo;
	}

	public static function buscarProducto($array,$producto)
	{
		$ret=-1;
		$c=0;
		foreach ($array as $product) 
		{
			if(Producto::igualarProductos($product,$producto))
			{
				#$ret=$product;#devuelve el producto igual
				$ret=$c;
				
				break;
			}
			$c++;
		}
		return $ret;
	}
	private static function igualarProductos($p1,$p2)
	{
		$ret=0;

		if($p1['codigo']==$p2->getCodigo())
		{
			$ret=1;
		}
		return $ret;
	}

	private static function validarCodigo($cod)
	{
		$ret=1;
		if(strlen($cod)>6)
		{
			$ret=0;
		}
		return $ret;
	}

}




?>