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


    public static function nuevoUser($nombre,$apellido,$clave,$email,$locacion)
    {
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->clave=$clave;
        $this->email=$email;
        $this->localidad=$locacion;
        
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


    function __toString()
    {
        return $this->nombre. " - ". $this->apellido. " - ". $this->email. " - ". $this->localidad;
    }

    public static function devolverUsuarios($lista)
    {
        $union="";
        $union.="<ul>";
        foreach ($lista as $user) 
        {
            
            $union.="<li>";
            $union.=$user->__toString();
            $union.="<li\>";

        }            
        $union.="<ul\>";
    
        return $union;
    }

    public static function TraerTodosLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre,apellido,clave,email,Fechaderegistro,localidad from usuario");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "usuario");		
	}


    /*si existe lo atre sino deuelve null*/
    public static function ValidarUsuario($clave,$mail) 
	{

        try
        {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta("select id,nombre,apellido,clave,email,Fechaderegistro,localidad from usuario");
            $consulta->execute();
            $users=$consulta->fetchAll(PDO::FETCH_CLASS, "usuario"); 

            foreach ($users as $user) 
            {
                if(($value = $user->igualarUsuario($clave,$mail))!=0)
                {
                    break;
                }
            
            }
            return $value;
           
        }
        catch(Exception $e)
        {
            return $e->getMessage();
        }   					
	}

    public function igualarUsuario($clave,$mail)
    {
        $ret=0;

        if($this!=null)
        {
            if($mail==$this->email&&$clave==$this->clave)
            {
                $ret=1;
            }
            if($mail==$this->email&&$clave!=$this->clave)
            {
                $ret=-1;
            }
        }


        return $ret;
    }

    public static function validarPorId($id,$array)
    {
        $ret=0;
        foreach ($array as $value) 
        {
            if($value->id==$id)
            {
                $ret=1;
                break;              
            }
 
        }

        return $ret;
    }

    public static function validarPorMail($mail,$array)
    {
        $ret=null;
        foreach ($array as $value) 
        {
            if($value->email==$mail)
            {
                $ret=$value;
                break;              
            }
 
        }

        return $ret;        
    }

    public function ModificarContraseñaParametros()
    {
           $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
           $consulta =$objetoAccesoDato->RetornarConsulta("
               update usuario 
               set clave=:clave
               WHERE id=:id");
           $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
           $consulta->bindValue(':clave',$this->clave, PDO::PARAM_INT);
           return $consulta->execute();
    }
}


?>