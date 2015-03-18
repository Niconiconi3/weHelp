<?php
	/*
	 *写入任务
	 *
	 */
	 /*
	 task 表名：task
	 ID:ID 
	 标题：title
	 内容：content
	 结束时间：validity
	 作者学号：author
	 任务类型：type
	 是否置顶：stickie
	 悬赏积分：point
	 是否匿名：anonymous
	 发布时间：time
	 状态：status
	 执行者：executor
	 执行者确认时间：confirmTime
	 
	 任务状态：
	 0：已发表且未被接受
	 1：已接受
	 2：执行者确认已完成
	 3：发布者确认
	 */
	 
	//从表单获取数据
	$title = $_POST['title'];			//标题
	$content = $_POST['content'];		//内容
	$validity = $_POST['validity'];		//结束时间
	//$author = $_POST['author'];		//作者
	$type = $_POST['type'];				//类型
	$sticky = $_POST['sticky'];			//是否置顶
	$point = $_POST['point'];			//悬赏积分
	$anonymous = $_POST['anonymous'];	//是否匿名
	
	
	$time = date("Y-m-d h:i:s");		//发布时间
	$state = 0;  						//任务状态，0表示状态为已发表且未被接受
		
	//验证数据库服务器连接
	if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
		die("could not connect to database");
	
	//验证服务器连接
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
	mysql_query("set names 'utf8'");	
	
	//插入注册信息
	$sql = "insert into task (ID,title,content,validity,author,type,stickie,points,anonymous,time,status )values('$ID','$title','$content','$validity','$author','$type','$sticky','$point','$anonymous','$time','$state')";
	$sql_insert = mysql_query($sql);
	
	
?>