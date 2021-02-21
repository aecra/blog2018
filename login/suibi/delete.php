<meta charset="UTF-8">
<link rel="icon" type="image/gif" href="../tupian/ioc.png" >
<?php
    include '../config.php';
    include '../cheack.php';
    ?>
<?php
    //连接数据库，返回数据库连接句柄
    $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
    //判断是否连接成功
    if(!$link){//返回NULL
        echo '数据库连接失败，错误代码：',mysqli_connect_erron(),"<br>";
    }
    else {
        mysqli_set_charset($link, 'utf8');//必须设置编码

        if(htmlspecialchars($_GET['page'])==1){//文章
            $sql = 'select ID FROM article WHERE ID = '.$_POST['ID'];
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            $filename = '../../article/'.$row['ID'].'/'; 

            function deldir($dir) {
            //先删除目录下的文件：  
            $dh = opendir($dir);
            while ($file = readdir($dh)) {  
                if($file != "." && $file!="..") {  
                $fullpath = $dir."/".$file;  
                if(!is_dir($fullpath)) {  
                    unlink($fullpath);  
                } else {  
                    deldir($fullpath);  
                }  
                }  
            }  
            closedir($dh);  
            rmdir($dir);
        }
            deldir($filename); //删除文件 
            $sql = 'DELETE FROM article WHERE ID = '.$_POST['ID'];
        }

        if(htmlspecialchars($_GET['page'])==2){//随笔
            $sql = 'DELETE FROM suibi WHERE time = '.$_POST['time'];
        }

        if(htmlspecialchars($_GET['page'])==3){//链接
            $sql = 'DELETE FROM link WHERE time = '.$_POST['time'];
        }

        if(htmlspecialchars($_GET['page'])==4){//资源
            $sql = 'select ID FROM resource WHERE time = '.$_POST['time'];
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_array($result);
            $filename = '../../resource/'.$row['ID'].'/'; 

            function deldir($dir) {  
            //先删除目录下的文件：  
            $dh = opendir($dir);  
            while ($file = readdir($dh)) {  
                if($file != "." && $file!="..") {  
                $fullpath = $dir."/".$file;  
                if(!is_dir($fullpath)) {  
                    unlink($fullpath);  
                } else {  
                    deldir($fullpath);  
                }  
                }  
            }  
            closedir($dh);  
            $sql = 'DELETE FROM resource WHERE time = '.$_POST['time'];
            }
        }
        
        if($result = mysqli_query($link, $sql)){
            echo '<meta http-equiv="refresh" content="0.01;url=index.php">';
        }else{
            echo '<meta http-equiv="refresh" content="1;url=index.php">失败';
        }
        mysqli_close($link);//关闭数据库连接
    }
?>