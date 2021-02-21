<?php
    include 'background/config.php';
    //连接数据库，返回数据库连接句柄
    $link = mysqli_connect($mysql_root, $mysql_admin, $mysql_password, $mysql_db);
    //判断是否连接成功
    if (!$link){ //返回NULL
        echo '数据库连接失败';
        exit();
    }
    //必须设置编码
    mysqli_set_charset($link, 'utf8');

    //设置$page
    if(!isset($_GET["page"])){
        $page = 1;
    }else{
    	$page = $_GET["page"];
    }
    //正则匹配$page的正确性
    if(!preg_match("/^[1-9][0-9]*$/",$page)){
        echo '<meta http-equiv="refresh" content="0.001;url=./404.html">';
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
    <meta name="description" content="轮极熙域-追求简约" />
    <link rel="icon" type="image/gif" href="images/ioc.png" >
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <script src="js/jquery-3.1.1.js"></script>
	<script src="js/vue.js"></script>
    <title>
        轮极熙域-追求简约
    </title>
    
    <!-- upwill.cn Baidu tongji analytics -->
	<script>
		var _hmt = _hmt || [];
		(function() {
			var hm = document.createElement("script");
			hm.src = "https://hm.baidu.com/hm.js?4402a017ad6d45cf992d43da7c385bdc";
			var s = document.getElementsByTagName("script")[0];
			s.parentNode.insertBefore(hm, s);
		})();
	</script>

    <script type="text/javascript">
		//菜单按钮的处理
		function display_change(){
			if(document.getElementById("list").style.display == 'none'){
		    	document.getElementById("list").style.display = 'flex';
		    }else{
				document.getElementById("list").style.display = 'none';
		        }
		}
    </script>
</head>
<body>

<div id="head">
	<div id="icon">
    	<a href="./"><img src="./images/ioc.png"></a>
    </div>
    <div id="web_name">
    	轮极熙域
    </div>
    <div id="menu">
    	<img src="./images/menu.png"  onclick="display_change()" onmouseenter="display_change()">
    </div>
</div>

<div id="list" onmouseleave="display_change()">
	<div>
		<a href="./find.html">文章检索</a>
	</div>
	<div>
		<a href="./find.html">文章检索</a>
	</div>
	<div>
		<a href="./find.html">文章检索</a>
	</div>
</div>

<div id="lead">
	<a href="./"><img src="./images/ioc.png"></a>
	<div id="lead_content">
		轮极熙域&nbsp;&nbsp;-&nbsp;&nbsp;追求简约
		<p>
			一个属于自己的网络空间，分享学习、技术、新闻、热点、生活等乱七八糟的东西，也是一个默默奋斗的“收藏夹”。
		</p>
	</div>
</div>

<div id="article_lead">
    <p>-&nbsp;文章列表&nbsp;-</p>
</div>

<div id="article_list">
	<?php
		$total_records = mysqli_num_rows(mysqli_query($link, "select ID from article"));
	    $page_size = 10;
	    $total_pagas = ceil($total_records / $page_size);
	    if ($page > $total_pagas || $page <= 0) {
	        echo '<meta http-equiv="refresh" content="0.001;url=./404.html">';
	        exit();
	    }
	    $offset = ($page - 1) * $page_size;
	    //获取相应页数所需要显示的数据
	    $result = mysqli_query($link, "select * from article ORDER BY TIME DESC limit $offset,$page_size");
	    $point = $page;
	    while ($row = mysqli_fetch_array($result)) {
	        echo '<div id="block">';
			echo '<div id="tittle"><a href="'.'./article.php?page='.$row['ID'].'">'.$row["title"].'</a></div>';
			echo '<div id="abstract">';
			echo '<img src="'.$row["abstract"].'">';
			echo '<div id="abstract_content">';
			echo mb_substr(strip_tags($row["content"]) , 0 , 80, 'utf-8')."……";
			echo '<div id="block_details">时间：'.date('Y-m-d',$row["time"]).'  作者：'.$row["author"].'  标签：'.$row["tab"].'</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
	        $point = $point + 1;
	    }
	?>
	<div id="page_change">
		<a href="./?page=<?php echo ($page-1>0)?($page-1):1; ?>"><div id="page_up">上一页</div></a>
		<div id="page_view">
			第<?php echo $page; ?>页&nbsp&nbsp&nbsp&nbsp共<?php echo $total_pagas; ?>页
		</div>
		<a href="./?page=<?php echo ($page+1<=$total_pagas)?($page+1):$total_pagas; ?>"><div id="page_down">下一页</div></a>
	</div>
</div>

<br>

<div style="background-color: #2E3033;line-height: 10px;padding: 0;width: 100%;position: inherit;bottom: 0px;border-top-width: 5px;border-top-color: black" align="center">
    <br>
        <div style="right:5%;color: #eaeaec;font-size: 12px">
            © 2018-2019 upwill.cn 版权所有 | ICP备案号：<a href="http://www.miitbeian.gov.cn/" style="color: white;text-decoration:none;" target="_blank">冀ICP备18006040号-1</a>|
                <a target="_blank" href="http://www.beian.gov.cn/portalregisterSystemInfo?recordcode=13018402000194" style="display:inline-block;text-decoration:none;height:20px;color: #eaeaec">
                    <img src="./images/beian.png">
                    冀公网安备 13018402000194号
                </a>
        </div>
        <br>
    </div>
</div>
</body>
</html>
<?php
    mysqli_close($link); //关闭数据库连接
?>