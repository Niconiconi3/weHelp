<?php
/*
   此段代码用于在任务下添加回复
   需要用到$reply_content,$author（回复的作者）,$task_name,
*/
    include_once("constants.php");
    $reply_content = stripcslashes(trim($_POST['reply_content']));
	$author = $_SESSION['current_user'];   //获得当前登陆用户
	$task_name = $_POST['task'];           //被评论的任务
	$time = time();
	
	//reply唯一id auto increment
	$con = mysql_connect(dbServer,dbUserName,dbPassword);
    if (!$con){
	    die('Could not connect: ' . mysql_error());
    }
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
    mysql_query("set names 'utf8'");
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