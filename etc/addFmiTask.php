<?php
/*
*添加相似任务
*
*表名：familiarTask
*被关联任务：FTid
*关联任务：STid
*/
	session_start();
	 //fake session 
	 $_SESSION['stuNum'] = 131250111;
	require('constants.php');
	
	if(isset($_SESSION['stuNum']))
	$author = $_SESSION['stuNum'];
	else{
		require_once(login.php);
		exit;
	}
	
	//从表单获取数据
	$FTid = $_POST['FTid'];
	
	$title = $_POST['title'];			//标题
	$content = $_POST['content'];		//内容
	$validity = $_POST['date'].$_POST['hour'].$_POST['minute'];		//结束时间
	$type = $_POST['type'];				//类型
	$sticky = false;
	
	if(isset($_POST['sticky']))
	$sticky = $_POST['sticky'];			//是否置顶
	
	$point = $_POST['point'];			//悬赏积分
	
	$anonymous = false;
	
	if(isset($_POST['anonymous']))
	$anonymous = $_POST['anonymous'];	//是否匿名
	
	
	$time = date("Y-m-d h:i:s");		//发布时间
	$state = 0;  						//任务状态，0表示状态为已发表且未被接受
		
	$sql1 = "insert into task (title,content,validity,author,type,stickie,point,anonymous,time,status )values('$title','$content','$validity','$author','$type','$sticky','$point','$anonymous','$time','$state')";
	$sql2 = "select ID from task where author = '$author' and time = '$time'";
	$sql3 = "insert into familiarTask (FTid,STid) values ('$FTid','$row['ID']')";
	
	//验证数据库服务器连接
	if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
		die("could not connect to database");
	
	//验证服务器连接
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
	mysql_query("set names 'utf8'");	
	
	//插入注册信息
	$sql_insert = mysql_query($sql1);
	//查找当前任务ID
	$sql_find = mysql_query($sql2);
	$row = mysql_fetch_array($sql_find);
	
	$sql_fami = mysql_query($sql3);

?>