<?php
/*         �˶δ������ں�����������$action����add_blacklist���������������remove_blacklist���Ƴ�����������
��Ҫ�õ�$owner_id(��������ҳ���û�id),$action
blacklist(operator_id��added_id)
addedΪ��������������û�id��operatorΪ������
���������ʱ���һ����¼�����Ƴ�������ʱ����ӱ���ɾ��һ����¼��
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
			echo "�Ѽ��������~";
		}
		else{
			echo "���������ʧ�ܣ����Ժ�����";
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
			echo "���û��ѳɹ��Ƴ�������~";
		else
			echo "�Ƴ�������ʧ�ܣ����Ժ����ԡ�";
	}
	
?>