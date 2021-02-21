<?php
	setcookie("admin",'',time()-200);
    setcookie("password",'',time()-200);
    echo 'fail'.'<meta http-equiv="refresh" content="0.01;url=http://upwill.cn/login/login.html">';
?>