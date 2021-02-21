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
<div style="height:55px;width:100%;background-color:rgb(0,0,0);color:rgb(255,255,255); position: fixed;z-index:1">
	<div style="font-size:25px;padding-top:10px">
		&nbsp;&nbsp;&nbsp;<img src="" style="height:30px">文芥博客后台管理
		<div style="font-size:18px;padding-top:10px;float:right;color:rgb(200,200,255)">
		<a href="http://upwill.cn" style="text-decoration: none;color:rgb(200,200,255)">进入首页</a>&nbsp;&nbsp;&nbsp;</div>
	</div>
</div>

<div id="leftlead" style="position: fixed;margin-top:55px;background-color:#34495E;width:65px">
	<div style="height:65px;width:65px;background-color:#34495E" title="主页">
		<a href="http://upwill.cn/login/index.php"><img src="../imgs/home.png" style="padding-top:16.5px;padding-left:16.5px"></a>
	</div>
	<div style="height:65px;width:65px;background-color:#F39C12" title="文章">
		<a href="http://upwill.cn/login/article"><img src="../imgs/article.png" style="padding-top:16.5px;padding-left:16.5px"></a>
	</div>
	<div style="height:65px;width:65px;background-color:#E74C3C" title="资源">
		<a href="http://upwill.cn/login/source"><img src="../imgs/source.png" style="padding-top:16.5px;padding-left:16.5px"></a>
	</div>
	<div style="height:65px;width:65px;background-color:#2ECC71" title="随笔">
		<a href="http://upwill.cn/login/suibi"><img src="../imgs/suibi.png" style="padding-top:16.5px;padding-left:16.5px"></a>
	</div>
	<div style="height:65px;width:65px;background-color:#34495E" title="链接">
		<a href="http://upwill.cn/login/lianjie"><img src="../imgs/lianjie.png" style="padding-top:16.5px;padding-left:16.5px"></a>
	</div>
</div>

<div style="margin-left:65px;padding-top:55px">
	
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
</script>
</body>
</html>