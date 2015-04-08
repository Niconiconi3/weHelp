<?php 
	/*
	 *查看相似任务
	 *
	 */
	 require('constants.php');
	 $Tid = $_POST['Tid'];		//从表单中获取任务类型
	 
	 //创建数据库语句
	 $sql = "select * from task where(ID in(select FTid from familiarTask where STid = '$Tid') or ID in(select STid from familiarTask where FTid = '$Tid'))";
	 
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