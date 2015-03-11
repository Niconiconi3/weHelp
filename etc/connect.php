<?php
    include_once("constants.php");
    
    $timezone="Asia/Shanghai";

    $link = mysql_connect(DBSERVER,DBUSERNAME,DBPASSWORD);
	if(!$link){
		die('Could not connect: ' . mysql_error());
	}
    
	if(mysql_select_db(database)===FALSE)
			die("could not conect to database");
    mysql_query("SET names UTF8");

    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set($timezone); //北京时间
?>
