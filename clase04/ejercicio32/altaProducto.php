<?php

include_once "productos.php";
/*
Aplicación No 30 ( AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega .
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
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
    $newProduct= Producto::constructAux($_POST["codigo"],$_POST["precio"],$_POST["stock"],$_POST["nombre"],$_POST["tipo"]);
    if($newProduct!=null)
    {
        $productos=Producto::TraerTodosLosProductos();
        if($productos!=null)
        {
            if(($productoBuscado=Producto::buscarProducto($productos,$newProduct))!=null)
            {
                $stock=$_POST["stock"];
                $stock+=$productoBuscado->stock;
                $productoBuscado->stock=$stock;
                $productoBuscado->ModificarProductoStockParametros();
                echo "Actualizado";
            }
            else
            {
                #agregar
                try
                {
                    $newProduct->InsertarProductoParams();
                    echo "Ingresado";
                }
                catch(Exception $e)
                {
                    echo "No se pudo ingresar el nuevo producto". $e->getMessage();
                }
            }
        }
        else
        {
            echo "Registro vacio";
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