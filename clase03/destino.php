<?php
include "usuar.php";

	/*echo"Array get: ";
	var_dump($_GET);
	echo"<br/>Array post: ";
	var_dump($_POST);#despues puse send y aparecio*/

	/*if(isset($_POST["usuario"])&&isset($_POST["clave"]))#si el usuario esta seteado
	{
		$usuarioIngresado=$_POST["usuario"];
		$claveIngresada=$_POST["clave"];
		if($usuarioIngresado=="admin"&&$claveIngresada=="1111")
		{
			echo "okay";
		}
		else
		{
			echo "usuario no registrado";
		}
		

	}
	else
	{
		echo "faltan datos";
	}*/

	$nuevoUsuario=new Usuar();
	$nuevoUsuario->_usuario=$_POST["usuario"];
	$nuevoUsuario->_clave=$_POST["clave"];

	echo Usuar::ValidarUsuario($nuevoUsuario);


?>