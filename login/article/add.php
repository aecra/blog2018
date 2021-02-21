<?php
include '../config.php';
include '../cheack.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="http://upwill.cn/tupian/ioc.png">
	<title>文芥博客后台管理</title>
</head>
<body style="margin:0">

<?php
include '../common.php';
?>

<div style="margin-left:65px;padding-top:55px">
    <div style="margin-top:20px;padding-left:10px">
        <h2>文章提交</h2>
        <form method="post" action="action.php" onsubmit="return sumbit_sure()">
        题目:<br><input type="text" name="title">
        <br><br>
        作者:<br><input type="text" name="author">
        <br><br>
        标签:<br><input type="text" name="tab">
        <br><br>
        摘要(图片路径)：<br><input type="text" name="abstract">
        <br><br>
        内容：
        <br>
        <div style="min-width:600px;width: 70%">
            <!-- 加载编辑器的容器 -->
        <script id="container" name="content" type="text/plain">

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
        
        <br>
        <input type="submit" style="padding: 10px;width: 200px;font-size: 30px;border-radius: 5px;background-color: #fff" align="center">
    </form> 
    </div>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
    
    function sumbit_sure(){
        var gnl=confirm("确认提交");
        if (gnl==true){
            return true;
        }else{
            return false;
        }
    }
</script>
</body>
</html>