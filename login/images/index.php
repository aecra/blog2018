<?php
include '../config.php';
include '../cheack.php';
include 'function.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="http://upwill.cn/tupian/ioc.png" >
    <link rel="stylesheet" type="text/css" href="../background.css">
    <title>文芥博客后台管理</title>
</head>
<body style="margin:0">

<?php
    //连接数据库，返回数据库连接句柄
    $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
    //判断是否连接成功
    if(!$link){//返回NULL
        echo '数据库连接失败，错误代码：',mysqli_connect_erron(),"<br>";
    }
    else {
        mysqli_set_charset($link, 'utf8');//必须设置编码
?>

<?php
include '../common.php';
?>

<div style="margin-left:65px;padding-top:55px;">
    <div style="margin: 20px;">
        
        <div id="addblock"><a href="add.php" id="addblockfont">我有新的相册</a></div>
        <br>
        <br>
        <br>
            <div id="albumup">
                <?php
                    $sql = 'SELECT * FROM album ORDER BY ID ';
                    $result = mysqli_query($link, $sql);//执行数据库语句,返回字符集
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div id="album">';
                        //图片
                        echo '<img style="width:100%" src="'.$row["imgsrc"].'" />';
                        //名字
                        echo '<div>';
                        echo '<a id="album-name" href="photo-list.php?ID='.$row["ID"].'">';
                        echo $row["name"];
                        echo '</a>';
                        echo '</div>';
                        //描述
                        echo '<div id="album-destract">';
                        echo mb_substr(strip_tags($row["abstract"]) , 0 , 60, 'utf-8').'……';
                        echo '</div>';

                        echo '</div>';
                    }
                    mysqli_free_result($result);//释放字符集空间
                    mysqli_close($link);//关闭数据库连接
                }
                ?>
            </div>
    </div>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
    
    function sumbit_sure(){
        var gnl=confirm("确定要执行吗？");
        if (gnl==true){
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>