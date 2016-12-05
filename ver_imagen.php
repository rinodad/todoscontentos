<? 
mysql_connect("localhost", "todoscontentos", "Ricardo56r4qt");
mysql_select_db("todoscontentos");	

	$sQuery = "SELECT image, mime ";			 
	$sQuery .= "from t2cont_posts";
	$sQuery .= " WHERE post_id=".$_REQUEST['id'];
	$queryResult = mysql_query($sQuery);
	if ($queryResult && mysql_num_rows($queryResult)) 
	{
		while ($line = mysql_fetch_array($queryResult)) {
		$imagen = $line["image"];
	}
	}	

header("Content-type: image/jpeg");	
echo base64_decode($imagen);  
//echo $imagen;  
?>