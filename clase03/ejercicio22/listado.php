<?php
include_once "usuario.php";
include_once 'archivos.php';
/*

Aplicación No 21 ( Listado CSV y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios). --> en postman paso que quiero 
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>
Hacer los métodos necesarios en la clase usuario

*/

#delcaro array de objetos usuarios a obtener que lo pasa la funcion.
#hago funcion que devbuelva esos objetpos en lista

if(isset($_GET['listado'])&&!empty($_GET['listado']))#si se paso la key listado y no esta vacia
{
	$key=$_GET['listado'];
	switch ($key) {
		case 'usuarios':#llamo a archivos leer y listo
			$lectura=Archivos::readCSV($key);
			if($lectura!=null)
			{
				echo Usuario::listar($lectura);
			}
			break;
		default:
			# code...
			break;
	}
}


?>