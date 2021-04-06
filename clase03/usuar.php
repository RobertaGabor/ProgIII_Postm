<?php

class Usuar
{
	public $_usuario;
	public $_clave;

	static function ValidarUsuario(Usuar $usuario)
	{
		$estado=null;
		if(isset($usuario->_usuario)&&isset($usuario->_clave))#si el usuario esta seteado
		{
			if($usuario->_usuario=="admin"&&$usuario->_clave=="1111")
			{
				echo "okay";
				$estado="okay";
				
			}
			else
			{
				echo "usuario no registrado";
				$estado="usuario no registrado";
			}
			

		}
		else
		{
			echo "faltan datos";
			$estado="faltan datos";
		}
		$miArchivo=fopen("log.txt", "a");
		fwrite($miArchivo, "$estado,$usuario->_usuario,".date("Ymd")."\n");
		fclose($miArchivo);
	}
}


?>