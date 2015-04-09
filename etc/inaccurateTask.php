<?php
	/*
	此页代码用于处理违规任务，包括移动任务至正确板块、删除违规任务。需action,description，task_id
	每次记录将记录操作日志供查看。
	log(task_id,operation,operator,description,time)
	operation可为move,delete。	description用于操作说明，由管理员填写，若操作为move，说明从哪个版块移至哪个版块，若为delete，说明删除原因。
	time记录操作时间
	*/
	session_start();
	include_once("constants.php");
	$action = $_POST['action'];
	if($action=='move')
		move_task();
	if($action=='delete')
		delete_task();
	
	function move_task(){
		$task_id = $_POST['task_id'];
		$new_type = $_POST['new_type'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		$sql = "UPDATE `task` SET `type` = '$new_type' WHERE `ID` = '$task_id'";
		$result = mysql_query($sql);
		if(!$result){
			echo '移动任务失败，请稍后再试';
		}
		else{
			$operator = $_SESSION['admin'];
			$description = $_POST['description'];
			$temp = time();  
			$time = date('Y-m-d H:i:s', $temp);
			$sql2 = "INSERT INTO `log` values('$task_id','move','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '已移至正确版块。';
			else
				echo 'something wrong';
		}
	}
		
	function delete_task(){
		$task_id = $_POST['task_id'];
		$operator = $_SESSION['admin'];
		
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$sql = "delete from `task` WHERE `ID` = '$task_id'";
		$result = mysql_query($sql);
		if(!$result){
			echo '删除任务失败，请稍后再试';
		}
		else{
			$sql2 = "INSERT INTO `log` values('$task_id','delete','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '已删除相关内容。';
			else
				echo 'something wrong';
		}
	}
?>