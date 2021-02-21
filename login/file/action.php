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
include '../utf8-php/php/sdk/upload.php';
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
        $name = $_FILES['file']['name'];
        $time = time();
        $abstract = $_POST['abstract'];
        $show = 'http://show.upwill.cn/';
        $down = 'http://down.upwill.cn/';
        $path = $_FILES['file']['tmp_name'];
        $type = $ext=pathinfo($_FILES['file']['name'])['extension'];
        $to="upload/files/";
        $show=$show.$to.$name;
        $down=$down.$to.$name;
        upload_all($to.$name,$path);

        $sql = "insert `file`(`name`,`time`,`abstract`,`show`,`down`) values('$name','$time','$abstract','$show','$down');";
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

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
</script>
</body>
</html>