<?php
        $admin = htmlspecialchars($_COOKIE["admin"]);
        $password = htmlspecialchars($_COOKIE["password"]);

        include 'config.php';
        //连接数据库，返回数据库连接句柄
        $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
        //必须设置编码
        mysqli_set_charset($link, 'utf8');

        $sql = 'SELECT * FROM admin';

        $point = 0;

        $result = mysqli_query($link, $sql);//执行数据库语句,返回字符集
        while ($row = mysqli_fetch_array($result)) {
                if($admin == $row['admin']&& $password == $row['password']) {
                    $point = 1;
                    break;
                }
        }
        if($point == 0){
            echo 'fail'.'<meta http-equiv="refresh" content="0.01;url=http://upwill.cn/login">';
            exit;
        }else{
            setcookie("admin",$admin,time()+3600);
            setcookie("password",$password,time()+3600);
        }
        mysqli_close($link);//关闭数据库连接
?>