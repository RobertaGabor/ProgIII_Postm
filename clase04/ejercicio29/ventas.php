<?php
include_once "AccesoDatos.php";
class Venta
{

    private $id;
    public $id_producto;
    public $id_usuario;
    public $cantidad;


    public static function TraerTodasLasVentas()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,id_producto,id_usuario,cantidad,fecha_de_venta from venta");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "venta");		
	}

    function __toString()
    {
        return $this->id_producto. " - ". $this->id_usuario. " - ". $this->cantidad;
    }

    public static function devolverVentas($lista)
    {
        $union="";
        $union.="<ul>";
        foreach ($lista as $venta) 
        {
            
            $union.="<li>";
            $union.=$venta->__toString();
            $union.="<li\>";

        }            
        $union.="<ul\>";
    
        return $union;
    }

}




?>