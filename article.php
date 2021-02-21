<?php
    include 'background/config.php';
    //连接数据库，返回数据库连接句柄
    $link = mysqli_connect($mysql_root, $mysql_admin, $mysql_password, $mysql_db);
    //判断是否连接成功
    if (!$link) { //返回NULL
        echo '数据库连接失败，错误代码：', mysqli_connect_erron(), "<br>";
    } else {
        mysqli_set_charset($link, 'utf8'); //必须设置编码
        if(!isset($_GET["page"])){
            echo '<meta http-equiv="refresh" content="0.001;url=./404.html">';
            exit();
        }
        $page = $_GET["page"];
        if(preg_match("/^[1-9][0-9]*$/",$page)){
            $sql = "select * from article where ID=".$page;
            $result = mysqli_query($link, $sql);
            $build = mysqli_fetch_array($result);
            if(!isset($build["title"])){
                echo '<meta http-equiv="refresh" content="0.001;url=./404.html">';
                exit();
            }
        }else{
            echo '<meta http-equiv="refresh" content="0.001;url=./404.html">';
            exit();
        }

        mysqli_close($link); //关闭数据库连接
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0，user-scalable=no">
    <meta name="description" content="轮极熙域-追求简约" />
    <link rel="icon" type="image/gif" href="images/ioc.png" >
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link  rel="stylesheet" type="text/css" href="login/utf8-php/third-party/SyntaxHighlighter/shCoreDefault.css">
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/vue.js"></script>
    <script src="login/utf8-php/third-party/SyntaxHighlighter/shCore.js"></script>
    <title>
        <?php echo $build["title"].' - 轮极熙域';  ?>
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
        window.onload = function(){
            var table_all = document.getElementsByTagName("table");
            for(var i = 0; i < table_all.length; i ++){
                table_all[i].style.width = "100%";
                table_all[i].width = "100%";
            }

            var pre_all = document.getElementsByTagName("pre");
            for(var i = 0; i < pre_all.length; i ++){
                pre_all[i].style.width = "100%";
                pre_all[i].width = "100%";
                pre_all[i].style.overflow = "scroll";
            }

            var article = document.getElementById("article");
            var img_article = article.getElementsByTagName("img");
            for(var i = 0; i < img_article.length; i ++){
                img_article[i].style.maxWidth = "100%";
                img_article[i].style.width = "auto";
            }
        };
        //菜单按钮的处理
        function display_change(){
            if(document.getElementById("list").style.display == 'none'){
                document.getElementById("list").style.display = 'flex';
            }else{
                document.getElementById("list").style.display = 'none';
                }
        }
    </script>

    <script type="text/javascript">
        if(window.screen.width>1000){
            SyntaxHighlighter.all();
        }
    </script>

    <style>
        pre{
            width: 100%;
            overflow: scroll;
        }
    </style>
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

<div id="article">
    <?php
        echo '<div id="article_title">'.$build["title"].'</div>';
        echo '<div id="article_details">时间：'.date('Y-m-d',$build["time"]).'  作者：'.$build["author"].'  标签：'.$build["tab"].'</div><br>';
        echo '<img id="article_img" src="'.$build["abstract"].'">';
        echo $build["content"];
    ?>
</div>

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