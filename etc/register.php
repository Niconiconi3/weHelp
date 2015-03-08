<?php
	require('constants.php');

	//注册
	function register($user,$openID,$stuNum,$mail){
		
		//验证数据库服务器连接
		if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
			die("could not conect to database");
		
		//验证服务器连接
		if(mysql_select_db(database)===FALSE)
			die("could not conect to database");
		mysql_query("set names 'utf8'");	
		
		//插入注册信息
		$sql_insert = mysql_query("insert into user (user,openID,stuNum,mailBox)values('$user','$openID','$stuNum','$mail')");

	}

	//登陆验证
	function login($varopenID){
		
		
		//验证数据库服务器连接
		if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
			die("could not conect to database");
		
		//验证服务器连接
		if(mysql_select_db(database)===FALSE)
			die("could not conect to database");

		//查找数据库中是否含有该ID
		$sql = "select 1 from user where openID = '$varopenID'";
		$result = mysql_query($sql);
		
		//验证数据库操作是否成功
		if($result===FALSE)
			die("could not query database");
		
		//若该用户已注册，返回true，否则返回假
		if(mysql_num_rows($result)==1)
			return TRUE;
		else
			return FALSE;
	}
	$result = login("zxcvb");
	echo "$result";
?>