<?php
	/*
	 *发私信
	 *
	 */
	 /*
	 私信 表名：message
	 ID:mid
	 内容：content
	 发送时间：time
	 发送者学号：fromUser
	 接受者学号：toUser
	 */
	 
	 session_start();
	 //fake session 
	 $_SESSION['stuNum'] = 131250111;
	require('constants.php');
	
	$fromUser = $_SESSION['stuNum'];
	//从表单获取数据
	$toUser = $_POST['toUser'];			//接受私信人学号
	$content = $_POST['content'];		//内容
	
	$time = date("Y-m-d h:i:s");		//发布时间
		
	//创建插入数据语句
	$sql = "insert into message (content,fromUser,toUser,time)values('$content','$fromUser','$toUser','$time')";

	//验证数据库服务器连接
	if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
		die("could not connect to database");
	
	//验证服务器连接
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
	mysql_query("set names 'utf8'");	
	
	//插入注册信息
	$sql_insert = mysql_query($sql);
	
	
?>