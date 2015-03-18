<?php
	session_start();
	require('constants.php');
	$openID = $_POST['openID'];
		
		//查找数据库中是否含有该ID
		$sql = "select * from user where openID = '$openID'";
		
		//验证数据库服务器连接
		if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
			die("could not conect to database");
		
		//验证服务器连接
		if(mysql_select_db(database)===FALSE)
			die("could not conect to database");

		$result = mysql_query($sql);
		
		//验证数据库操作是否成功
		if($result===FALSE)
			die("could not query database");
		
		//若该用户已注册，返回true，否则返回假
		if(mysql_num_rows($result)==1){
			$row = mysql_fetch_array($result);
			$_SESSION['stuNum'] = $row['stuNum'];
		}else{
			header("Location:此处为注册页面url"); 
		}
		
?>