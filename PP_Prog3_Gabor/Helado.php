<?php
include_once "Archivos.php";
class helado
{
    public $id;
    public $Sabor;
    public $precioBruto;
    public $Tipo;
    public $cantidad;
    public $precioFinal;


    public static function nuevoHelado($sabor,$precioB,$tipo,$cantidad)
    {
        
        if($cantidad>0&&helado::validarTipo($tipo)==true&&$precioB>0)
        {
            $instance= new self();
            $instance->id=$instance->setID();
            $instance->Sabor=$sabor;
            $instance->Tipo=$tipo;
            $instance->cantidad=$cantidad;
            $instance->precioBruto=$precioB;
            $instance->precioFinal=helado::precioFinal($precioB);
            return $instance;
        }

        
    }

    private static function precioFinal($preciobruto)
    {
        return ($preciobruto*0.21)+$preciobruto;
    }

    private static function validarTipo($tipo)
    {
        $ret=false;
        if($tipo=="agua"||$tipo=="crema")
        {
            $ret=true;
        }
        return $ret;
    }

    private function setID()
	{
		$list=Archivos::readJson("helados");

		if($list==2)
		{
			echo "No se encuentra el archivo\n";
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
	public static function buscarHelado($array,$helado)
	{
		$ret=-1;
		$c=0;
		foreach ($array as $ice) 
		{
			if(helado::compararTipos($ice,$helado))
			{
				$ret=$c;
				break;
			}
			$c++;
		}
		return $ret;
	}
    public static function compararTipos($t1Array,$t2)
    {
        $ret=false;
        if($t1Array!=null&&$t2!=null)
        {
            if($t1Array['Tipo']==$t2->Tipo&&$t1Array['Sabor']==$t2->Sabor)
            {
  
                $ret=true;
            }
        }

        return $ret;
    }

    


}




?>