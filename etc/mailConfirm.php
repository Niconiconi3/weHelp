<?php
    include_once("connect.php");//�������ݿ�
    include_once("smtp.class.php");//�ʼ�������
   
    $username = stripslashes(trim($_POST['username']));
    $studentid = trim($_POST[studentid]);
    $query = mysql_query("select id from t_studentid where id = '$studentid'");
    $num = mysql_num_rows($query);
    if($num==1){
      echo 'ѧ����ע������������롣';
	  exit;
	}
	//���켤��ʶ���룺
	$email = trim($_POST['email']);
	$regtime = time();
	$token = md5($username,$studentid,$regtime);//��������ʶ����
	$token_exptime = time()+60*60*48;//����ʱ��Ϊ48Сʱ��
	
	$sql = "insert into `t_studentid`(id,username,email,token,token_exptime,regtime)
	values($studentid,$username,$email,$token,$token_exptime,$regtime)";
	
	mysql_query($sql);
	
	if(mysql_num_rows($sql)){
	    $amtpserver = "smtp.163.com"; //SMTP������
	    $smtpserverport = 25; //SMTP�������˿ڣ�һ��25
	    $smtpusermail = "niconiconi_nju@163.com"; //SMTP���������û�����
	    $smtpuser = "niconiconi_nju@163.com";//SMTP���������û��˺�
    	$smtppass = "njuniconiconi";//SMTP���������û�����
    	$smtp = new Smtp($smtpserver, $smtpserverport,true,$smtpuser,$smtppass);
    	$emailtype = "HTML";//�ż�����
     	$smtpemailto = $email; //�ʼ����շ�
    	$smtpmailfrom = $smtpusermail; //�����ʼ���
    	$emailsubject = "����֮���û��˺ż���";//�ʼ�����
	//�ʼ��������ݣ�
    	$emailbody = "�װ���".$username.":<br/>��л������ƽ̨ע�����˺š�<br/>�������Ӽ��������˺š�<br/><a href='http://www.wehelp.com/demo/register/active.php?verify=".$token"'target='_blank'>http://www.wehelp.com/demo/register/active.php?verify=".$token."</a><br/>
	������������޷�������뽫�����Ƶ�����������ַ���н�����ʣ�������48Сʱ����Ч��
	<br/>����˴μ���������㱾������������Ա��ʼ���<br/><p style='text-align:right'>-------- weHelp�ŶӾ���</p>";
	//�����ʼ���
  	    $rs = $smtp->sendmail($smtpemailto,$smtpmailfrom,$emailsubject,$emailbody,$emailtype);
    	if($rs==1){
	        $msg = '��ϲ������֤�ɹ���<br/>���¼���估ʱ�����˺š�';
    	}else{
     	    $msg = $rs;
	    }
	}
	echo $msg;
?>
   
 