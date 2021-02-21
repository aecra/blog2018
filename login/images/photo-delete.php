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
include '../utf8-php/php/sdk/delete.php';
?>

<div style="margin-left:65px;padding-top:55px">
    <?php
        $path=$_GET['path'];
        delete_all($path);
        $path=str_replace('_min', '', $path);
        delete_all($path);
    ?>
    <?php
        echo '<meta http-equiv="refresh" content="0.001;url=photo-list.php?ID='.$_GET['ID'].'">';
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