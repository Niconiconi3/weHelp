<?php
	/*
	�˶δ������ڹ���Ա��������(doNotify)��������Ҫ��ʾ�Ĺ����б�(getNotifyList)	��Ҫ�õ��������$title����������$content��������Ч��$validity(��ֹ��Ч������)���������ȼ�$priority����Ϊ1,2,3�����ж������������ʾʱ�������ȼ���ʱ������
	��
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
			echo '���淢���ɹ���';
		else 
			echo '�������ʧ�ܣ����Ժ�����.'
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
				//������
				print_r($row;)
				$index++;
			}
		}
		else
			echo "��ȡ�����б�ʧ�ܡ�";
		return list;
	}
?>