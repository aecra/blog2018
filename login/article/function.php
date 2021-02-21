<?php
function tabnum(){
            include '../config.php';
            $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
            mysqli_set_charset($link, 'utf8');//必须设置编码
            $sql = 'SELECT tab FROM article';
            $result = mysqli_query($link, $sql); //执行数据库语句,返回字符集
            $p=0;
            //抽出一维数组，并记录个数
            while ($row = mysqli_fetch_array($result)) {
                $tab[$p]=$row['tab'];
                $point[$p]=1;
                $p++;
            }
            //做标记，判重
            for($x=0;$x<$p;$x++){
                for($y=0;$y<$x;$y++){
                    if($tab[$x] == $tab[$y]){
                        $point[$x]=0;
                        break;
                    }
                }
            }
            $num=0;
            for($x=0;$x<$p;$x++){
                if($point[$x]==1){
                    $num=$num+1;
                }
            }
            echo $num;
            mysqli_free_result($result);//释放字符集空间
            mysqli_close($link);//关闭数据库连接
        }
        function authornum(){
            include '../config.php';
            $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
            mysqli_set_charset($link, 'utf8');//必须设置编码
            $sql = 'SELECT author FROM article';
            $result = mysqli_query($link, $sql); //执行数据库语句,返回字符集
            $p=0;
            //抽出一维数组，并记录个数
            while ($row = mysqli_fetch_array($result)) {
                $tab[$p]=$row['author'];
                $point[$p]=1;
                $p++;
            }
            //做标记，判重
            for($x=0;$x<$p;$x++){
                for($y=0;$y<$x;$y++){
                    if($tab[$x] == $tab[$y]){
                        $point[$x]=0;
                        break;
                    }
                }
            }
            $num=0;
            for($x=0;$x<$p;$x++){
                if($point[$x]==1){
                    $num=$num+1;
                }
            }
            echo $num;
            mysqli_free_result($result);//释放字符集空间
            mysqli_close($link);//关闭数据库连接
        }
        function articlenum(){
            include '../config.php';
            $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
            mysqli_set_charset($link, 'utf8');//必须设置编码
            echo mysqli_num_rows(mysqli_query($link, "select ID from article"));
            mysqli_close($link);//关闭数据库连接
        }
        function nowtime(){
        	echo '<script>
    			function ti(){
        			var myDate = new Date();

			        //获取当前小时数(0-23)
			        var h=myDate.getHours();

			        //获取当前分钟数(0-59)
			        var m=myDate.getMinutes();
			        if(m<10) m=\'0\'+m;

			        //获取秒数
			        var s=myDate.getSeconds();
			        if(s<10) 
			        	s = \'0\' + s;
			        document.getElementByClass("nowtime").innerHTML=(h+":"+m+":"+s);
			        window.setTimeout("ti()",1000);
			    }

			    window.setTimeout("ti()",100);
			</script>';
        }
?>