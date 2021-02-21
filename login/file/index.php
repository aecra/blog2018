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

<div style="margin-left:65px;padding-top:55px">
	<div style="margin: 20px;">
		
        <div id="addblock"><a href="add.php" id="addblockfont">我有新的文件</a></div>

		<h2>&nbsp;&nbsp;&nbsp;文件列表</h2>
        <table style="width: 80%" class="table"> 
            <thead> 
                <tr> 
                    <th>文件名称</th>
                    <th>添加时间</th>
                    <th>简介</th>
                    <th>操作</th> 
                </tr> 
            </thead> 

            <?php
                $sql = 'SELECT * FROM file ORDER BY TIME DESC ';
                $result = mysqli_query($link, $sql);//执行数据库语句,返回字符集
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';

                    echo '<td>'.$row['name']."</td>";

                    echo '<td>'.date('Y-m-d',$row['time'])."</td>";

                    echo '<td>'.$row['abstract']."</td>";

                    echo '<td><a target="target" href="'.$row['down'].'">下载</a><a target="target" href="delete.php?path='.$row['down'].'&ID='.$row['ID'].'">&nbsp;删除</a></td>';

                    echo "</tr>";
            }
            mysqli_free_result($result);//释放字符集空间
            mysqli_close($link);//关闭数据库连接
        }
        ?>
        </table> 

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