<?php
	/*
	���ڻ��ֹ���
	�����������֡��۳�����
	���¼������־
	points_log(user_id,operator,operation,num,description,time)
	operation����award,punish
	num�ǲ���������Ŀ
	description˵������/�۳����ֵ����ɣ�����ɹ���Ա�ڽ�����д
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
			echo '���ֽ���ʧ�ܣ����Ժ�����';
		}
		else{
			$operator = $_SESSION['stuNum'];
			$description = $_POST['description'];
			$temp = time();  
			$time = date('Y-m-d H:i:s', $temp);
			$sql2 = "INSERT INTO `log` values('$task_id','award','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '���ֽ����ɹ���';
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
			echo '���ֿ۳�ʧ�ܣ����Ժ�����';
		}
		else{
			$operator = $_SESSION['stuNum'];
			$description = $_POST['description'];
			$temp = time();  
			$time = date('Y-m-d H:i:s', $temp);
			$sql2 = "INSERT INTO `log` values('$task_id','award','$operator','$description','$time')";
			if(mysql_query($sql2))
				echo '���ֿ۳��ɹ���';
			else
				echo 'something wrong';
		}
	}

?>