<?php

include_once "usuarios.php";
include_once "ventas.php";
include_once "productos.php";

/*Aplicación Nº 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table>*/ 

if( isset($_GET["listado"]) && !empty($_GET["listado"]))
{
    $listado=$_GET["listado"];
	switch ($listado) {
        case 'usuarios':
            print(Usuario::devolverUsuarios(Usuario::TraerTodosLosUsuarios()));
            break;
        case 'productos':
            print(Producto::devolverProductos(Producto::TraerTodosLosProductos()));
            break; 
        case 'ventas':
            print(Venta::devolverVentas(Venta::TraerTodasLasVentas()));
            break;      
        default:
            echo "No es un nombre de listado valido";
            break;
    }
}
else
{
    echo "Faltan datos";
}




?>