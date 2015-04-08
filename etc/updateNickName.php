<?php
/*
*修改昵称
*/
session_start();
	 //fake session 
	 $_SESSION['stuNum'] = 131250111;
	 
	$nickName = $_POST['nickName'];
	//创建数据库语句
	 $sql = "update user set user = '$nickName' where stuName = '$_SESSION['stuNum']'";
	 
	 //验证数据库服务器连接
	if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
		die("could not connect to database");
	
	//验证服务器连接
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
	 $result = mysql_query($sql);
		
	//验证数据库操作是否成功
	if($result===FALSE)
		die("could not query database");
	else
		echo "修改成功";
?>