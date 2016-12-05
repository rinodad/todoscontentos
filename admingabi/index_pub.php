<?
/********************************************************************
Nombre: index.php											     
Funcionalidad: administrador del site 
Fecha Creacion: 14/12/2015										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?

//ini_set('display_errors', '1');
//error_reporting(E_ALL);

$pagina = @$_GET["pagina"];

require '../inc/posts.class.php';

//instancio las clases
$oPosts = new Posts();

//si se pulso el botón actualizar
@$enviada = $_REQUEST['ingresar'];

if (@$enviada != "")

{
//tomar el id del post de la forma
$idpost = $_REQUEST['postid'];

//echo $idpost;

//si se mando a borrar el post, borrarlo
if ($_REQUEST['estado'] == 2) {
	 $sResult = $oPosts->delPost($idpost);
	}
else{
	//actualizar el post
	
  if(@$_FILES[imagen][size] > 0)
 { 
   //Cambiar imagen de tamanio
 	 $nomimg_1 = 'picture' . rand() . '.jpg';
 	 include('../inc/SimpleImage.php');
   $image = new abeautifulsite\SimpleImage();
   $image->load($_FILES['imagen']['tmp_name']);
   //$image->adaptive_resize(600);
   $image->fit_to_width(600);
   
   $image->save($nomimg_1);
   
   //Agregar marca de agua
   $nomimg_2 = 'picture' . rand() . '.jpg';
   $stamp = imagecreatefrompng('../marca_agua.png');
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
   
   //crear imagen para facebook
   $nomimg_3 = "../images/".$idpost.".jpg";
   $image->crop(0,0,534,400);
   $image->save($nomimg_3);  
   
}

   //$fecha_hoy = date("Y-m-d h:m:s");
   $sResult = $oPosts->updPost($idpost, trim($_REQUEST['publicado']), trim($_REQUEST['titulo']), @$imgContent1, @$fileType, trim($_REQUEST['video']), trim($_REQUEST['descripcion']), trim($_REQUEST['fecha_pub']), $_REQUEST['estado']);
   
   $pagina = $_REQUEST['pagina'];
}
}

//obtengo los ultimos post publicados
$dbarrPosts = $oPosts->getPost(0,0,$pagina,0,0,0,0);
   

?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="ISO-8859-1" />
<TITLE>ADMIN</TITLE>
	
	<link rel="stylesheet" href="../styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="../text/css" href="print.css" media="print" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
</head>
<body>
<div id="wrapper"><!-- #wrapper -->

	<header><!-- header -->
		<img src="../images/logo_home.jpg" width="299" height="167">
		<img src="../images/random_01.jpg" width="629" height="178">
	</header><!-- end of header -->
	
    <nav><!-- top nav -->
    <div class="menu">
    </div>
	</nav><!-- end of top nav -->
    
	<section id="main"><!-- #main content and sidebar area -->
			<section id="content"><!-- #content -->
	  <?
    for ($index = 0; $index < sizeof($dbarrPosts); $index++) { 
  	$paginas = $dbarrPosts[$index]['paginas'];
    ?>
 <article>
 	<form action="index_pub.php" method="post" enctype="multipart/form-data"> 	
 		<input type="hidden" name="postid" value="<?=$dbarrPosts[$index]['post_id']?>">
 		<input type="hidden" name="pagina" value="<?=$pagina ?>">
 		<input type="hidden" name="fecha_pub" value="<?=$dbarrPosts[$index]['pub_date']?>">
 		<p>
 			    <label for="publicado"> Publicado por: </label>
 			        <input type="text" name="publicado" value="<?=$dbarrPosts[$index]['user_id']?>" size="60">
         	</p>
         	<p>
							<label for="titulo"> Titulo: </label>
           <input type="text" name="titulo" value="<?=$dbarrPosts[$index]['title']?>" size="60">
        </p>
							<? if ($dbarrPosts[$index]['image'] != ''){?>
               <img src="../ver_imagen.php?id=<?=$dbarrPosts[$index]['post_id']?>" border="0">
                <p>
          <label for="imagen"> Cambiar imagen: </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="imagen"  size="40">
          </p>
             <? } else { ?>
 	           <iframe width="600" height="355" src="https://www.youtube.com/embed/<?=$dbarrPosts[$index]['video']?>" frameborder="0" allowfullscreen></iframe>
 	               <p>
 	          <label for="video"> Video: </label>
           <input type="text" name="video" value="<?=$dbarrPosts[$index]['video']?>" size="60">
           </p>
             <?} ?> 
 	       <p>
 	           <label for="descripcion" vertical-align: top> Descripción: </label>
         <input type="text" name="descripcion" value="<?=$dbarrPosts[$index]['descrip']?>" size="60">
 	          </p>
 	       <p>
	         <label for="estado"> Estado del post: </label>
           <select name="estado" id="estado">
           <option value="0" <? if ($dbarrPosts[$index]['aproved'] == 0) echo "selected"?>>No publicado</option>
           <option value="1" <? if ($dbarrPosts[$index]['aproved'] == 1) echo "selected"?>>Publicado</option>
           <option value="2">Borrar post</option>
          </select>  
         </p>
 	      
 	       <p>
          <input type="submit" name="ingresar" value="ACTUALIZAR"> 
          </p>
 	      
  </form>
 </article>
<hr size="20" />
 
 <br>
		<?}?>				
			<?
if ($paginas > 1){
    for ($i=1;$i<=$paginas;$i++){
       if ($pagina == $i)
          echo $pagina . " ";
       else
          echo "<a href='index_pub.php?pagina=" . $i . "'>" . $i . "</a> ";
    }
}
?>
			</section><!-- end of #content -->

		<aside id="sidebar"><!-- sidebar -->
			
		<p><b>MOSTRAR POSTS:</b></p>

    <p><a href="index.php">NO PUBLICADOS</a></p>
    
    <p><a href="index_pub.php">PUBLICADOS</a></p>

		</aside><!-- end of sidebar -->

	</section><!-- end of #main content and sidebar-->
		<footer>
		<section id="footer-area">

			<section id="footer-outer-block">
					<aside class="footer-segment">
							<h1>Todos Contentos - Buenos Aires - Argentina</h1>
								
					</aside><!-- end of #first footer segment -->

			</section><!-- end of footer-outer-block -->

		</section><!-- end of footer-area -->
	</footer>
	
</div><!-- #wrapper -->
</body>
</html>
