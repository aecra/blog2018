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
if (!$link) { //返回NULL
    echo '数据库连接失败，错误代码：', mysqli_connect_erron(), "<br>";
} else {
    mysqli_set_charset($link, 'utf8'); //必须设置编码

    $sql = 'UPDATE article SET title=\'' . $_POST['title'] . '\', author=\'' . $_POST['author'] . '\', time=\'' . $_POST['time'] . '\', tab=\'' . $_POST['tab'] . '\', abstract=\'' . $_POST['abstract'] . '\', content=\'' . $_POST['content'] . '\' WHERE time = ' . $_POST['time'];
    
    $result = mysqli_query($link, $sql);
    
    mysqli_close($link); //关闭数据库连接
    
}
?>
    <div style="width:300px;margin-top:30px;margin-left:20px;text-align:center;box-shadow:2px 2px 20px rgb(200,200,200)">
    <h3>提交结果</h3>
    <hr>
    <?php
if ($result) {
    echo '修改成功<meta http-equiv="refresh" content="0.01;url=index.php">';
} else {
    echo '修改失败<meta http-equiv="refresh" content="0.01;url=index.php">';
}
?>
<br>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
</script>
</body>
</html>