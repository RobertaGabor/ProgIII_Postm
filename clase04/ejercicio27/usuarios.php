<?php

include_once "AccesoDatos.php";
class Usuario
{
    private $id;
    public $nombre;
    public $apellido;
    public $clave;
    public $email;
    public $localidad;


    public function __construct($nom,$ape,$cla,$ema,$loc)
    {
        $this->nombre=$nom;
        $this->apellido=$ape;
        $this->clave=$cla;
        $this->email=$ema;
        $this->localidad=$loc;
        
    }

    public function setID($id)
    {
        $this->is=$id;
    }

    public function InsertarUsuarioParams()
    {
           $fecha=date("Y-m-d"); 
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuario (nombre,apellido,clave,email,Fechaderegistro,localidad)values(:nombre,:apellido,:clave,:email,:Fechaderegistro,:localidad)");
           $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
           $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
           $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
           $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
           $consulta->bindValue(':Fechaderegistro', $fecha, PDO::PARAM_STR);
           $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
           $consulta->execute();		
           return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }



}


?>