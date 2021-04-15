<?php
include_once "archivos.php";
include_once "producto.php";
/*
Aplicación No 25 ( AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase

Roberta gabor

*/

	if( isset($_POST["codigo"]) && !empty($_POST["codigo"]) 
	    && isset($_POST["nombre"]) && !empty($_POST["nombre"])
	    && isset($_POST["tipo"]) && !empty($_POST["tipo"])
	    && isset($_POST["stock"]) && !empty($_POST["stock"]) 
		&& isset($_POST["precio"]) && !empty($_POST["precio"]))
	{

		$code=$_POST["codigo"];
		$name=$_POST["nombre"];
		$type=$_POST["tipo"];
		$stock=$_POST["stock"];
		$price=$_POST["precio"];

		$lista=Archivos::readJson("productos");

		if($lista!=2)
		{

			if ($lista==-1) 
			{
				$lista=array();#armo un array vacio para agregar
			}
			$product=new Producto($code,$price,$stock,$name,$type);

			if($product->getCodigo()!=null)
			{
				if(($igual= Producto::buscarProducto($lista,$product))!=-1)
				{
					#existe
					/*$s=$igual['stock']+$product->getStock();
					$igual['stock']=$s;*/
					$s=$lista[$igual]['stock']+$product->getStock(); #solo puedo usar x index
					$lista[$igual]['stock']=$s;

					echo "Actualizado\n";
				}
				else
				{
					#no existe
					array_push($lista, $product);
					echo "Ingresado\n";
				}

				Archivos::writeJson($lista,"productos");
			}
			else
			{
				echo "No se pudo hacer\n";
			}
		}
		else
		{
			echo "No se encontro el archivo\n";
		}


		
	}
	else
	{
		echo "Faltan datos\n";
	}



?>