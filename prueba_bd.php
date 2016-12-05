<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

print "voy A VER";

mysql_connect("localhost", "todoscontentos", "Ricardo56r4qt");
mysql_select_db("todoscontentos");	
  	
  	$sQuery = "select * from t2cont_country";
  	//$sQuery = "delete t2cont_country where country_id = 58";
  	
  	//mysql_query($sQuery) or die(mysql_error());
  	
  	$queryResult = mysql_query($sQuery);
  	
  	if ($queryResult && mysql_num_rows($queryResult)) {
				while ($line = mysql_fetch_array($queryResult)) {
					echo $line["country_id"];
					echo $line["name"];
					//$index ++;
				}
}

mysql_close();

?>   	


