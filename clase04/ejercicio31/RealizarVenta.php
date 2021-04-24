<?php
include_once "productos.php";
include_once "usuarios.php";
include_once "ventas.php";
/*
Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases


ROBERTA GABOR


*/

if(isset($_POST["codigo"]) && !empty($_POST["codigo"])
&& isset($_POST["id_usuario"]) && !empty($_POST["id_usuario"])
&& isset($_POST["cantidad"]) && !empty($_POST["cantidad"]))
{
    $cod=$_POST["codigo"];
    $user=$_POST["id_usuario"];
    $cant=$_POST["cantidad"];

    $productosLista=Producto::TraerTodosLosProductos();
    $usuariosLista=Usuario::TraerTodosLosUsuarios();
    if($productosLista!=null&&$usuariosLista!=null)
    {
        if(($productoEncontrado=Producto::buscarProductoCodigo($productosLista,$cod))!=null&&(Usuario::validarPorId($user,$usuariosLista))==1)
        {
            if($productoEncontrado->stock>$cant)
            {
                
                $venta=Venta::constructAux($productoEncontrado->getID(),$user,$cant);
                if($venta!=null)
                {
                    try
                    {
                        $productoEncontrado->stock=$productoEncontrado->stock-$cant;
                        $productoEncontrado->ModificarProductoStockParametros();
                        $venta->InsertarVentaParams();
                        echo "Venta realizada";
                    }
                    catch(Exception $e)
                    {
                        echo "No se pudo registrar en la base de datos". $e->getMessage();
                    }
                    
                }
                else
                {
                    echo "No se pudo registrar la venta";
                }
            }
            else
            {
                echo "No hay cantidad suficiente";
            }
        }
        else
        {
            echo "El producto o el usuario no existe";
        }
    }
    else
    {
        echo "No hay ventas registradas";
    }

}
else
{
    echo "Faltan datos";
}




?>