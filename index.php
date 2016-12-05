<?
/********************************************************************
Nombre: index.php											     
Funcionalidad: Busca ultimos post y los muestra en la pagina principal 
Fecha Creacion: 07/05/2012										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?
//ini_set('display_errors', '1');
//error_reporting(E_ALL);

$pagina = @$_GET["pagina"];
$pag_actual = "index.php";

if (!isset($pagina))
  $pagina = 1;
  
//$current = "index.php";

require 'inc/posts.class.php';

//instancio las clases
$oPosts = new Posts();

//obtengo los ultimos post publicados
$dbarrPosts = $oPosts->getPost(0,0,$pagina);
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="ISO-8859-1" />
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
</head>
<body>
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
	  <?
    for ($index = 0; $index < sizeof($dbarrPosts); $index++) { 
  	$paginas = $dbarrPosts[$index]['paginas'];
  	$date = new DateTime($dbarrPosts[$index]['pub_date']);
  	$fecha_pub = $date->format('d/m/Y');
  	
    ?>
 <article>
							<p><a href="v.php?<?=$dbarrPosts[$index]['post_id']?>"><b><?=$dbarrPosts[$index]['title']?></b></a> <br>
								 Enviado por: <?=$dbarrPosts[$index]['user_id']?> - <?=$fecha_pub ?>
								</p>
							<? if ($dbarrPosts[$index]['image'] != ''){?>
               <a href="v.php?<?=$dbarrPosts[$index]['post_id']?>"><img src="ver_imagen.php?id=<?=$dbarrPosts[$index]['post_id']?>" border="0"></a>
             <? } else { ?>
 	           <iframe width="600" height="355" src="https://www.youtube.com/embed/<?=$dbarrPosts[$index]['video']?>" frameborder="0" allowfullscreen></iframe><?} ?> 
 	          <p><?=$dbarrPosts[$index]['descrip']?></p>
 	          <iframe src="ver_votos.php?id=<?=$dbarrPosts[$index]['post_id']?>" width="700" height="40" frameborder="0"></iframe>
 </article>
 <hr>
		<?}?>				
			<? //$paginas = 40;
			   $pagmax = $pagina + 9;
			   $pagmin = $pagina - 9;
			   if ($pagmax > $paginas)
			     $pagmax = $paginas;
			     
			  //echo $pagmin;
			     
 if ($paginas > 1){
 	
 	if ($pagina > 1){
 		$ant = $pagina - 1;
    echo "<p><b><a href='index.php?pagina=" . $ant . "'>Anterior</a> ";
  }
 	else
 	  echo "<p><b> Paginas: "; 
 	
    for ($i=$pagina;$i<=$pagmax;$i++){
       if ($pagina == $i)
          echo $pagina . " ";
       else
          echo "<a href='index.php?pagina=" . $i . "'>" . $i . "</a> ";
    } 
    
    if ($i < $paginas) {
    	$sig = $pagina + 1;
   echo "<a href='index.php?pagina=" . $sig . "'> Siguiente  </a>";
   } 
    echo "</b></p>"; 
}
?>
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
