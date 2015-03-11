<?php

    include_once("connect.php");
    $reply_content = stripcslashes(trim($_POST['reply_content']));
	$author = $_SESSION['current_user'];   //获得当前登陆用户
	$task_name = $_POST['task'];           //被评论的任务
	$time = time();
	
	//reply唯一id auto increment
	$sql = "INSERT INTO t_comment(author, task_name, reply, time) 
	values($author,$task_name, $reply_content, $time)";
	
	$result = mysql_query($sql);
	if($result){
		echo "评论成功！";
	}
	else{
		echo "评论失败，请稍后再试。";
	}
	
?>