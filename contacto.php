<?
/********************************************************************
Nombre: contacto.php											     
Funcionalidad: Permite al usuario enviar mensaje de contacto 
Fecha Creacion: 08/12/2015										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?

//ini_set('display_errors', '1');
//error_reporting(E_ALL);

$sError = "";
$pag_actual = "contacto.php";

//si se pulso el botón ingresar
@$enviada = $_REQUEST['ingresar'];

if (@$enviada != "")

{
//valido la data de la forma

if (strlen(trim($_REQUEST['descripcion'])) == 0) $sError = "Debes ingresar tu consulta";
if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$", $_REQUEST['email'])) $sError = "Debes ingresar un email valido";
if (strlen(trim($_REQUEST['email'])) == 0) $sError = "Debes ingresar tu email";
if (strlen(trim($_REQUEST['nombre'])) == 0) $sError = "Debes ingresar tu nombre o alias";

//si no hay error ingreso los resultados
if ($sError == ""){

 $to = "rinodad@gmail.com";
 $subject = "Consulta desde todoscontentos";
 $txt = trim($_REQUEST['descripcion']);
 //$headers = "From: " . trim($_REQUEST['email']); 
 
 //envio los datos por email
$header = "MIME-Version: 1.0 \r \n"; 
$header .= "Content-type: text/html; charset=iso-8859-1 \r \n"; 
$header .= "From: ".$_REQUEST['nombre']."  <".trim($_REQUEST['email']).">\r \n";
$header .= "Reply-To: ".trim($_REQUEST['email'])."\r \n";
 

 mail($to,$subject,$txt,$header);
 
 header("location: gracias.php?tp=2");
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
	
		<H3>ENVIANOS TUS COMENTARIOS</H3>
	
	 <div id="mensaje">  
	 	     <h4><?=$sError ?></h4>
	 </div>	     
	 	     
	 <div id="contacto">
	 <form action="contacto.php" method="post">
          <p>
           <label for="nombre"> Nombre o Alias: </label>
           <input type="text" name="nombre" placeholder="tu nombre o nickname" value="<?=@$_REQUEST['nombre'] ?>" size="30">
         </p>
         
         <p>
           <label for="email"> Email: </label>
           <input type="text" name="email" placeholder="tu email" value="<?=@$_REQUEST['email'] ?>" size="30">
         </p>
         <p class="formfield">
           <label for="consulta"> Consulta: </label>
           <textarea name="descripcion" cols="50" rows="5"><?= @$_REQUEST['descripcion'] ?></textarea>
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
