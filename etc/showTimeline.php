<?php 
	/*
	 *查看timeline
	 *用户-关注的人关联表following
	 *user:用户学号
	 *follow：关注的人学号
	 */
	 session_start();
	 require('constants.php');
	 $user = $_SESSION['stuNum'];		//从表单中获取任务类型
	 
	 //创建数据库语句
	 $sql = "select * from ((select * from following where user = '$user') as a inner join task on a.follow=task.author) order by time desc";
	 
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
	
	while($row = mysql_fetch_array($result)){
		echo $row['title'] . " " . $row['content'];
		echo "<br />";
	}


?>