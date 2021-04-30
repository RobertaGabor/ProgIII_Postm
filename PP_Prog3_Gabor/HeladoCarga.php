<?php
include_once "Archivos.php";
include_once "Helado.php";
/*B- (1 pt.) HeladoCarga.php: (por GET)se ingresa Sabor, precioBruto, Tipo (“agua” o “crema”), cantidad( de
unidades de palitos helados) el objeto helado tiene función que guarda el precio más IVA en el atributo
precioFinal. Se guardan los datos en en el archivo de texto helados.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
Validar que los valores sean válidos.

$us=array();
Archivos::writeJson($us);*/


/*(2 pts.)HeladoCarga.php:.(continuación) Cambio de get a post.
completar el alta con imagen del helado, guardando la imagen con el tipo y el sabor como nombre en la carpeta
/ImagenesDeHelados*/

if( isset($_POST["Sabor"]) && !empty($_POST["Sabor"])
    &&isset($_POST["precioBruto"]) && !empty($_POST["precioBruto"])
    &&isset($_POST["Tipo"]) && !empty($_POST["Tipo"])
    &&isset($_POST["cantidad"]) && !empty($_POST["cantidad"])
    && isset($_FILES["imagen"]) && ($_FILES["imagen"])!=null)
{
    $sabor=$_POST["Sabor"];
    $precioBruto=$_POST["precioBruto"];
    $tipo=$_POST["Tipo"];
    $cantidad=$_POST["cantidad"];
    $image=$_FILES["imagen"];

    $tmp = 'ImagenesDeHelados/'.$tipo.$sabor.$_FILES['imagen']['name'];
	move_uploaded_file($_FILES['imagen']['tmp_name'], $tmp);

    $lista=Archivos::readJson("helados");
    if($lista==-1)
    {
        $lista=array();
    }
    
    if($lista==2)
    {
        echo "El archivo no existe";
    }
    else
    {
        $nuevoHelado = helado::nuevoHelado($sabor,$precioBruto,$tipo,$cantidad);
        if($nuevoHelado!=null)
        {
            if(($index=helado::buscarHelado($lista,$nuevoHelado))>-1)
            {
                $aux=$lista[$index]['cantidad']+$nuevoHelado->cantidad;
                $lista[$index]['cantidad']=$aux;
                $lista[$index]['precioBruto']=$nuevoHelado->precioBruto;
                $lista[$index]['precioFinal']=$nuevoHelado->precioFinal;
                if(Archivos::writeJson($lista)){
                    echo "Actualizado";
                }
               
            }
            else
            {
                array_push($lista, $nuevoHelado);
                if(Archivos::writeJson($lista)){
                    echo "Agregado";
                }
                
            }
            
        }
        else
        {
            echo "No se pudo crear el helado";
        }
    }

}
else
{
    echo "Faltan datos";
}

?>