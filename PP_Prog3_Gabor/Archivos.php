<?php

class Archivos{
    static function writeJson($us)
    {
        #traer a todos en memoria cuando leo y sobreescribir el archivo con todos

        $row=json_encode($us,JSON_PRETTY_PRINT);
        if(($file = fopen("helados.json", "w"))!=FALSE)
        {
            fwrite($file, $row);   
            fclose($file);	
            return true;			
        }
        return false;


    }

    static function readJson($tipo)
    {
        $arrayJson=array();
        $var=-1;
         if(($file = fopen("$tipo.json", "r"))!=FALSE)
             #si uso vars usar "" no ''
         {
             if($file!=null&&filesize("$tipo.json")>0)
             {

                $readjson = file_get_contents("$tipo.json") ;

                
                $arrayJson = json_decode($readjson, true);
                fclose($file);
                $var=1;		 		
            }


         }
         else
         {
             $var=2;

         }

         
         if($var==1)
         {
             return $arrayJson;
         }
         else
         {
             return $var;
         }

    }
}




?>