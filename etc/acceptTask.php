<?php
/*此段代码用于接受任务、跟进任务
  当任务被接受时，添加任务进度表里一条记录
  进度变化时，修改任务进度表
  站内信功能完成后，应补充向发布者发送消息提醒确认。
  需要task_id，author_id(任务发布者),exec_id（接受者）,表t_task,标识action（accept_task,exec_confirm,author_confirm）
  (status是0,1,2,3)
*/
$action = $_POST['action'];
if($action==="accept_task"){
	accept_task();
}else if($action==="exec_confirm"){
	exec_confirm();
}else if($action==="author_confirm"){
	author_confirm();
}
function accept_task(){
	$task_id = $_POST['task_id'];
    $con = mysql_connect(dbServer,dbUserName,dbPassword);
    if (!$con){
	    die('Could not connect: ' . mysql_error());
    }
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
    mysql_query("set names 'utf8'");
	$str1 = "update `task` set `status`= 1 where `id`=$task_id";
	$result = mysql_query($str1);
	if($result){
		echo "任务接受成功了哟~请尽快完成~";
		//待补充，向发布者发送任务已被接受的通知。
	}
	else{
		echo "任务接受失败，请稍后再试。";
	}
}
  
function exec_confirm(){
	$con = mysql_connect(dbServer,dbUserName,dbPassword);
    if (!$con){
	    die('Could not connect: ' . mysql_error());
    }
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
    mysql_query("set names 'utf8'");
	$srt1 = "update `task` set `status` = 2 where `id` = $task_id";
	if(mysql_query(str1)){
		$confirm_time = time();  
        $confirm_time = date('Y-m-d H:i:s', $regtime);
		$str2 = "update `task` set `confirmTime`=$confirm_time";
		mysql_query($str2);
		echo "确认成功，请等待发布者确认任务进度。";
		//应补充向发布者发送消息提醒确认。
	}
	else{
		echo "确认失败，请稍后再试。";
	}
}

function author_confirm(){
	$con = mysql_connect(dbServer,dbUserName,dbPassword);
    if (!$con){
	    die('Could not connect: ' . mysql_error());
    }
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
    mysql_query("set names 'utf8'");
	$srt1 = "update `task` set `status` = 3 where `id` = $task_id";
	if(mysql_query($str1)){
		echo "任务已交易成功！感谢使用weHelp平台！";
		//补充向任务执行者发送通知。
	}
	else{
		echo "确认失败，请稍后再试。";
	}
}

?>