<?php
  /*
   此段代码用于界面显示关注列表和粉丝列表和黑名单列表获取数据所用。返回用户名数组
   需要用到$user_id(查看数据的id),从session获得
*/
   session_start();
   include_once("constants.php");
   $user_id = $_SESSION['stuNum'];
   $action = _$POST['action'];
    if($action=='get_followers')
	   get_followers();
    elseif($action=='get_followed')
	   get_followed();
    elseif($action=='get_blacklist')
	   get_blacklist();
 	   
    //获得粉丝数据
    function get_followers(){
	    $con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
    	    die('Could not connect: ' . mysql_error());
        }
    	if(mysql_select_db(database)===FALSE)
    		die("could not connect to database");
        mysql_query("set names 'utf8'");
		$str = "select user from `user` where stuNum in (select visitor_id where owner_id='$user_id')";
		$res = array();
		while($row = mysql_fetch_array($str)){
			$res = $row['user'];
		}
		return $res;
    }
   
    //获得已关注的人数据
    function get_followed(){
	    $con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
    	    die('Could not connect: ' . mysql_error());
        }
    	if(mysql_select_db(database)===FALSE)
    		die("could not connect to database");
        mysql_query("set names 'utf8'");
		$str = "select user from `user` where stuNum in (select owner_id where visitor_id='$user_id')";
		$res = array();
		while($row = mysql_fetch_array($str)){
			$res = $row['user'];
		}
		return $res;
    }
   
    function get_blacklist(){
	    $con = mysql_connect(dbServer,dbUserName,dbPassword);
        if (!$con){
    	    die('Could not connect: ' . mysql_error());
        }
    	if(mysql_select_db(database)===FALSE)
    		die("could not connect to database");
        mysql_query("set names 'utf8'");
		$str = "select user from `user` where stuNum in (select added_id where operator_id = '$user_id')";
		$res = array();
		while($row = mysql_fetch_array($str)){
			$res = $row['user'];
		}
		return $res;
?>