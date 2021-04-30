<?php
include_once "AccesoDatos.php";
class venta{


public $nroPedido;
private $id;
public $cantidad;



public static function InsertarVentaParams($cant)
{
       $fecha=date("Y-m-d"); 
       $nro=random_int( 1000 , 100000 );
       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
       $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into ventas (fecha,nroPedido,cantidad)values(:fecha,:nro,:cantidad)");
       $consulta->bindValue(':nro', $nro, PDO::PARAM_STR);
       $consulta->bindValue(':fecha', $fecha, PDO::PARAM_STR);
       $consulta->bindValue(':cantidad', $cant, PDO::PARAM_STR);
       $consulta->execute();		
       return $objetoAccesoDato->RetornarUltimoIdInsertado();
}

public static function TraerTodasLasCantidades()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select  SUM(cantidad) from ventas");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "ventas");		
}

public static function TraerSegunFechas($f1,$f2)
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("select *  where ventas.fecha>=$f1 AND ventas.fecha<=$f2 from ventas");
        $consulta->execute();			
        return $consulta->fetchAll(PDO::FETCH_CLASS, "ventas");		
}

}


?>