<?php
/*         此段代码用于黑名单操作，$action包括add_blacklist（加入黑名单），remove_blacklist（移出黑名单）。
需要用到$owner_id(被访问主页的用户id),$action
blacklist(operator_id，added_id)
added为被加入黑名单的用户id，operator为操作者
加入黑名单时添加一条记录，被移出黑名单时，则从表中删除一条记录。
*/
  
    session_start();
	include_once("constants.php");
	$operator = $_SESSION['stuNum'];
	$added = $_POST['owner_id'];
	$action = $_POST['action'];
	if($action=='add_blacklist')
		add_blacklist();
	else($action=='remove_blacklist')
	    remove_blacklist();
	
	function add_blacklist(){
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
	        die('Could not connect: ' . mysql_error());
        }
     	if(mysql_select_db(database)===FALSE)
	    	die("could not connect to database");
        mysql_query("set names 'utf8'");
     	$sql = "INSERT INTO `blacklist` values('$operator','$owner_id')";
		$result = mysql_query($sql);
		if(mysql_affected_rows($result)){
			echo "已加入黑名单~";
		}
		else{
			echo "加入黑名单失败，请稍后再试";
		}
	}
	
	function remove_blacklist(){
		$con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
	        die('Could not connect: ' . mysql_error());
        }
     	if(mysql_select_db(database)===FALSE)
	    	die("could not connect to database");
        mysql_query("set names 'utf8'");
	    $sql = "DELETE FROM `blacklist` WHERE operator_id ='$operator' AND added_id='$added'";
		$result = mysql_query($sql);
		if(mysql_affected_rows($result))
			echo "该用户已成功移出黑名单~";
		else
			echo "移出黑名单失败，请稍后再试。";
	}
	
?>