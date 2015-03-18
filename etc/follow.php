<?php
/*
   此段代码用于访问他人主页时的关注处理，$action包括follow（加关注），cancel（取消关注），remove（移除粉丝）。
   需要用到$owner_id(被访问主页的用户id),$action
   follower($owner_id(回复者的), visitor_id, status)
   status分为0,1
   0为申请关注
   1为已关注成功
   申请关注时添加记录，若申请关注失败，或被移除粉丝，则从表中删除一条记录。
*/

    include_once("constants.php");
	session_start();
	$visitor_id = $_SESSION['current_user'];   //获得当前登陆用户
	$owner_id = $_POST['owner_id'];
	$action = $_POST['action'];
	if($action=="follow")
		follow();
	else if($action=="cancel")
	    cancel();
	else if($action=="remove")
	    remove();
    
	function follow(){
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
	        die('Could not connect: ' . mysql_error());
        }
     	if(mysql_select_db(database)===FALSE)
	    	die("could not connect to database");
        mysql_query("set names 'utf8'");
     	$sql = "INSERT INTO follower(owner_id, visitor_id, status) values('$owner_id','$visitor_id', '0')";
		$result = mysql_query($sql);
		if(mysql_affected_rows($result)){
			echo "已发送关注申请，请等待好友确认哟~";
		}
		else{
			echo "申请失败，请稍后再试。";
		}
	}
	
	function cancel(){
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
	        die('Could not connect: ' . mysql_error());
        }
     	if(mysql_select_db(database)===FALSE)
	    	die("could not connect to database");
        mysql_query("set names 'utf8'");
	    $sql = "DELETE FROM `follower` WHERE owner_id =$owner_id AND visitor_id=$visitor_id";
		$result = mysql_query($sql);
		if(mysql_affected_rows($result))
			echo "取消关注成功！";
		else
			echo "取消关注失败，请稍后再试。";
	}
	
	function remove(){
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
	        die('Could not connect: ' . mysql_error());
        }
     	if(mysql_select_db(database)===FALSE)
	    	die("could not connect to database");
        mysql_query("set names 'utf8'");
	    $sql = "DELETE FROM `follower` WHERE owner_id =$visitor_id AND visitor_id=$owner_id";
		$result = mysql_query($sql);
		if(mysql_affected_rows($result))
			echo "移除粉丝成功！您也可以选择将此用户加入黑名单，不再接受该用户的好友申请。";
		else
			echo "移除粉丝失败，请稍后再试。";
	}