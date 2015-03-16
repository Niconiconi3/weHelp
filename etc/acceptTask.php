<?php
/*此段代码用于接受任务、跟进任务
  当任务被接受时，添加任务进度表里一条记录
  进度变化时，修改任务进度表
  站内信功能完成后，应补充向发布者发送消息提醒确认。
  需要task_id，author_id(任务发布者),exec_id（接受者）,表t_task,标识action（accept_task,exec_confirm,author_confirm）
  (status是0,1,2？？)
  process(task_id, author, executor, author_confirm, exec_confirm, done) 后三个默认false
  author_confirm值为false或true
  exec_confirm值为true或false
  若author_confirm为true，则done为true
  否则，done为false，并修改t_task的done
  仅exec_confirm为true不更改done值
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
	$str1 = "update `t_task` set `status`= 1 where `task_id`=$task_id";
	$result = mysql_query($str1);
	if($result){
		$author_id = $_POST['author_id'];
		$exec_id = $_POST['exec_id'];
		$str2 = "insert into `t_process` (task_id,author, executor) values ($task_id,$author_id,$exec_id)";
		$res = mysql_query($str2);
		if($res){
			echo "任务接受成功了哟~请尽快完成~";
		}
		else{
			echo "任务接受失败，请稍后再试。";
		}
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
	$srt1 = "update `t_process` set `exec_confirm` = true where `task_id` = $task_id";
	if(mysql_query(str1)){
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
	$srt1 = "update `t_process` set `exec_confirm` = true where `task_id` = $task_id";
	if(mysql_query($str1)){
		$str2 = "update `t_process` set `done` = true where `task_id` = $task_id";
		if(mysql_query($str2){
			$str3 = "update 't_task' set `status`=2 where `task_id`= $task_id";
			if(mysql_query($str3){
				echo "任务已交易成功！感谢使用weHelp平台！";
			}
			else{
				echo "确认失败，请稍后再试。";
			}
		}
		else{
			echo "确认失败，请稍后再试。";
		}
	}
	else{
		echo "确认失败，请稍后再试。";
	}
}

?>