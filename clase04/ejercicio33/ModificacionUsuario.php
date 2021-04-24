<?php
include_once "usuarios.php";
/*
Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave

ROBERTA GABOR



*/
if(isset($_POST["clavenueva"]) && !empty($_POST["clavenueva"])
&& isset($_POST["nombre"]) && !empty($_POST["nombre"])
&& isset($_POST["clavevieja"]) && !empty($_POST["clavevieja"])
&& isset($_POST["mail"]) && !empty($_POST["mail"]))
{
    $nueva=$_POST["clavenueva"];
    $nombre=$_POST["nombre"];
    $vieja=$_POST["clavevieja"];
    $mail=$_POST["mail"];
    #confirmar que clave vieja es igual a la clave y que el mail es igual al mail
    $users=Usuario::TraerTodosLosUsuarios();
    if($users!=null)
    {
        $found=Usuario::validarPorMail($mail,$users);
        if($found!=null)
        {
            
            if($found->clave==$vieja)
            {
                $found->clave=$nueva;
                $found->ModificarContraseñaParametros();
                echo "Se cambio la contarseña";
            }
            else
            {
                echo "La antigua contraseña es incorrecta";
            }
        }
        else
        {
            echo "El mail no está registrado en la base de datos";
        }
    }
    else
    {
        echo "No hay registro de usuarios aun";
    }
    
}
else
{
    echo "Faltan datos";
}









?>