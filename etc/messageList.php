<?php 
	/*
	 *显示发来私信的用户和该用户发来的最后一条私信时间倒序列表
	 *
	 */
	 session_start();
	 require('constants.php');
	 $user = $_SESSION['stuNum'];		
	 
	 //创建数据库语句
	 $sql = "select * from message where toUser='$user' and time in (select max(time) from message group by fromUser) order by time desc";
	 
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
		echo $row['user'] . " " . $row['content'];
		echo "<br />";
	}


?>