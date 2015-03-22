<?php 
	/*
	 *查看timeline
	 *
	 */
	 session_start();
	 require('constants.php');
	 $user = $_SESSION['stuNum'];		
	 
	 //创建数据库语句
	 $sql = "select * from ((select * from follower where visitor_id = '$user' and status=1) as a inner join task on a.owner_id = task.author) order by time desc";
	 
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