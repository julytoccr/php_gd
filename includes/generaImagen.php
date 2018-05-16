<?php

 /***** SECCION DE CONSULTA A LA BASE DE DATOS *****/

 //includo la coneccion a la base de datos
 include("../includes/conectarDb.php");

 //pongo una respuesta por defecto en caso que no se encuentre el producto
 $nombre="NO ENCONTRADO !!!";
 $precio="";

 //Armo la consulta
 $consulta_sql="select * from articulos where codigo=".$_GET['nro_producto'];

 //Ejecuto la query en el servidor
 $registros=$mysql->query($consulta_sql) or die($mysql->error);

 //Obtengo la respuesta del Mysql
 $reg=$registros->fetch_array(MYSQLI_ASSOC);

 //Se encontro el articulo?
 if ($reg){//Si encuentra algo, genero el json a enviar como respuesta al JS que hizo la consulta
        $nombre="Nombre : ".$reg['descripcion'];
        $precio="Precio : $".$reg['precio'];
 }

 /***** FIN DE SECCION DE BASE DE DATOS ************/ 


 /*****  ACA EMPIEZO A GENERAR LA IMAGEN A ENVIAR AL BROWSER  **********/

 //Creo la imagen, $im no tiene el valor , sino una referencia a la imagen
 $im = @imagecreatetruecolor(200, 100) or die('No se puede Iniciar el nuevo flujo a la imagen GD');

 //creo un color para el texto
 $color_texto = imagecolorallocate($im, 0, 0, 102);

 //creo un color para el fondo, en base al color que elegi
 switch($_GET['color']){
   case 0:
         $color_fondo = imagecolorallocate($im, 51, 102, 255);
         break; 
   case 1:
         $color_fondo = imagecolorallocate($im, 255, 255, 102);
         break;
   case 2:
         $color_fondo = imagecolorallocate($im, 0, 204, 0);
         break;
 }

 //lleno la imagen con el color de fondo
 imagefill($im, 0, 0, $color_fondo);

 //pongo el texto en la imagen con el color asignado
 imagestring($im, 6, 20, 25,  $nombre , $color_texto);
 imagestring($im, 6, 20, 45,  $precio , $color_texto);

 //Le aviso all browser que le voy a enviar una imagen con un nombre determinado si la quiere descargar
 header ('Content-Type: image/png');
 header('Content-Disposition: filename="imagenGenerada.png"');

 //envio la imagen al browser
 imagepng($im);

 //destruyo la imagen creada
 imagedestroy($im);
 

?>
