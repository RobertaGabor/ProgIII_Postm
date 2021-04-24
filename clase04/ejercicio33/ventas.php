<?php
include_once "AccesoDatos.php";
class Venta
{

    private $id;
    public $id_producto;
    public $id_usuario;
    public $cantidad;


    public  static function constructAux($codigo,$idUser,$cantidad)
	{
		if($cantidad>0)
		{
            $instance= new self();
			$instance->id_producto=$codigo;
			$instance->id_usuario=$idUser;
			$instance->cantidad=$cantidad;
            return $instance;
			
		}

	}

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

    
    public function InsertarVentaParams()
    {
           $fecha=date("Y-m-d"); 
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into venta (id_producto,id_usuario,cantidad,fecha_de_venta)values(:idp,:idu,:cant,:fecha)");
           $consulta->bindValue(':idp',$this->id_producto, PDO::PARAM_INT);
           $consulta->bindValue(':idu', $this->id_usuario, PDO::PARAM_STR);
           $consulta->bindValue(':cant', $this->cantidad, PDO::PARAM_STR);
           $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
           $consulta->execute();		
           return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

}




?>