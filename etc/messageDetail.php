<?php 
	/*
	 *显示某用户发来的全部私信
	 *
	 */
	 session_start();
	 require('constants.php');
	 $user = $_SESSION['stuNum'];
	 
	 $fromUser = $_POST['fromUser'];
	 
	 //创建数据库语句
	 $sql = "select * from message where toUser='$user' and fromUser = '$fromUser' order by time desc";
	 
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
		echo  $row['content'];
		echo "<br />";
	}


?>