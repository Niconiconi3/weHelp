<?php
	/*
	��ҳ�������ڴ���Υ�����񣬰����ƶ���������ȷ��顢ɾ��Υ��������action,description��task_id
	ÿ�μ�¼����¼������־���鿴��
	log(task_id,operation,operator,description,time)
	operation��Ϊmove,delete��	description���ڲ���˵�����ɹ���Ա��д��������Ϊmove��˵�����ĸ���������ĸ���飬��Ϊdelete��˵��ɾ��ԭ��
	time��¼����ʱ��
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
			echo '�ƶ�����ʧ�ܣ����Ժ�����';
		}
		else{
			$operator = $_SESSION['admin'];
			$description = $_POST['description'];
			$temp = time();  
			$time = date('Y-m-d H:i:s', $temp);
			$sql2 = "INSERT INTO `log` values('$task_id','move','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '��������ȷ��顣';
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
			echo 'ɾ������ʧ�ܣ����Ժ�����';
		}
		else{
			$sql2 = "INSERT INTO `log` values('$task_id','delete','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '��ɾ��������ݡ�';
			else
				echo 'something wrong';
		}
	}
?>