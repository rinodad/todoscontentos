<?
/***************************************************************
Nombre: posts.class.php										
Funcionalidad: Clase para manejo de los querys de los post T2:)
Fecha Creacion: 07/05/2012										
Por: Rnoda  rinodad@gmail.com								
***************************************************************/
ini_set('display_errors', '1');
error_reporting(E_ALL);

	class Posts {

		function Posts() {
		}

		function getPost($id = 0, $user_id = 0, $pagina = 1, $random = 0) {
   	mysql_connect("localhost", "todoscontentos", "Ricardo56r4qt");
   	mysql_select_db("todoscontentos");	
   	
   	
   		// ****************************
			// Calcular numero de paginas		
			// ****************************
   		$sQuery2 = "SELECT * ";			 
			$sQuery2 .= "from t2cont_posts";
			$sQuery2  .= " WHERE aproved = 0";
			//$sQuery2  .= " WHERE aproved = 1";
			if ($id > 0)	$sQuery2 .= " AND post_id=".$id;
			if ($user_id <> "")	$sQuery2 .= " AND user_id='".$user_id."'";
	    if ($random > 0)	$sQuery2 .= " AND random=".$random;
			$queryResult2 = mysql_query($sQuery2);
			$total_reg = mysql_num_rows($queryResult2);
			$paginas = ceil($total_reg  / 5);
			
			if ($pagina > 1)
			{
			  $inicio = ($pagina - 1) * 5;
		  }
		  else
		    $inicio = 0;
				
			$sQuery = "SELECT post_id, user_id, title, image, mime, video, descrip, post_date, pub_date, aproved, random, active ";			 
			$sQuery .= "from t2cont_posts";
			$sQuery .= " WHERE aproved = 0";
			//$sQuery .= " WHERE aproved = 1";
			if ($id > 0)	$sQuery .= " AND post_id=".$id;
			if ($user_id <> "")	$sQuery .= " AND user_id='".$user_id."'";
			if ($random > 0)	$sQuery .= " AND random=".$random;
			$sQuery .= " ORDER BY post_id desc";
			$sQuery .= " limit " . $inicio . ", 5"; 
			
			$index = 0;
			//print $sQuery;

			$queryResult = mysql_query($sQuery);
			if ($queryResult && mysql_num_rows($queryResult)) {
				while ($line = mysql_fetch_array($queryResult)) {
					$resultArr[$index]["post_id"] = $line["post_id"];
					$resultArr[$index]["user_id"] = $line["user_id"];
					$resultArr[$index]["title"] = $line["title"];
					$resultArr[$index]["image"] = $line["image"];
					$resultArr[$index]["mime"] = $line["mime"];
					$resultArr[$index]["video"] = $line["video"];
					$resultArr[$index]["descrip"] = $line["descrip"];
					$resultArr[$index]["post_date"] = $line["post_date"];
					$resultArr[$index]["pub_date"] = $line["pub_date"];
					$resultArr[$index]["aproved"] = $line["aproved"];
					$resultArr[$index]["random"] = $line["random"];
					$resultArr[$index]["active"] = $line["active"];
					$resultArr[$index]["paginas"] = $paginas;
					$index ++;
				}
				mysql_free_result($queryResult);	
			} 

			mysql_close();	
			return $resultArr;
  	}
  	
	
	function addPost($user_id, $title, $imagen, $mime, $video, $descrip, $post_date, $pub_date, $aproved, $random, $active)

		{
		echo "ESTOY AQUI";	
    mysql_connect("localhost", "todoscontentos", "Ricardo56r4qt") or die ("No se puede abrir la base de datos"); 
   	mysql_select_db("todoscontentos");	
   	
   	//$sQuery = "select * from t2cont_country";

			$sQuery = "INSERT INTO t2cont_posts (user_id, title, image, mime, video, descrip, post_date, pub_date, aproved, random, active) ";
			$sQuery .= "VALUES ('".$user_id."', '".$title."', '".$imagen."', '".$mime."', '".$video."', '".$descrip."', '".$post_date."', '1900-01-01',0,0,0)";

		  print $sQuery;

			mysql_query($sQuery) or die(mysql_error());
			$id = mysql_insert_id();

			//cerrar conexion
			mysql_close();

			return $id;
	   }	

	   
 		function updPost($id, $user_id, $title, $image, $mime, $video, $descrip, $pub_date)
	{
    mysql_connect("localhost", "todoscontentos", "Ricardo56r4qt")
   	or die ("No se puede abrir la base de datos"); 
   	mysql_select_db("todoscontentos");	

   
			$sQuery = "UPDATE t2cont_posts SET user_id='".$user_id."', title='".$title."', ";
			$sQuery .= "image='".$image."', mime='".$mime."', video='".$video."', descrip='".$descrip."' ";
			$sQuery .= "pub_date='".$pub_date."' ";
			$sQuery .= "WHERE id_post=".$id;
			//print $sQuery;

			mysql_query($sQuery) or die(mysql_error());

			//cerrar conexion
			mysql_close();
	   }	



		function updstPost($id, $aproved, $random, $active)
	{
    mysql_connect("todoscontentos.db.8587392.hostedresource.com", "todoscontentos", "Ricardo56r4qt")
   	or die ("No se puede abrir la base de datos"); 
   	mysql_select_db("todoscontentos");	

   
			$sQuery = "UPDATE t2cont_posts SET aproved=".$aproved.", random=".$random.", active=".$active." ";
			$sQuery .= "WHERE id_post=".$id;
			//print $sQuery;

			mysql_query($sQuery) or die(mysql_error());

			//cerrar conexion
			mysql_close();
	   }	


	 function delPost($id)
		{
	  mysql_connect("todoscontentos.db.8587392.hostedresource.com", "todoscontentos", "Ricardo56r4qt")
   	or die ("No se puede abrir la base de datos"); 
   	mysql_select_db("todoscontentos");	

	  $sQuery = "DELETE from t2cont_posts WHERE id_post=".$id;
		mysql_query($sQuery) or die(mysql_error());
		
		//cerrar conexion
		mysql_close();
	  }	

}	   