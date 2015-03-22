<?php
	session_start();
	require('constants.php');
//	$openID = $_POST['openID'];
	//测试用
	$_SESSION['openID'] = "aggasgasg3tw3454yasgjag";
    $openID = $_SESSION['openID'] ;
		//查找数据库中是否含有该ID
		$sql = "select * from user where openID = '$openID'";
		
		//验证数据库服务器连接
		if(($con=mysql_connect(dbServer,dbUserName,dbPassword))===FALSE)
			die("could not conect to database");
		
		//验证服务器连接
		if(mysql_select_db(database)===FALSE)
			die("could not conect to database");

		$result = mysql_query($sql);
		
		//验证数据库操作是否成功
		if($result===FALSE)
			die("could not query database");
		
		//若该用户已注册，返回true，否则返回假
		if(mysql_num_rows($result)==1){
			$row = mysql_fetch_array($result);
			$_SESSION['stuNum'] = $row['stuNum'];
			//测试用
			echo "用户已注册 ".$row['stuNum'];
		}else{
		//	header("Location:此处为注册页面url"); 
		//	echo "跳转到注册界面~";
			?>
<!DOCTYPE html>

<html>
<head>
    <title id="register"></title>
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <meta name="author" content="niconiconi-nju" >
    <link rel="stylesheet" type="text/css" href=".\css\commonui.css"></link>
    <link rel="stylesheet" type="text/css" href=".\css\buttons.css"></link>
    
    <script>

        function checkUsername() {
            var username = document.getElementById("username").value;
            var reg = /^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]+$/;
            if (!reg.test(username)) {
                alert("昵称包含非法字符。支持中文、英文、数字、“_”");
                return false;
            }
            else if (username.length > 14) {
                alert("昵称长度不符。请输入14位以内中文、英文、数字、“_”");
                return false;
            }
            else {
                return true;
            }
        }

        function checkStudentId() {                                                  //如果可以导入教务网数据验证学号更好
            var length = document.getElementById("studentid").value.length;
            if (length!=9) {;
                return false;
            }
            alert("请输入正确的学号")
            else {
                if (isNaN(document.getElementById("studentid").value)) {
                    alert("请输入正确的学号");
                    return false;
                }
                else {
                    return true;
                }
            }
        }

        function checkEmail() {
            var email = document.getElementById("email").value;
            var reg = /^([a-zA-Z0-9_-])+@smail.nju.edu.cn$/;
            if (reg.test(email)) {
                return true;
            }
            else {
                alert("请输入正确的校邮地址");
                return false;
            }
        }

        function check() {
            if (!checkUsername()) return false;
            if (!checkStudentId()) return false;                            //后台应验证学号是否被注册过
            if (!checkEmail()) return false;
            return true;
        }
    </script>
     
</head>

<body>

    <div id="register-field">

    <h1>
        欢迎加入我们
        </h1>>
    <form name="register" action="mailConfirm.php" method="post" onsubmit="return check();">
        <div>
            <div class="form-list">
                <span class="text">昵称</span>
                <input id="username" type="text" name="username" onchange="checkUsername()" />
            </div>
            <div class="form-list">
                <span class="text">学号</span>
                <input id="studentid" type="text" name="studentid" onchange="checkStudentId()" />
            </div>
            <div style="margin: 0 auto;height:40px;position:relative; left:0;">
                <div class="form-list">
                    <span class="text">校邮</span>
                    <input id="email" type="text" name="email" onchange="checkEmail()" />
                </div>
                <div style="position:absolute; top:0px; left:60%; height:30px;" class="system">(学号@smail.nju.edu.cn)</div>
            </div>
            <div class="form-list">
                <input class="ghbutton" type="submit" style="font-family:Microsoft YaHei UI; font-size:15px;" value="join us" />
            </div>
        </div>
        <div style="width:30%; position:relative; left:42%; top:10px;">
            <p class="system">我们将向您的邮箱发送验证邮件</p> 
            <p class="system">请于48小时内<a href="http://mail.nju.edu.cn">登录邮箱</a>进行验证</p>
        </div>
        

    </form>

    </div>
</body>

</html>
<?php
}
		
?>