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
        $title = $_POST['title'];
        $time = time();
        $flink = $_POST['flink'];
        $sql = "insert `handbook`(`time`,`title`,`flink`) values($time,'$title','$flink');";
        $result = mysqli_query($link,$sql);
        echo '&nbsp;&nbsp;&nbsp;提交时间：'.date('Y-m-d h:i:s',$time).'<br>';
        echo '&nbsp;&nbsp;&nbsp;便签名称：'.$title.'<br>';
        echo '&nbsp;&nbsp;&nbsp;提交链接：'.$flink.'<br>';

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