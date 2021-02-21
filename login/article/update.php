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
    <link  rel="stylesheet" type="text/css" href="../utf8-php/third-party/SyntaxHighlighter/shCoreDefault.css">
    <script src="../utf8-php/third-party/SyntaxHighlighter/shCore.js"></script>
    <title>文芥博客后台管理</title>
    <script type="text/javascript">
        SyntaxHighlighter.all();
    </script>
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
            $sql = 'SELECT * FROM article WHERE ID = '.$_POST['ID'];
            $result = mysqli_query($link, $sql);//执行数据库语句,返回字符集
            $row = mysqli_fetch_array($result);
        }
        ?>

    <div style="margin: 20px;">
        <div style="margin: 20px;font-size: 25px;">
        <form method="post" action="updateaction.php" onsubmit="return sumbit_sure()">
        题目:<input type="text" name="title" value="<?php echo $row['title']; ?>">
        <br><br>
        作者:<input type="text" name="author" value="<?php echo $row['author']; ?>">
        <br><br>
        <!-- 时间 -->
        <input type="hidden" name="time" value="<?php echo $row['time']; ?>">
        标签:<input type="text" name="tab" value="<?php echo $row['tab']; ?>">
        <br><br>
        摘要：<input type="text" name="abstract" value="<?php echo $row['abstract'];?>">
        <br><br>
        内容：
        <br>
        <div style="mix-width:600px;width:70%">
            <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain">
<?php echo $row['content'];?>
        </script>
        <!-- 配置文件 -->
        <script type="text/javascript" src="../utf8-php/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="../utf8-php/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container',{
                catchRemoteImageEnable:false,
                });
        </script>
        </div>
        
        <?php 
            mysqli_free_result($result);//释放字符集空间
            mysqli_close($link);//关闭数据库连接
        ?>
        
        <br>
        <button type="submit" style="background-color:rgba(200,200,200,0.8);padding: 10px;font-size: 25px;text-decoration:none;font-family: cursive;border:none;">提交修改</button>
    </form>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
    
    function sumbit_sure(){
        
        if(!document.getElementByName("title").value||!document.getElementByName("author").value||!document.getElementByName("tab").value||!document.getElementByName("abstract").value||!document.getElementByName("content").value){
            alert("请补全信息");
            return false;
        }else{
            var gnl=confirm("确认提交");
            if (gnl==true){
                return true;
            }else{
                return false;
            }
        }
    }
</script>
</body>
</html>