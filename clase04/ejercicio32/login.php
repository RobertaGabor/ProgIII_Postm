<?php
include_once "usuarios.php";
/*
Aplicación No 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.


ROBERTA GABOR

*/ 

if(isset($_POST["clave"]) && !empty($_POST["clave"])
&& isset($_POST["email"]) && !empty($_POST["email"]))
{
    $clave=$_POST["clave"];
    $mail=$_POST["email"];


    /*verificar si ese usuario esta en la abse de datos*/
    $esta=Usuario::ValidarUsuario($clave,$mail);
    switch ($esta) 
    {
        case '1':
                echo "Verificado";
            break;
        case '0':
                echo "Usuario no registrado";
            break;
        case '-1':
                echo "Error en los datos";
            break;       
        default:
            echo "Hubo un error en la validacion";
            break;
    }
}
else
{
    echo "Faltan datos";
}




?>