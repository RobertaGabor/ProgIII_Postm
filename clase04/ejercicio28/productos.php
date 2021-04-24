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
}



?>