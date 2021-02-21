<?php
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
        <h2>友链提交</h2>
    <form method="post" action="action.php">
        网站名称:<br>
        <input type="text" name="title">
        <br>
        <br>
        网站链接:<br>
        <input type="text" name="flink">
        <br>
        <br>
        <input type="submit" style="padding: 5px;width: 150px;font-size: 20px;border-radius: 5px;background-color: #fff" align="center">
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