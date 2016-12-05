<?
/********************************************************************
Nombre: contribuir.php											     
Funcionalidad: Permite al usuario enviar un post (foto o video) 
Fecha Creacion: 12/07/2012										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?

error_reporting(0);

require 'inc/posts.class.php';

$pag_actual = "contribuir.php";

//instancio las clases
$oPosts = new Posts();

$sError = "";

//si se pulso el botón ingresar
@$enviada = $_REQUEST['ingresar'];

if (@$enviada != "")

{
//valido la data de la forma

if (strlen(trim($_REQUEST['descripcion'])) == 0) $sError = "Debes ingresar la descripción";
if (trim($_REQUEST['tipo']) == 'imagen' && $_FILES[imagen][size] == 0) $sError = "Debes seleccionar la imagen a enviar";
if (trim($_REQUEST['tipo']) == 'video' && strlen(trim($_REQUEST['video2'])) == 0) $sError = "Debes ingresar la direccion del video";
if (strlen(trim($_REQUEST['titulo'])) == 0) $sError = "Debes ingresar el titulo";
if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$", $_REQUEST['email'])) $sError = "Debes ingresar un email valido";
if (strlen(trim($_REQUEST['email'])) == 0) $sError = "Debes ingresar tu email";
if (strlen(trim($_REQUEST['nombre'])) == 0) $sError = "Debes ingresar tu nombre o alias";

//si no hay error ingreso los resultados
if ($sError == ""){

 if(@$_FILES[imagen][size] > 0)
 { 

 	 //Cambiar imagen de tamanio
 	 $nomimg_1 = 'picture' . rand() . '.jpg';
 	 include('inc/SimpleImage.php');
   $image = new abeautifulsite\SimpleImage();
   $image->load($_FILES['imagen']['tmp_name']);
   $image->fit_to_width(600);
   $image->save($nomimg_1);
   
   //Agregar marca de agua
   $nomimg_2 = 'picture' . rand() . '.jpg';
   $stamp = imagecreatefrompng('marca_aguas.png');
   $im = imagecreatefromjpeg($nomimg_1);
   $marge_right = 1;
   $marge_bottom = 50;
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
 $sResult = $oPosts->addPost(trim($_REQUEST['nombre']),  trim($_REQUEST['email']), trim($_REQUEST['titulo']), @$imgContent1, @$fileType, trim($_REQUEST['video2']), trim($_REQUEST['descripcion']), $fecha_hoy, '0000-00-00', 0, 0, 0);
 $sError = "DATOS INGRESADOS";
 header("location: gracias.php?tp=1");
 }
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="ISO-8859-1"/>
	<TITLE>TODOS CONTENTOS - CHISTES - HUMOR - VIDEOS - BROMAS - MEMES - FOTOS - JODA - RISAS</TITLE>
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="Content-Language" content="es-ve">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<meta name="Description" content="Todoscontentos.com - Tu sitio de humor">
<meta name="keywords" content="chistes,humor,videos,bromas,memes,fotos,joda,risa">
<meta name="classification" content="humor">
<meta name="page-topic" content="humor, chistes">
<meta name="robots" content="All">
<meta name="revisit-after" content="7 days">
<meta name="author" content="Todos Contentos">
<meta name="identifier-url" content="www.todoscontentos.com">
<meta name="distribution" content="Global">
<meta name="coverage" content="Worldwide">
<meta name="rating" content="General">
<meta name="site-language" content="Spanish">
<meta name="geo.placename" content="Buenos Aires, Argentina">
<meta name="geo.country" content="AR">
<meta name="resource-type" content="Document">
	<link rel="stylesheet" href="styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="print.css" media="print" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<script language="javascript"> 
function cambiatipo() {
	var tipoimagen = document.getElementById("tipoimagen");
	var tipovideo = document.getElementById("tipovideo");
	var opcion = document.getElementById("tipo").value;
	
	if(opcion == "imagen"){
    		tipoimagen.style.display = "block";
    		tipovideo.style.display = "none";
    		document.getElementById("video").value = "";
  	}
	else {
		tipoimagen.style.display = "none";
    tipovideo.style.display = "block";
	}
} 
</script>

</head>
<body onload="javascript:cambiatipo();">
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-80116425-1', 'auto');
  ga('send', 'pageview');

</script>
<div id="wrapper"><!-- #wrapper -->

	<header><!-- header -->
	<? include("tope.php")?>
	</header><!-- end of header -->
	
    <nav><!-- top nav -->
		<div class="menu">
			<? include("menu_princ.php")?>
		</div>
	</nav><!-- end of top nav -->
    
	<section id="main"><!-- #main content and sidebar area -->
		<section id="content"><!-- #content -->
	
	<H3>ENVIANOS TUS CHISTES O VIDEOS Y LOS PUBLICAREMOS</H3>
		
	
	 <div id="mensaje">  
	 	     <h4><?=$sError ?></h4>
	 </div>	     
	 	     
	 <div id="contribuir">
	 <form action="contribuir.php" method="post" enctype="multipart/form-data">
         <p>
	         <label for="tipo"> Tipo de Aporte: </label>
           <select name="tipo" id="tipo" onChange="javascript:cambiatipo();">
           <option value="imagen" <? if ($_REQUEST['tipo'] == 'imagen') echo "selected"?>>Imagen</option>
           <option value="video" <? if ($_REQUEST['tipo'] == 'video') echo "selected"?>>Video</option>
          </select>  
         </p>
         
          <p>
           <label for="nombre"> Nombre o Alias: </label>
           <input type="text" name="nombre" placeholder="tu nombre o nickname" value="<?=@$_REQUEST['nombre'] ?>" size="30">
         </p>
         
         <p>
           <label for="email"> Email: </label>
           <input type="text" name="email" placeholder="tu email" value="<?=@$_REQUEST['email'] ?>" size="30">
         </p>
         
         
         <p>
           <label for="titulo"> Titulo: </label>
           <input type="text" name="titulo" placeholder="titulo del post" value="<?=@$_REQUEST['titulo'] ?>" size="60">
         </p>
          <div id="tipoimagen" style="display: block">
         <p>
         	  <label for="imagen"> Imagen: </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="imagen"  size="40">
          </p>
         </div>
         <div id="tipovideo" style="display: none">
           <p>
           <label for="video"> Url del Video(solo videos de youtube): </label>
           <input type="text" name="video2" id="video" value="<?= @$_REQUEST['video2'] ?>" placeholder="ej: youtube.com/watch?v=oPJaDmqLqzQ" size="60">
         </p>
          </div>
         <p>
           <label for="descripcion"> Descripción: </label>
           <!--<textarea name="descripcion" cols="50" rows="2"><?= @$_REQUEST['descripcion'] ?></textarea>-->
           <input type="text" name="descripcion" placeholder="texto complementario debajo del post" value="<?= @$_REQUEST['descripcion'] ?>" size="60">
 	       </p>
        <br>
        <p>
          <input class="myButton" type="submit" name="ingresar" value="ENVIAR">
          </p>
     </form>    
    </div>
			</section>

		<aside id="sidebar"><!-- sidebar -->
			
		<? include("barra_derecha.php")?>
		
		</aside><!-- end of sidebar -->

	</section><!-- end of #main content and sidebar-->
		<footer>
		<section id="footer-area">

			<? include("footer.php")?>

		</section><!-- end of footer-area -->
	</footer>
	
</div><!-- #wrapper -->
<!-- Free template created by http://freehtml5templates.com -->
</body>
</html>
