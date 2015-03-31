<?php
/*
此段代码用于编辑任务，包括修改内容，修改悬赏积分，修改有效期，关闭任务，置顶任务
需要使用$action(可选值为modify_task,close_task,stickie_task),$content,$points,$有效期，$task_no,$studentid
*/
	include_once("constants.php");
	
    $action = $_POST['action'];
	$task_id = $_POST['task_id'];
	if($action=='modify_content'){
		modify_content();
	}elseif($action=='modify_points'){
		modify_points();
	}elseif($action=='modify_date'){
		modify_date();
	}elseif($action=='close_task'){
		close_task();
	}elseif($action=='stickie_task'){
		stickie_task();
	}
	
    function modify_content(){
		
	    $content = $_POST['content'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		$sql = "UPDATE `task` SET `content` = '$content' WHERE `ID` = '$task_id'";
		$result = mysql_query($sql);
		if(!$result){
			echo '修改任务内容失败，请稍后尝试';
		}
		else{
			echo '任务修改成功！';
		}
	}
	
	function modify_points(){
		$points = $_POST['points'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		$sql = "UPDATE `task` SET `point` = '$points' WHERE `ID` = '$task_id'";
		$result = mysql_query($sql);
		if(!$result){
			echo '修改失败，请稍后尝试';
		}
		else{
			echo '任务修改成功！';
		}
	}
	
	function modify_date(){
		$date = $_POST['date'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		$sql = "UPDATE `task` SET `validity` = '$date' WHERE `ID` = '$task_id'";
		$result = mysql_query($sql);
		if(!$result){
			echo '修改失败，请稍后尝试';
		}
		else{
			echo '任务修改成功！';
		}
	}
	function close_task(){
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		$sql = "UPDATE `task` SET `status` = 'false' WHERE `id` = '$task_id'";
		$result = mysql_query($sql);
		if(!$result){
			echo 'r任务关闭失败，请稍后尝试';
		}
		else{
			echo '任务关闭成功！';
		}
	}
	
	function stickie_task(){
		$id = $_POST['studentid']; //当前编辑者的学号
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
	    mysql_query("set names 'utf8'");
		$str1 = "SELECT points from user where `id` =  '$studentid'";
		$result = mysql_query($str);
		$enough = false; //默认不够支付置顶
		$remain_points = 0;
		while($temp = mysql_fetch_array($result)){
			//判断当前积分是否够支付置顶,若够，则减积分，改enough为true
			if($temp['points']>STICKIE_POINTS){
				$remain_points = $temp['points']-STICKIE_POINTS;
				$enough = true;
			}
		}
		if($enough){
			//如果置顶成功，设置stickie属性为true,更改积分
			$str2 = "UPDATE `task` SET `stickie` = 'true' WHERE `id` = '$task_id'";
			$str3 = "UPDATE `user` SET `points` = $remain_points 
			WHERE `id` = $task_id";
		    $result = mysql_query($str2)&&mysql_query($str3);
			if($result){
				echo '置顶成功！';
			}
			else{
				echo '置顶失败，请稍后再试。';
		}
		else{
			echo '积分不足！';
		}	
	}
	
?>