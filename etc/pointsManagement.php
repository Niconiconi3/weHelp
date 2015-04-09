<?php
	/*
	用于积分管理
	包括奖励积分、扣除积分
	需记录操作日志
	points_log(user_id,operator,operation,num,description,time)
	operation包括award,punish
	num是操作积分数目
	description说明奖励/扣除积分的理由，必填，由管理员在界面填写
	*/
	session_start();
	include_once("constants.php");
	$action = $_post['action'];
	if($action==award)
		award();
	if($action==punish)
		punish();
	
	function award(){
		$user = $_POST['user_id'];
		$operator = $_SESSION['stuNum'];
		$pts = $_POST['points'];
		
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		Ssql = "select points from `user` where stuNum = '$user'";
		$row = mysql_fetch_array($result);
		if($row){
			$pts_before = $row['points'];
		}
		else{
			echo "wrong occur in select;";
			exit("exit");
		}
		$pts_after = $pts_before+$pts;
		$sql = "UPDATE `user` SET `points` = '$pts_after' WHERE `ID` = '$task_id'";
		$result = mysql_query($sql);
		
		if(!$result){
			echo '积分奖励失败，请稍后再试';
		}
		else{
			$operator = $_SESSION['stuNum'];
			$description = $_POST['description'];
			$temp = time();  
			$time = date('Y-m-d H:i:s', $temp);
			$sql2 = "INSERT INTO `log` values('$task_id','award','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '积分奖励成功。';
			else
				echo 'something wrong';
		}
	}
	
	function punish(){
		$user = $_POST['user_id'];
		$operator = $_SESSION['stuNum'];
		$pts = $_POST['points'];
		
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		Ssql = "select points from `user` where stuNum = '$user'";
		$row = mysql_fetch_array($result);
		if($row){
			$pts_before = $row['points'];
		}
		else{
			echo "wrong occur in select;";
			exit("exit");
		}
		$pts_after = $pts_before-$pts;
		$sql = "UPDATE `user` SET `points` = '$pts_after' WHERE `ID` = '$task_id'";
		$result = mysql_query($sql);
		
		if(!$result){
			echo '积分扣除失败，请稍后再试';
		}
		else{
			$operator = $_SESSION['stuNum'];
			$description = $_POST['description'];
			$temp = time();  
			$time = date('Y-m-d H:i:s', $temp);
			$sql2 = "INSERT INTO `log` values('$task_id','award','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '积分扣除成功。';
			else
				echo 'something wrong';
		}
	}

?>