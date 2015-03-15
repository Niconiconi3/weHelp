<?php

	include_once("constants.php");
	
    $action = $_POST['action'];
	$task_no = $_POST['task_no'];
	if($action=='modify_Content'){
		modify_content();
	}elseif($action=='closeTask'){
		close_task();
	}elseif($action=='stickieTask'){
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
		$sql = "UPDATE `t_task` SET `task_content` = $content WHERE `task_no` = $task_no";
		$result = mysql_query($sql);
		if(!$result){
			echo '修改任务内容失败，请稍后尝试';
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
		$sql = "UPDATE `t_task` SET `task_status` = false WHERE `task_no` = $task_no";
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
		$str1 = "SELECT points from t_user where `id` =  $studentid";
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
			$str2 = "UPDATE `t_task` SET `stickie` = true WHERE `task_no` = $task_no";
			$str3 = "UPDATE `t_user` SET `points` = $remain_points 
			WHERE `task_no` = $task_no";
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