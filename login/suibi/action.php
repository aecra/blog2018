<?php
include '../config.php';
include '../cheack.php';
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
include '../common.php';
?>

<div style="margin-left:65px;padding-top:55px">
    <?php
    //连接数据库，返回数据库连接句柄
    $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
    //判断是否连接成功
    if(!$link){//返回NULL
        echo '数据库连接失败，错误代码：',mysqli_connect_erron(),"<br>";
    }
    else {
        mysqli_set_charset($link, 'utf8');//必须设置编码
        $content = $_POST['content'];
        $time = time();
        $sql = "INSERT INTO suibi VALUES(NULL ,'$time','$content')";
        $result = mysqli_query($link,$sql);
        mysqli_close($link);//关闭数据库连接
    }
    ?>
    <?php
    if($result){
        echo '<meta http-equiv="refresh" content="0.001;url=index.php">';
    }else{
        echo '<meta http-equiv="refresh" content="0.001;url=index.php">';
    }
    ?>
</div>
</body>
</html>