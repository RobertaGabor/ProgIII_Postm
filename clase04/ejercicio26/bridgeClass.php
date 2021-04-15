<?php
include_once "archivos.php";
class Bridge
{
		protected static function setID($tipo)#protected asi no acceden
		{
			$list=Archivos::readJson("$tipo");

			if($list==2)
			{
				echo "No se encuentra el archivo\n";
				return 0;
			}
			elseif ($list==-1) 
			{
				echo "Archivo vacio\n";
				return 1;
				
			}
			else
			{
				echo "Se leyo correctamente\n";
				$total=sizeof($list);
				$aux= $list[$total-1]['id']+1;
				return $aux;
				
			}
		}

}


?>