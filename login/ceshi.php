<?php
include './cheack.php';
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
    include 'config.php';
    $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
    //判断是否连接成功
    if(!$link){//返回NULL
        echo '数据库连接失败，错误代码：',mysqli_connect_erron(),"<br>";
    }
    else {
        mysqli_set_charset($link, 'utf8');//必须设置编码
?>

<?php
include './common.php';
?>

<div style="margin-left:65px;padding-top:55px">
	<div style="margin: 20px;">

            <?php
                echo md5(15176888536).'<br>';
                echo md5('epochflame').'<br>';

            mysqli_free_result($result);//释放字符集空间
            mysqli_close($link);//关闭数据库连接
        }
        ?>
        </table> 

	</div>
</div>

<script type="text/javascript">
    setTimeout(function() {
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