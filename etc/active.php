<?php
/* 此段代码用于点击邮箱链接后验证激活码
   需使用t_studentid $openid
*/
/*
user 表名：user
用户名：user
openID：openID
学号：stuNum
邮箱：mailbox
积分：points
*/
   session_start();
   $_SESSION['openID'] = "aggasgasg3tw3454yasgjag";
   include_once("constants.php");
   
   $verify = stripslashes(trim($_GET['verify']));
   $nowtime = time();
   $fmt = date('Y-m-d H:i:s', $nowtime);
   
   $con = mysql_connect(dbServer,dbUserName,dbPassword);
    if (!$con){
	    die('Could not connect: ' . mysql_error());
    }
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
    mysql_query("set names 'utf8'");
    $result = mysql_query("select * from `t_studentid` where status=0 and token = '$verify'");
    if($result==false) 
       exit("unable to find data in database");
   $row = mysql_fetch_array($result);
   
    if($row){ 
        if($fmt>$row['token_exptime']){
	       $msg = '您的激活有效期已过，请登录您的账号重新发送激活邮件。';
		}else{
		   mysql_query("update `t_studentid` set status=1 where id=".$row['id']);
	       //echo mysql_affected_rows($con).mysql_error();
		   $_SESSION['stuNum'] = $row['id'];
		   $user = $row['username'];
		   $openID = $_SESSION['openID'];
		   $stuNum = $row['id'];
		   $mail = $row['email'];
		   $ini_points = INI_POINTS;
		   $sql_insert = mysql_query("insert into `user` (user,openID,stuNum,mailBox,points)values('$user','$openID','$stuNum','$mail','$ini_points')");
		   //mysql_query("delete from `t_studentid` where id=".$row['id']);
		   echo '激活成功';
		}
    }
	else{
	    echo '激活失败。';
	}
?>