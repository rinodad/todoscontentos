<!doctype html>
<html lang="es">
<head>
	<meta charset="ISO-8859-1" />
	
		<!-- METAS FACEBOOK -->
<meta property="og:url" content="http://www.todoscontentos.com/v.php?<?=$_REQUEST['id']?>"/>
<meta content='http://www.todoscontentos.com/images/logo_home.jpg' property='og:image'/>

	
	<link rel="stylesheet" href="styles2.css" type="text/css" media="screen" />
</head>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<section id="content2">
<? 

mysql_connect("localhost", "todoscontentos", "Ricardo56r4qt");
mysql_select_db("todoscontentos");	

	$sQuery = "SELECT points ";			 
	$sQuery .= "from t2cont_posts";
	$sQuery .= " WHERE post_id=".$_REQUEST['id'];
	$queryResult = mysql_query($sQuery);
	if ($queryResult && mysql_num_rows($queryResult)) 
	{
		while ($line = mysql_fetch_array($queryResult)) {
		$points = $line["points"];
	}
	}	
//echo "Puntos: ".$points." ";
mysql_close();
?>
<table width="600" border="0">
	<tr>
		<td>Votos: <?=$points ?> <img src="images/px_white.jpg" width="5" border="0">
			<a class="myButton" href="votar.php?id=<?=$_REQUEST['id']?>&pag=2">Votar</a></td>
		<td><div class="fb-share-button" data-href="http://www.todoscontentos.com/v.php?<?=$_REQUEST['id']?>" data-layout="button_count"></div></td>
	  <td width="200">&nbsp;</td>
		<!--<td><fb:comments-count "http://www.todoscontentos.com?id=<?=$_REQUEST['id']?>"></fb:comments-count> Comentarios</td>-->
		</tr>
	</table>

</section>
</html>


