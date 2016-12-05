<?
/********************************************************************
Nombre: gracias.php											     
Funcionalidad: Mensaje de gracias al usuario despues de enviar un formulario 
Fecha Creacion: 08/12/2015										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?
$tipo = $_GET["tp"];

if ($tipo == "1"){
 $tipo = "Por enviar tu aporte a todos contentos<br>Lo revisaremos y publicaremos proximamente";
} 
else
{
   $tipo = "Por comunicarte con nosotros<br>Te responderemos a la brevedad";
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

</head>
<body>
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
	
	 <div id="gracias">
	       <p>
           
           <H3> Gracias <?=$tipo?> </H3>
           
         </p>  
           
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
