<?php
include_once "productos.php";
/*
Aplicación No 33 ( ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
el código de barras .
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase

ROBERTA GABOR

*/
if(isset($_POST["codigo"]) && !empty($_POST["codigo"])
&& isset($_POST["nombre"]) && !empty($_POST["nombre"])
&& isset($_POST["tipo"]) && !empty($_POST["tipo"])
&& isset($_POST["stock"]) && !empty($_POST["stock"])
&& isset($_POST["precio"]) && !empty($_POST["precio"]))
{
    $codigo=$_POST["codigo"];
    $nombre=$_POST["nombre"];
    $tipo=$_POST["tipo"];
    $stock=$_POST["stock"];
    $precio=$_POST["precio"];
    $newProduct= Producto::constructAux($codigo,$precio,$stock,$nombre,$tipo);
    if($newProduct!=null)
    {
        $productos=Producto::TraerTodosLosProductos();
        if($productos!=null)
        {
            if(($productoBuscado=Producto::buscarProducto($productos,$newProduct))!=null)
            {
                $productoBuscado->stock=$stock;
                $productoBuscado->nombre=$nombre;
                $productoBuscado->tipo=$tipo;
                $productoBuscado->precio=$precio;

                $productoBuscado->ModificarProductoEntero();
                echo "Actualizado";
            }
            else
            {
                echo "El codigo de barras no se encuentra en la base de datos";
            }
        }
        else
        {
            echo "No hay productos registrados aun";
        }
    }
    else
    {
        echo "No se pudo hacer";
    }




}
else
{
    echo "Faltan datos";
}





?>