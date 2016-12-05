<?
/********************************************************************
Nombre: enviar_posts.php											     
Funcionalidad: Permite al usuario enviar aporte (foto o video) 
Fecha Creacion: 12/07/2012										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?
session_start();
if($_SESSION['login_t2cont'] ==""){
    $login_cookie = "";
}

require 'inc/usuarios.class.php';
require 'inc/posts.class.php';
require 'inc/categ.class.php';

//instancio las clases
$oUsuarios = new Usuarios();
$oPosts = new Posts();
$oCateg = new Categ();

//obtengo datos del usuario conectado
$dbarrPosts = $oUsuarios->getUsuarios(0, $login_cookie);

//obtengo la lista de categorias
$dbarrCateg = $oCateg->getCateg();

//si se pulso el botón ingresar
if ($_REQUEST['ingresar'] OR $_REQUEST['ingresar'] != "")
{

//valido la data de la forma
$sError = "";
if (strlen(trim($_REQUEST['titulo'])) == 0) $sError = "Debes ingresar el titulo";
if (strlen(trim($_REQUEST['descripcion'])) == 0) $sError = "Debes ingresar la descripción";
//OJO VALIDAR IMAGEN O URL DE VIDEO SEGUN SEA EL CASO

//si no hay error ingreso los resultados
if ($sError == ""){

 if($_FILES[imagen][size] > 0)
 { 
 	 //Cambiar imagen de tamanio
 	 $nomimg_1 = 'picture' . rand() . '.jpg';
 	 include('inc/SimpleImage.php');
   $image = new SimpleImage();
   $image->load($_FILES['imagen']['tmp_name']);
   //$image->resize(600,400);  //OJO CAMBIAR TAMAÑO NO FIJO SINO ADAPTADO SEGUN LA FOTO
   $image->resizeToWidth(600);
   $image->save($nomimg_1);
   
   //Agregar marca de agua
   $nomimg_2 = 'picture' . rand() . '.jpg';
   $stamp = imagecreatefrompng('site_logo.png');
   $im = imagecreatefromjpeg($nomimg_1);
   $marge_right = 1;
   $marge_bottom = 1;
   $sx = imagesx($stamp);
   $sy = imagesy($stamp);
   imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
   imagejpeg($im, $nomimg_2);
   
   //Guardar
   $fileType    = $_FILES[imagen][type]; 
   $fp          = fopen($nomimg_2, 'r'); 
   $imgContent  = fread($fp, filesize($nomimg_2)); 
   $imgContent1 = base64_encode($imgContent);
   //$imgContent1 = $imgContent;
   fclose($fp); 
   imagedestroy($im);
   unlink($nomimg_1);
   unlink($nomimg_2);   
}
 
 $fecha_hoy = date("Y-m-d h:m:s");
 $sResult = $oPosts->addPost(1, $_REQUEST['categoria'], $_REQUEST['titulo'], $imgContent1, $fileType, $_REQUEST['video'], $_REQUEST['descripcion'], $fecha_hoy, '0000-00-00', 0, 0, 0);
 $sError = "DATOS INGRESADOS";
 //AQUI DEBERIA IRSE PARA EVITAR DUPLICIDAD DE POSTEOS
 //PERO AVISARLE AL USUARIO CON UN ALERT QUE FUE RECIBIDO SU POST
 //header("location: index.php");
 }

}
?>

<html>
<head></head>
<body>

ENVIAR POST:<br><br>

<form action="enviar_post.php" method="post" enctype="multipart/form-data">
<table border="0">
<tr>
<td align="center">
  Categoria:
</td>
<td align="center">
<select name="categoria">
  <? for ($index = 0; $index < sizeof($dbarrCateg); $index++) { ?>
  <option value="<?=$dbarrCateg[$index]['categ_id']?>"<?if($_REQUEST['categoria'] == $dbarrCateg[$index]['categ_id'])print" selected";?>><?=$dbarrCateg[$index]['title']?></option>
  <?}?>
</select>  
</td>
</tr>
<tr>
<td align="center" colspan="2">
 <?=$sError ?>
</td>
</tr>
<tr>
<td align="center">
 Titulo:
</td>
<td>
 <input type="text" name="titulo" value="<?= $_REQUEST['titulo'] ?>">
</td>
</tr>

<tr>
<td align="center">
  Imagen:
</td>
<td>
   <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
    <input type="file" name="imagen"  size="40">
</td>

<tr>
<td align="center">
  Url del Video:
</td>
<td>
 <input type="text" name="video" value="<?= $_REQUEST['video'] ?>">
</td>
</tr>

<tr>
<td align="center">
  Descripción:
</td>
<td>
 <textarea name="descripcion" cols="50" rows="5"><?= $_REQUEST['descripcion'] ?></textarea>
</td>
</tr>

<tr>
<td align="center" colspan="2">
 <input type="submit" name="ingresar" value="ENVIAR">
</td>
</tr>

</table> 

</form>
<br> 	

</body>
</html>
