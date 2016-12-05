<?
/********************************************************************
Nombre: login.php											     
Funcionalidad: Permite al usuario registrado ingresar al sistema
Fecha Creacion: 02/01/2013										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?
session_start();
if(isset($_SESSION['login_t2cont'])){
    $login_cookie = $_SESSION['login_t2cont'];
   //el usuario ya esta logeado
   // print $_SESSION['login_t2cont'];
   header('location: contribuir.php');
 }

require 'inc/usuarios.class.php';
require 'encrypt.php';

//instancio las clases
$oUsuarios = new Usuarios();

//si se pulso el botón ingresar
if ($_REQUEST['ingresar'] OR $_REQUEST['ingresar'] != "")
{

//valido la data de la forma
$sError = "";
$Contador_login = 0;
$Contador_pass = 0;


if (strlen(trim($_REQUEST['password'])) == 0) $sError = "Debes Ingresar el Password";
if (strlen(trim($_REQUEST['login'])) == 0) $sError = "Debes Ingresar el Login";

if ($sError == ""){
 //verifico si el usuario y el password existen
  $Contador_login = $oUsuarios->valLogin($_REQUEST['login']);
 
  if ($Contador_login > 0) {
  	
  	$dbarrPass =  $oUsuarios->valPass($_REQUEST['login']);
    $password = $dbarrPass[0]['password'];
    $active = $dbarrPass[0]['active'];
    $attempts = $dbarrPass[0]['attempts'];
    
    if ($attempts > 4) {
     $sError = "Superaste el numero de intentos para ingresar<br>Tu cuenta fué bloqueada, revisa tu email para desbloquearla";
     //actualizar estado de la cuenta a inactiva
     $oUsuarios->updEstado($_REQUEST['login'], 0);
     //OJO FALTA enviar email para poder recuperarla
    }
    
    if ($sError == "") 
    {
  	if ($password != encrypt('bc',strtolower($_REQUEST['password']))&& $active == 1) {
 			$sError = "El Password es incorrecto, Intentalo de nuevo";
 			//actualizar los intentos de ingreso
 			$oUsuarios->updIntentos($_REQUEST['login']);
 			if ($attempts >= 2) {
       $sError = "El Password es incorrecto<br>Recuerda que solo tienes 5 intentos para ingresar<br>Si olvidaste tu clave pulsa <a href='olvido_clave.php'>Aqui</a>";    
       }
 		}
 		else { $Contador_pass = 1;	}
 		if ($active == 0 or $active == "") {
 			$sError = "Tu cuenta no esta activada<br>Revisa tu email para activarla";
 		}
 	  }
  }
  else
  {
  	$sError = "El login es incorrecto, Intentalo de nuevo";
  }
 
  if ($Contador_login > 0 && $Contador_pass > 0 && $active > 0 && $sError == "") {
  	 session_start();
  	 $_SESSION['login_t2cont'] = strtolower($_REQUEST['login']);
  	 $_SESSION['hora_t2cont']=time();  
  	 $oUsuarios->updEstado($_REQUEST['login'], 0, 1);
  	 //header('location:index_nuevo.php');
  }
}
}
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="ISO-8859-1"/>
	<title>Todos Contentos</title>
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
		<img src="images/logo_home.jpg" width="299" height="167">
		<img src="images/random_01.jpg" width="629" height="178">
	</header><!-- end of header -->
	
    <nav><!-- top nav -->
		<div class="menu">
			<? include("menu_princ.php")?>
		</div>
	</nav><!-- end of top nav -->
    
	<section id="main"><!-- #main content and sidebar area -->
		<section id="content"><!-- #content -->
	 <div id="mensaje">  
	 	     <h1><?=$sError ?></h1>
	 </div>	     
	 	     
	 <div id="registro">
	 <form action="login.php" method="post">
	        <p>
	         <label for="login"> Login: </label>
           <input type="text" name="login" value="<?=$_REQUEST['login'] ?>" required="required">
         </p>
         <p>
	         <label for="password"> Password: </label>
           <input type="password" name="password"  size="40" required="required">
         </p>
           
          <p>
          <input type="submit" name="ingresar" value="ENTRAR">
          </p>
          
          <p>
          <a href='olvido_clave.php'>OLVIDE MI LOGIN O PASSWORD</a>
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

			<section id="footer-outer-block">
					<aside class="footer-segment">
							<h4>Creditos</h4>
								<ul>
									<li><a href="#">one linkylink</a></li>
									<li><a href="#">two linkylinks</a></li>
									<li><a href="#">three linkylinks</a></li>
								</ul>
					</aside><!-- end of #first footer segment -->

			</section><!-- end of footer-outer-block -->

		</section><!-- end of footer-area -->
	</footer>
	
</div><!-- #wrapper -->
<!-- Free template created by http://freehtml5templates.com -->
</body>
</html>
