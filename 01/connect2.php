<?	
    //if (date("Ymd")>="20130101"){
	  //  echo "maintain!";
	    //exit;
	//}	
   $user = "bow2015";
	$password = "xdfsx($%D";
	$host = "localhost";

	$connection = mysql_connect($host, $user, $password);
	mysql_query("SET NAMES 'utf8'");
	mysql_select_db("admin_bowchan", $connection);
?>

