<?php
	/*
	此段代码用于管理员发布公告(doNotify)，及返回要显示的公告列表(getNotifyList)	需要用到公告标题$title，公告内容$content，公告有效期$validity(截止有效的日期)，公告优先级$priority（分为1,2,3），有多条公告可以显示时根据优先级和时间排序
	表
	notify(operator,title,content,validity,priority,time)
	*/
	
	session_start();
	incluede_once("constants.php");
	function doNotify(){
		$operator = $_SESSION['current_user'];
		$title = stripcslashes(trim($_POST['title']));
		$content = stripcslashes(trim($_POST['content']));
		$validity = $_POST['validity'];
		$priority = $_POST['priority'];
		
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		$temp = time();
		$time = date('Y-m-d H:i:s', $temp);
		$sql = "insert into `notify` values ('$operator','$title','$content','$validity','$priority','$time')";
		$result = mysql_query($sql);
		if($result)
			echo '公告发布成功！';
		else 
			echo '公告添加失败，请稍后再试.'
	}
	
	function getNotifyList(){
		$temp = time();
		$now = date('Y-m-d H:i:s', $temp);
		
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
		if (!$con){
			die('Could not connect: ' . mysql_error());
		}
		if(mysql_select_db(database)===FALSE)
			die("could not connect to database");
		mysql_query("set names 'utf8'");
		
		$sql = "select * from `notify` where validity >= $now order by priority,time";
		$res = mysql_query($sql);
		$list = array();
		$index = 0;
		if($res){
			while($row=mysql_fetch_array($res)){
				list[$index] = $row;
				//测试用
				print_r($row;)
				$index++;
			}
		}
		else
			echo "获取公告列表失败。";
		return list;
	}
?>