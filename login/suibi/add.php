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
        <h2>随笔提交</h2>
    <form method="post" action="action.php" onsubmit="return sumbit_sure()">
        内容：
        <br><br>
        <textarea style="width:500px;height:100px;font-size: 25px;" name="content"></textarea>
        <br><br>
        <input type="submit" style="padding: 7px;width: 200px;font-size: 20px;border-radius: 5px;background-color: #fff" align="center">
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