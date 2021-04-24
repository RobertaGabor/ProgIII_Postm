<?php
include_once "AccesoDatos.php";
class Producto
{
    private $id;
    public $Codigo;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;

    public  static function constructAux($codigo,$precio,$stock,$nombre,$tipo)
	{
		if(Producto::validarCodigo($codigo)==0&&$precio>=0&&$stock>=0)
		{
            $instance= new self();
			$instance->Codigo=$codigo;
			$instance->precio=$precio;
			$instance->stock=$stock;
			$instance->nombre=$nombre;
			$instance->tipo=$tipo;

            return $instance;
			
		}

	}



    public static function TraerTodosLosProductos()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,Codigo,nombre,tipo,stock,precio,fecha_de_creacion,ultimamodificacion from producto");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "producto");		
	}

    function __toString()
    {
        return $this->Codigo. " - ". $this->nombre. " - ". $this->tipo. " - ". $this->stock. " - ". $this->precio;
    }

    public static function devolverProductos($lista)
    {
        $union="";
        $union.="<ul>";
        foreach ($lista as $product) 
        {
            
            $union.="<li>";
            $union.=$product->__toString();
            $union.="<li\>";

        }            
        $union.="<ul\>";
    
        return $union;
    }

    private static function igualarCodigos($p,$c)
	{
		$ret=0;

		if($p->Codigo==$c)
		{
			$ret=1;
		}
		return $ret;
	}

	public static function buscarProductoIndice($array,$producto)
	{
		$ret=-1;
		$c=0;
		foreach ($array as $product) 
		{
			if(Producto::igualarProductos($product,$producto))
			{
				$ret=$c;
				break;
			}
			$c++;
		}
		return $ret;
	}

    public static function buscarProducto($array,$producto)
	{
		$ret=null;
		foreach ($array as $product) 
		{
			if(Producto::igualarProductos($product,$producto))
			{
				$ret=$product;
				break;
			}
		}
		return $ret;
	}

	private static function igualarProductos($p1,$p2)
	{
		$ret=0;

		if($p1->Codigo==$p2->Codigo)
		{
			$ret=1;
		}
		return $ret;
	}

	private static function validarCodigo($cod)
	{
		$ret=1;
		if(strlen($cod)==6)
		{
			$ret=0;
		}
		return $ret;
	}

    public function InsertarProductoParams()
    {
           $fecha=date("Y-m-d"); 
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (Codigo,nombre,tipo,stock,precio,fecha_de_creacion,ultimamodificacion)values(:codigo,:nombre,:tipo,:stock,:precio,:creacion,:modificacion)");
           $consulta->bindValue(':codigo',$this->Codigo, PDO::PARAM_INT);
           $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
           $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
           $consulta->bindValue(':stock', $this->stock, PDO::PARAM_STR);
           $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
           $consulta->bindValue(':creacion', $fecha, PDO::PARAM_STR);
           $consulta->bindValue(':modificacion', $fecha, PDO::PARAM_STR);
           $consulta->execute();		
           return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public function ModificarProductoStockParametros()
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               update producto 
               set stock=:stock
               WHERE id=:id");
           $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
           $consulta->bindValue(':stock',$this->stock, PDO::PARAM_INT);
           return $consulta->execute();
    }

}



?>