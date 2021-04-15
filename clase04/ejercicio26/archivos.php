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



		 static function readCSV($tipo)//leerlo y convertirlo en objeto
		 {
		 	$list=array();
		 	if(($miArchivo=fopen("$tipo.csv", "r"))!=FALSE)
		 	{
		 		while (($data = fgetcsv($miArchivo)) !== FALSE) 
		 		{
		 			# fgetcsv() analiza la línea que lee para buscar campos en formato CSV, devolviendo un array que contiene los campos leídos.
		 			$userAux= new Usuario($data[0],$data[1],$data[2]);
		 			array_push($list, $userAux);
				}
				fclose($miArchivo);
				return $list;
		 	}
		 	return null;

		 }


		static function writeJson($us,$type)
		{
			#traer a todos en memoria cuando leo y sobreescribir el archivo con todos

			$row=json_encode($us,JSON_PRETTY_PRINT);
			if(($file = fopen("$type.json", "w"))!=FALSE)
			{
				fwrite($file, $row);   
				fclose($file);	
				return true;			
			}
			return false;


		}
		#si existe y esta vacio return -1, si no existe return 2, si existe y tiene producto tira el array
		static function readJson($tipo)
		{
			$arrayJson=array();
			$var=-1;
		 	if(($file = fopen("$tipo.json", "r"))!=FALSE)
		 		#si uso vars usar "" no ''
		 	{
		 		if($file!=null&&filesize("$tipo.json")>0)
		 		{

					$readjson = file_get_contents("$tipo.json") ;

					
					$arrayJson = json_decode($readjson, true);
		    		fclose($file);
		    		$var=1;		 		
	    		}


		 	}
		 	else
		 	{
		 		$var=2;

		 	}

		 	
		 	if($var==1)
		 	{
		 		return $arrayJson;
		 	}
		 	else
		 	{
		 		return $var;
		 	}

		}


	}


	#Guardar


?>