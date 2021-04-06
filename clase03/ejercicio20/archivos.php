<?php
include_once "usuario.php";
/*método:POST
Recibe los datos del usuario(nombre, clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos en usuarios.csv.
retorna si se pudo agregar o no.
Cada usuario se agrega en un renglón diferente al anterior.
Hacer los métodos necesarios en la clase usuario*/

	class Archivos
	{
		 static function writeCSV(Usuario $usuario)
		 {
		 	if(!empty($usuario->usuario)&&!empty($usuario->clave)&&!empty($usuario->mail))
		 	{
			 	$data="$usuario->usuario,$usuario->mail,$usuario->clave\n";
			 	if(($miArchivo=fopen("usuarios.csv", "a"))!=FALSE)
			 	{
					fwrite($miArchivo,$data);
					fclose($miArchivo);	
				return TRUE;			 		
			 	}
	 		
		 	}
		 	return FALSE;
		 }	
	}


	#Guardar


?>