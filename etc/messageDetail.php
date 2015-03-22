<?php 
	/*
	 *显示某用户发来的全部私信
	 *
	 */
	 session_start();
	 require('constants.php');
	 $user = $_SESSION['stuNum'];
	 
	 $mid = $_POST['mid'];
	 
	 //创建数据库语句
	 $sql1 = "select * from message where mid='$mid' order by time desc";
	 $sql2 = "update message set status = 1 where mid = '$mid'";
	 
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