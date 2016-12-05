<? 
$current = 'id = "current"';
$current1 = ""; $current2 = ""; $current3 = ""; $current4 = ""; $current5 = "";

if ($pag_actual == "index.php") $current1 = $current;
if ($pag_actual == "aleatorios.php") $current2 = $current;
if ($pag_actual == "favoritos.php") $current3 = $current;
if ($pag_actual == "contribuir.php") $current4 = $current;
if ($pag_actual == "contacto.php") $current5 = $current;

echo '<ul>';
echo  '<li><a href="index.php" '.$current1.'>Inicio</a></li>';
echo	'<li><a href="aleatorios.php" '.$current2.'>Aleatorios</a></li>';
echo  '<li><a href="favoritos.php" '.$current3.'>Favoritos</a></li>';
echo  '<li><a href="contribuir.php" '.$current4.'>Envía tus chistes</a></li>';
echo  '<li><a href="contacto.php" '.$current5.'>Contáctanos</a></li>';
echo  '</ul>';
?>

