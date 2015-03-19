<?php 
	/*
	 *任务详情
	 *
	 */
	 session_start();
	 require('constants.php');
	 $taskID = $_POST['taskID'];		//从表单中获取任务类型
	 
	 $sql1 = "select * from task where ID = '$taskID'";
	 $sql2 = "select * from comment where task_id = '$taskID'";
	 
	//验证数据库服务器连接
	if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
		die("could not connect to database");
	
	//验证服务器连接
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
	 $task = mysql_query($sql1);
	 $comments = mysql_query($sql2);
		
	//验证数据库操作是否成功
	if($result===FALSE)
		die("could not query database");
	
	//显示任务详情
	$taskRow = mysql_fetch_array($task));
	echo $taskRow['title'] . " " . $taskRow['content'];
	echo "<br />";
	//显示评论
	while($commetsRow = mysql_fetch_array($comments)){
		echo $row['reply'];
		echo "<br />";
	}
	
	//这里回头和html揉在一起就好了~


?>