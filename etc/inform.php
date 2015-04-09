<?php
	/*
	此段代码用于管理员发送通知（单独，群发）、接收回复，用户删除通知等功能。
	用户回复通知同回复私信
	用户回复系统通知时，收件人为0
	普通用户界面显示通知时按私信显示，并且置顶。
    表
	inform($no,$content,$to,$operator,$time,$status)
	$status 0表示未读，1表示已读，2表示已删除（即不再显示，但数据库中依然存在）
	to是接收者，若为群发，接收者填写all.
	*/
	session_start();
	include_once("constants.php");
	
	function inform(){
		$operator = $_SESSION['admin'];
		$content = stripcslashes(trim($_POST['content']));
		$to = $_POST['to'];
		$temp = time();
		$time = date('Y-m-d H:i:s', $temp);
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("insert into `inform` (content,to,operator,time,status) values ('$content','$to','$operator','$time','0')");
		if($res)
			echo 'inform success!';
		else
			echo 'inform failure.';
	}
	
	function get_reply(){
		$operator = $_SESSION['admin'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("select * from `message` where toUser = '0' order by time");
		$reply = array();
		$index = 0;
		if($res){
			while($row=mysql_fetch_array($res)){
				$reply[$index] = $row;
				print_r($row);
				$index++;
			}
			return $reply;
		}
		else
			echo 'get_reply failure.';
	}
	
	function get_inform(){
		$inform_list = array();
		$index = 0;
		$user = $_SESSION['admin'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("select * from `inform` where (`to` = '$user' and status!='2') or `to`='$user'");
		if($res){
			while($row=mysql_fetch_array($res)){
				$inform_list[$index] = $row;
				print_r($row);
				$index++;
			}
			return $inform_list;
		}
		else
			echo 'get_inform failure.';
	}
	
	function update_status(){
		$no = _POST['no'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("update `inform` set status='1' where no='$no'");
		if($res)
			echo 'update_status success.';
		else
			echo 'update_status failure.'
	}
	
	function delete_inform(){
		$no = _POST['no'];
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$res = mysql_query("select to from `inform` where no='$no'");
		if($res){
			while($row=mysql_fetch_array($res)){
				echo $row;
				if($row['to'=="all")
					echo '群发通知无法删除';
			}
		}
		else{
			$res2 = mysql_query("update `inform` set status='2' where no='$no'");
			if($res2)
				echo 'update_status success.';
			else
				echo 'update_status failure.'
		}
		
	}

?>