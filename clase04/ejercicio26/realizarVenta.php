<?php
include_once "archivos.php";
include_once "producto.php";
include_once "usuario.php";
include_once "venta.php";
/*
Aplicación No 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
carga los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases


ROBERTA GABOR

*/

#chequear que exista id usuario
#chequear exista codigo producto
#chequear exista stock de ese codigo
#descontar stock de ese producto en el json -> creo lo mismo hecho en alta producto pero descontar
#creo json de ventas con id user codigo producto y cuantos vendio
#echo de lo que se realizo

	if( isset($_POST["codigo_producto"]) && !empty($_POST["codigo_producto"]) 
	    && isset($_POST["id_user"]) && !empty($_POST["id_user"])
	    && isset($_POST["cantidad"]) && !empty($_POST["cantidad"]))
	{
		$idUs=$_POST["id_user"];
		$codPr=$_POST["codigo_producto"];
		$cant=$_POST["cantidad"];

		$lista=Archivos::readJson("ventas");
		$readProduct=Archivos::readJson("productos");
		$readUser=Archivos::readJson("usuarios");


		if($readUser!=-1&&$readUser!=2&&$readProduct!=-1&&$readProduct!=2)
		{
			if(($indexPr=Producto::buscarProductoCodigo($readProduct,$codPr))!=-1&&Usuario::buscarUsuarioCodigo($idUs,$readUser)!=-1)
			{
				if($readProduct[$indexPr]['stock']>=$cant)
				{
					#escribo venta
					if($lista!=2)
					{

						if ($lista==-1) 
						{
							$lista=array();#armo un array vacio para agregar
						}
						$venta= new Venta($codPr,$idUs,$cant);
						array_push($lista, $venta);
						Archivos::writeJson($lista,"ventas");
						echo "Se ha registrado la venta\n";

						#modifico stock
						$s=$readProduct[$indexPr]['stock']-$cant; #solo puedo usar x index
						$readProduct[$indexPr]['stock']=$s;
						Archivos::writeJson($readProduct,"productos");
						echo "Se ha modificado el stock segun venta\n";	
					}
					else
					{
						echo "No existe el archivo para registrar la venta\n";
					}
									
				}
				else
				{
					echo "No hay stock suficiente\n";
				}
			}
			else
			{
				echo "no existe el usuario o el producto\n";
			}
		}
		else
		{
			echo "Archivos inexistentes o vacios para realizar compra\n";
		}







	}
	else
	{
		echo "Faltan datos\n";
	}






?>