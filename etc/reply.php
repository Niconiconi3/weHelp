<?php
/*
   此段代码用于在任务下添加回复
   需要用到$reply_content,$author（回复的作者）,$task_id,
   comment(author_id(回复者的), task_id, reply（内容）, time（回复时间）)
*/
    include_once("constants.php");
    $reply_content = stripcslashes(trim($_POST['reply_content']));
	session_start();
	$author = $_SESSION['current_user'];   //获得当前登陆用户
	$task_id = $_POST['task_id'];           //被评论的任务
	$time = time();
	
	//reply唯一id auto increment
	$con = mysql_connect(dbServer,dbUserName,dbPassword);
    if (!$con){
	    die('Could not connect: ' . mysql_error());
    }
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
    mysql_query("set names 'utf8'");
	$sql = "INSERT INTO comment(author_id, task_id, reply, time) 
	values($author,$task_id, $reply_content, $time)";
	
	$result = mysql_query($sql);
	if($result){
		echo "评论成功！";
	}
	else{
		echo "评论失败，请稍后再试。";
	}
	
?>