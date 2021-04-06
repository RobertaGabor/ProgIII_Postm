<?php
include_once "usuario.php";

/*Aplicación No 22 ( Login)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario*/



#por postman pongo mail y clave y me busca en el csv si esta

if(isset($_POST['mail'])&&!empty($_POST['mail'])&&isset($_POST['clave'])&&!empty($_POST['clave'])&&isset($_POST['usuario'])&&!empty($_POST['usuario']))#si se paso la key listado y no esta vacia
{
	#creo un nuevo usuario con los datos
	$pendiente=new Usuario($_POST['usuario'],$_POST['mail'],$_POST['clave']);

	#busco y hago echo de lo que retorna
	echo $pendiente->BuscarUser();
}
else
{
	echo "Faltan datos";
}


?>