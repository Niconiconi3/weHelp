<?php

/*
user 表名：user
用户名：user
openID：openID
学号：stuNum
邮箱：mailbox
*/
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

	
	
?>