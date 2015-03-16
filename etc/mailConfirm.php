<?php
/* 此段代码用于向邮箱发送激活码
   需用到$username, $studentid, t_studentid, email
   t_studentid(id,username,email,token,token_exptime,status,regtime)
*/
    include_once("constants.php");
    include_once("smtp.class.php");//邮件发送类
   
    $username = stripslashes(trim($_POST['username']));      
    $studentid = trim($_POST['studentid']);
	
	$con = mysql_connect(dbServer,dbUserName,dbPassword);
    if (!$con){
	    die('Could not connect: ' . mysql_error());
    }
	if(mysql_select_db(database)===FALSE)
		die("could not connect to database");
    mysql_query("set names 'utf8'");
	header("Content-Type: text/html; charset=utf-8");
    $query = mysql_query("select id from t_studentid where id = '$studentid'");
    $num = mysql_num_rows($query);
    if($num==1){
      echo '学号已注册过，请检查输入。';
	  exit;
	}
	//构造激活识别码：
	$email = trim($_POST['email']);   
	$regtime = time();  
    $regtime = date('Y-m-d H:i:s', $regtime);
	$temp = $studentid.$regtime;
	$token = md5($temp,false);//创建激活识别码  
	$token_exptime = $regtime+60*60*48;//过期时间为48小时后
	$token_exptime = date('Y-m-d H:i:s', $token_exptime);
	$sql = "insert into `t_studentid`(id,username,email,token,token_exptime,regtime)
	values($studentid,$username,$email,$token,$token_exptime,$regtime)";
	
	mysql_query($sql);  
	
	if(mysql_affected_rows($con)){
	    $smtpserver = "smtp.163.com"; //SMTP服务器
	    $smtpserverport = 25; //SMTP服务器端口，一般25
	    $smtpusermail = "niconiconi_nju@163.com"; //SMTP服务器的用户邮箱
	    $smtpuser = "niconiconi_nju@163.com";//SMTP服务器的用户账号
    	$smtppass = "njuniconiconi";//SMTP服务器的用户密码
    	$smtp = new Smtp($smtpserver, $smtpserverport,true,$smtpuser,$smtppass);
    	$emailtype = "HTML";//信件类型
     	$smtpemailto = $email; //邮件接收方
    	$smtpmailfrom = $smtpusermail; //发送邮件方
    	$emailsubject = "举手之劳用户账号激活";//邮件主题
		$emailsubject = "=?UTF-8?B?".base64_encode($emailsubject)."?=";
	//邮件主体内容：
    	$emailbody = "亲爱的".$username.":<br/>感谢您在我平台注册新账号。<br/>请点击链接激活您的账号。<br/><a href=http://www.baidu.com target=_blank>http://www.wehelp.com/demo/register/active.php?verify=".$token."</a><br/>
	如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接48小时内有效。
	<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- weHelp团队敬上</p>";
	//发送邮件：
  	    $rs = $smtp->sendmail($smtpemailto,$smtpmailfrom,$emailsubject,$emailbody,$emailtype);
    	if($rs==1){
	        echo '恭喜您，验证邮件发送成功！<br/>请登录邮箱及时激活账号。';
    	}else{
     	    echo $rs;
	    }
	}
	
?>
   
 