<?
/********************************************************************
Nombre: votar.php											     
Funcionalidad: Sumar un voto a un post
Fecha Creacion: 20/11/2015										     
Por: Rnoda  rinodad@gmail.com								     
********************************************************************/
?>
<?
error_reporting(E_ALL);
$id_post = $_GET["id"];
$pag = $_GET["pag"];

require 'inc/posts.class.php';

//instancio las clases
$oPosts = new Posts();

$dbarrPosts = $oPosts->updPoints($id_post);

if ($pag == "1")
header("location: ver_votos.php?id=".$id_post);
else
header("location: ver_votos2.php?id=".$id_post);
?>
