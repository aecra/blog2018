<?php
//登录验证及身份验证

//验证cookie
function check(){
	$admin = htmlspecialchars($_COOKIE["admin"]);
    $password = htmlspecialchars($_COOKIE["password"]);

    include 'config.php';
    //连接数据库，返回数据库连接句柄
    $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
    //必须设置编码
    mysqli_set_charset($link, 'utf8');

    $sql = 'SELECT * FROM admin';

    $point = 0;

    $result = mysqli_query($link, $sql);//执行数据库语句,返回字符集
    while ($row = mysqli_fetch_array($result)) {
            if($admin == $row['admin']&& $password == $row['password']) {
                $point = 1;
                break;
            }
    }
    if($point == 0){
    	setcookie("admin",'',time()-200);
    	setcookie("password",'',time()-200);
        echo 'fail'.'<meta http-equiv="refresh" content="0.01;url=login.html">';
        exit;
    }
    mysqli_close($link);//关闭数据库连接
}

if(isset($_POST['admin'])){//已提交表单
	if(!preg_match("/^[a-zA-Z]*$/", $_POST['admin'])&&!preg_match("/^[a-zA-Z0-9]*$/", $_POST['password'])){//表单不符合要求,即使有cookie，也删掉
		setcookie("admin",'',time()-200);
    	setcookie("password",'',time()-200);
		echo 'fail'.'<meta http-equiv="refresh" content="0.01;url=login.html">';
    exit;
}else{//表单符合要求,验证表单，如果不正确，删掉已有cookie，跳出
	$admin = htmlspecialchars($_POST["admin"]);
	$password = htmlspecialchars($_POST["password"]);

    include 'config.php';
	//连接数据库，返回数据库连接句柄
	$link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
	mysqli_set_charset($link, 'utf8');//必须设置编码

	$sql = 'SELECT * FROM admin';

	$checkvar=0;

	$result = mysqli_query($link, $sql);//执行数据库语句,返回字符集
	while ($row = mysqli_fetch_array($result)) {
        	if($admin == $row['admin']&& $password == $row['password']) {
            	$checkvar = 1;
            	break;
        	}
	}
	if($checkvar == 0){
		setcookie("admin",$admin,time()-200);
    	setcookie("password",$password,time()-200);
        echo 'fail'.'<meta http-equiv="refresh" content="0.01;url=login.html">';
        exit;
    }else{
    	setcookie("admin",$admin,time()+3600);
    	setcookie("password",$password,time()+3600);
    }
	mysqli_close($link);//关闭数据库连接
}
}else{//未提交表单
	if(isset($_COOKIE["admin"])){//如果存在cookie,更新cookie
		$admin = htmlspecialchars($_COOKIE['admin']);
        $password = htmlspecialchars($_COOKIE['password']);
        setcookie("admin",$admin,time()+3600);
        setcookie("password",$password,time()+3600);
        check();
	}else{//如果不存在cookie，跳出
		echo 'fail'.'<meta http-equiv="refresh" content="0.01;url=login.html">';
    exit;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="http://upwill.cn/tupian/ioc.png" >
	<title>文芥博客后台管理</title>
</head>
<body style="margin:0">

<?php
include 'common.php';
?>

<div id="main" style="margin-left:65px;padding-top:55px;background-image: url(imgs/main.jpg); background-repeat: no-repeat;background-attachment: fixed;background-size: cover">
	<div style="margin-left:50px;margin-top:80px">
	<h2>博客后台管理系统</h2>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	version:&nbsp;&nbsp;&nbsp;2.4
	</div>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
        var leftlead = document.getElementById("main");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
</script>
</body>
</html>