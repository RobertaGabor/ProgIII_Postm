<?php

include_once "usuario.php";
include_once "archivos.php";

/*Aplicación No 23 (Registro JSON)
Archivo: registro.php
método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
poder hacer el alta,
guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
Usuario/Fotos/.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario.

ROBERTA GABOR*/
	
		

		#hacer validaciones ISSET Y EMPTY
	if( isset($_POST["usuario"]) && !empty($_POST["usuario"]) 
	    && isset($_POST["clave"]) && !empty($_POST["clave"])
	    && isset($_POST["mail"]) && !empty($_POST["mail"])
	    && isset($_FILES["imagen"]) && ($_FILES["imagen"])!=null )
	{
			$user=$_POST["usuario"];
			$psw=$_POST["clave"];
			$email=$_POST["mail"];	
			$image=$_FILES["imagen"];

			
			$lista=Archivos::readJson("usuarios");
			if($lista==2||$lista==-1)
			{
				$lista=array();
			}
			$nuevoUsuario = new Usuario($user,$email,$psw,$image);
			array_push($lista, $nuevoUsuario);

			$tmp = 'Usuario/Fotos/'.$nuevoUsuario->id.'_'.$_POST["usuario"].'_'.$_FILES['imagen']['name'];
			move_uploaded_file($_FILES['imagen']['tmp_name'], $tmp);
			
			if(Archivos::writeJson($lista)){
				echo "\nse cargo el usuario";
			}
			else
			{
				echo "no se pudo cargar el usuario";
			}

	
	}
	else
	{
		echo "Faltan datos";
	}



?>