<?php
include_once "Archivos.php";
include_once "venta.php";
include_once "Helado.php";
/*a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe
 en
helados.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.*/

if( isset($_POST["email"]) && !empty($_POST["email"])
    &&isset($_POST["sabor"]) && !empty($_POST["sabor"])
    &&isset($_POST["tipo"]) && !empty($_POST["tipo"])
    &&isset($_POST["cantidad"]) && !empty($_POST["cantidad"]))
{
    $email=$_POST["email"];
    $sabor=$_POST["sabor"];
    $tipo=$_POST["tipo"];
    $cantidad=$_POST["cantidad"];

    $lista=Archivos::readJson("helados");
    if($lista==-1)
    {
        echo "La lista esta vacia";
    }
    elseif($lista==0)
    {
        echo "No existe el archivo";
    }
    else
    {
        $nuevoHelado= helado::nuevoHelado($sabor,1,$tipo,$cantidad);
        if(($index=helado::buscarHelado($lista,$nuevoHelado))>-1)
        {
            if($lista[$index]['cantidad']>=$nuevoHelado->cantidad)
            {
                venta::InsertarVentaParams($cantidad);
                $lista[$index]['cantidad']=$lista[$index]['cantidad']-$cantidad;
                if(Archivos::writeJson($lista)){
                    echo "Stock actualizado y registro en base de datos";
                }
            }
            else
            {
                echo "No hay cantidad suficiente";
            }
        }
        else
        {
            echo "No existe";
        }
    }
}
else
{
    echo "Faltan datos";
}



?>