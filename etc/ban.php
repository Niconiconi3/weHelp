<?php
/*
	���ڽ�ֹΥ���û�����
	�������ban����¼������־
	��
	ban($user,$operator,$time,$duration,$reason)
	durationΪ���Խ�ֹ����
	�������ִ�����
*/

	session_start();
	include_once("constants.php");
	function ban(){
		$user = $_POST['user'];
		$operator = $_SESSION['admin'];
		$duration = $_POST['duration'];
		$reson = stripcslashes(trim($_POST['reason']));
		$temp = time();
		$time = date('Y-m-d H:i:s', $temp);
		
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("insert into ban ('$user','$operator','$time','$time','$duration','reason')");
		if($res)
			echo 'ban success.';
		else
			echo 'ban fail.';
	}
	
	function ifBan(){
		$user = $_SESSION['stuNum'];
		$temp = time();
		$now = date('Y-m-d H:i:s', $temp);
		
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("select * from ban where user='$user'");
		if($res){
			while($row=mysql_fetch_array($res)){
				if($row['duration']>=$now)
					echo '������ֹ���в���';
				//��ת��ĳ����
			}
		}
	}
	
	function login(){
		$no = $_POST['no'];
		$password = $_POST['password'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("select * from admin where no = '$no'");
		if($res){
			if($row=mysql_fetch_array($res)){
				if($row['password']==$password){
					echo "login success.";
				}
				else{
					echo "wrong password.";
				}
			}
			else{
				echo "admin doesn't exist.";
			}
		}
		else{
			echo "select query error.";
		}
	}
?>