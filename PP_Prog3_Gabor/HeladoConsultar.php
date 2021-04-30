<?php
include_once "Archivos.php";
include_once "Helado.php";
/*2-
(1pt.) HeladoConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo
helados.json, retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.*/

if( isset($_POST["Sabor"]) && !empty($_POST["Sabor"])
    &&isset($_POST["Tipo"]) && !empty($_POST["Tipo"]))
{
    $sabor=$_POST["Sabor"];
    $tipo=$_POST["Tipo"];

    $lista=Archivos::readJson("helados");
    if($lista==-1)
    {
        echo "La lista esta vacia";
    }
    elseif($lista==0)
    {
        echo "No existe el archivo";
    }
    else
    {
        $nuevoHelado= helado::nuevoHelado($sabor,1,$tipo,1);
        if(helado::buscarHelado($lista,$nuevoHelado)>-1)
        {
            echo "Si hay";
        }
        else
        {
            echo "No hay";
        }
    }
}
else
{
    echo "Faltan datos";
}

?>