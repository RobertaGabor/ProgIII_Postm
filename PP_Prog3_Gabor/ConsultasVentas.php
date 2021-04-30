<?php
include_once "venta.php";
/*4- (3 pts.)ConsultasVentas.php: necesito saber :
a- la cantidad de helados vendidos
b- el listado de los usuarios que realizaron compras entre dos fechas.
c- el listado de ventas de un usuario ingresado
d- el listado de ventas de un tipo ingresado*/

if( isset($_GET["consulta"]) && !empty($_GET["consulta"]))
{
    $consulta=$_GET["consulta"];
    switch($consulta)
    {
        case 'a':
            echo venta::TraerTodasLasCantidades();
            break;
        case 'b':
            echo venta::TraerSegunFechas("2021-04-27","2021-04-28");
            break;
        case 'c':
            break;
        case 'd':
            break;
        default:
        echo "Consulta invalida";
        break;
    }
}




?>