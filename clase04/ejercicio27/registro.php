<?php
   /* Aplicación No 27 (Registro BD)
    Archivo: registro.php
    método:POST
    Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
    crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
    guardando los datos la base de datos
    retorna si se pudo agregar o no.

    Roberta gabor*/

    include_once "AccesoDatos.php";
    include_once "usuarios.php";

    if( isset($_POST["nombre"]) && !empty($_POST["nombre"]) 
    && isset($_POST["apellido"]) && !empty($_POST["apellido"])
    && isset($_POST["clave"]) && !empty($_POST["clave"])
    && isset($_POST["email"]) && !empty($_POST["email"])
    && isset ($_POST["localidad"])&& !empty($_POST["localidad"]))
    {
        $newUser=new Usuario($_POST["nombre"],$_POST["apellido"],$_POST["clave"],$_POST["email"],$_POST["localidad"]);
        if($newUser!=null)
        {
            try
            {
                $newUser->setID($newUser->InsertarUsuarioParams());
                echo "Se agrego con exito";
            }
            catch(Exception $e)
            {
                echo "No se pudo agregar el usuario registrado: " + $e->getMessage();
            }
        }
    }
    else
    {
        echo "Faltan datos";
    }






?>

