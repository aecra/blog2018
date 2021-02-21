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
    <div style="margin-top:20px;padding-left:30px">
        <h2>文件提交</h2>
    <form method="post" action="action.php" enctype="multipart/form-data">
        选择封面图片：<br><br>
        <input type="file" name="img">
        <br><br>
        相册名称：<br><br>
        <input type="text" name="name" style="width: 150px;font-size: 20px">
        <br><br>
        相册描述：<br><br>
        <textarea name="abstract"  style="width: 100%;height: 200px;font-size: 18px"></textarea>
        <br><br>
        <input type="submit" style="padding: 5px;width: 150px;font-size: 20px;border-radius: 5px;background-color: #fff"  onsubmit="return sumbit_sure()" align="center">
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