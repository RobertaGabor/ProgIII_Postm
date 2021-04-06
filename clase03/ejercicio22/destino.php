<?php
include_once "usuario.php";
include_once "archivos.php";



#ifisset
	if(isset($_POST["usuario"])&&isset($_POST["clave"])&&isset($_POST["mail"]))
	{
		$user=$_POST["usuario"];
		$psw=$_POST["clave"];
		$email=$_POST["mail"];	
		$nuevoUsuario = new Usuario($user,$email,$psw);
		#pongo construct y armo
		#if guardar en csv devuelve true sino false	

		if(Archivos::writeCSV($nuevoUsuario))
		{
			echo "Usuario registrado exitosamente";
		}
		else
		{
			echo "Usuario no se pudo registrar";
		}
		
	}


	



?>