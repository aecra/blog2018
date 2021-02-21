<?php
	if(empty($_GET["content"])){
		echo "您未输入任何文字";
		exit();
	}else{
		$content = htmlentities($_GET["content"]);
		include './config.php';
		//连接数据库，返回数据库连接句柄
		$link = mysqli_connect($mysql_root, $mysql_admin, $mysql_password, $mysql_db);
		//判断是否连接成功
		if (!$link) { //返回NULL
		    echo '数据库连接失败，错误代码：', mysqli_connect_erron(), "<br>";
		} else {
		    mysqli_set_charset($link, 'utf8'); //必须设置编码

		    $sql = "select * from article where `title` LIKE "."\"%".$content."%\""." or `tab` LIKE "."\"%".$content."%\""." order by time desc";
		    $result = mysqli_query($link, $sql);
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
		   }
		    mysqli_close($link); //关闭数据库连接
		    
		}
	}