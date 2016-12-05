<?
/********************************************************************
Nombre: mostrar_post.php											     
Funcionalidad: Mostrar un post especifico guardado en la BD
Fecha Creacion: 07/05/2012										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?

 function GET(){
    foreach($_GET as $key=>$valor) {
        $key = $key;
        break;
    }
    return trim($key);
} 

 $id_post = GET();

require 'inc/posts.class.php';

//instancio las clases
$oPosts = new Posts();

//obtengo la data del post
$dbarrPosts = $oPosts->getPost($id_post,0,0,0);
$index = 0;

if($dbarrPosts[$index]['aproved'] == 0)
  header("location: 404.shtml");

?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="ISO-8859-1" />
<TITLE>TODOS CONTENTOS - HUMOR - VIDEOS - CHISTES</TITLE>
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

	<!-- METAS FACEBOOK -->
<meta property = "og:title" content="<?=$dbarrPosts[$index]['title']?>"/>
<meta property = "og:description" content=" "/>
<meta property = "og:image" content="http://www.todoscontentos.com/images/<?=$id_post?>.jpg"/>


	<link rel="stylesheet" href="styles.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="print.css" media="print" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
</head>
<body>
<div id="fb-root"></div><script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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

<? $date = new DateTime($dbarrPosts[$index]['pub_date']);
  	$fecha_pub = $date->format('d/m/Y');
  	
    ?>
 <article>
							<p><b><?=$dbarrPosts[$index]['title']?></b> <br>
								 Enviado por: <?=$dbarrPosts[$index]['user_id']?> - <?=$fecha_pub ?>
								</p>
							<? if ($dbarrPosts[$index]['image'] != ''){?>
               <img src="ver_imagen.php?id=<?=$dbarrPosts[$index]['post_id']?>" border="0">
             <? } else { ?>
 	           <iframe width="600" height="355" src="https://www.youtube.com/embed/<?=$dbarrPosts[$index]['video']?>" frameborder="0" allowfullscreen></iframe><?} ?> 
 	          <p><?=$dbarrPosts[$index]['descrip']?></p>
 	          <iframe src="ver_votos2.php?id=<?=$dbarrPosts[$index]['post_id']?>" width="700" height="40" frameborder="0"></iframe>
 </article>
	<br><br>

<div class="fb-comments" data-href="http://www.todoscontentos.com?id=<?=$id_post?>" data-width="650" data-num-posts="10"></div>
	</section><!-- end of #content -->

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
