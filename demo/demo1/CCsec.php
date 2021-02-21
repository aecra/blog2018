<?php
// CC攻击防御核心模块 版本 v.01 beta版本
/*
 * 幽灵网安版权所有 http://www.wghostk.com
 * 一手原创.独创内核.
 */

// 不支持cookie,只能通过url验证咯。 具体怎么写你自己看着办。
/* 给个提示 <?php print session_name() ?>=<?php print session_id() ?>"> */
require_once ('/web_config/websfe_config.php');

if (!isset($_SESSION['CChacker'])){
	// cc攻击验证
	$CC_NO = CC_white();
	if ($CC_sec == '1' && $CC_NO != $CCsec_white){
		// $cheak = cheakget();
		if (cheakget()){
			// 如果浏览器不支持 cookie,那就只能通过get传值方法,怎么写请 www.baidu.com
			cheak ();
			// echo $_SERVER["HTTP_USER_AGENT"];
			return;
		}else{
			// 如果浏览器未知,则可能是GET空请求！
			echo '
            <HTML><HEAD><TITLE>提示：点击继续访问</TITLE>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<META content="text/html; charset=unicode" http-equiv=Content-Type></HEAD>
            <BODY>
            <P>提示：您看起来不像普通浏览器,请</P>
            <form id="form" name="form" method="post" action=""/>
            <P><INPUT type=submit value=点击继续访问 name=submit></P></BODY></HTML>
            </form>';
			if (isset ( $_POST ['submit'] ) && $_POST ['submit']) {
				$_SESSION ['CChacker'] = "OKSEC";
				echo '<script type="text/javascript">windowl.location.href=window.location.href;</script>';
			}
			exit();
		}
	}
if ($CC_sec == '2' && $CC_NO != $CCsec_white){
		echo '
            <HTML><HEAD><TITLE>提示：点击继续访问</TITLE>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<META content="text/html; charset=unicode" http-equiv=Content-Type></HEAD>
            <BODY>
            <P>提示：当前网站压力大,请</P>
            <form id="form" name="form" method="post" action=""/>
            <P><INPUT type=submit value=点击继续访问 name=submit5></P></BODY></HTML>
            </form>';
		if (isset ( $_POST ['submit5'] ) && $_POST ['submit5']) {
			$_SESSION ['CChacker'] = "OKSEC0123456789";
			echo '<script type="text/javascript">windowl.location.href=window.location.href;</script>';
		}
		exit();
	
   }
}

if (!isset ( $_COOKIE ['yesIhave'] )) {
	setcookie ( "yesIhave", "yesIhave" );
}

// 如果不支持cookie
if ($CC_nocookie = false) {
	if (isset ( $_COOKIE ['yesIhave'] ) && $_COOKIE ['yesIhave'] == 'yesIhave') {
		echo '
            <HTML><HEAD><TITLE>您的浏览器不支持cookie！</TITLE>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<META content="text/html; charset=unicode" http-equiv=Content-Type></HEAD>
            <BODY>
            <P>提示：您的浏览器看起来不支持cookie,请</P>
            <form id="form" name="form" method="post" action=""/>
            <P><INPUT type=submit value=点击继续访问 name=submit3></P></BODY></HTML>
            </form>';
		if (isset ( $_POST ['submit3'] ) && $_POST ['submit3']) {
			$CC_nocookie = true;
			echo '<script type="text/javascript">windowl.location.href=window.location.href;</script>';
		}
		exit ();
	}
}
function cheakget() {
	$agent = $_SERVER ["HTTP_USER_AGENT"];
	if (strpos ( $agent, 'MSIE' ) !== false || strpos ( $agent, 'rv:11.0' )) {
		return true;
	} // ie11判断
	if (strpos ( $agent, "MSIE 8.0" )) {
		return true;
	}
	if (strpos ( $agent, "MSIE 7.0" )) {
		return true;
	}
	if (strpos ( $agent, "MSIE 6.0" )) {
		return true;
	}
	if (strpos ( $agent, "Firefox/3" )) {
		return true;
	}
	if (strpos ( $agent, "Firefox/2" )) {
		return true;
	}
	if (strpos ( $agent, "Chrome" )) {
		return true;
	}
	if (strpos ( $agent, "Safari" )) {
		return true;
	}
	if (strpos ( $agent, "Opera" )) {
		return true;
	}
	return false;
}
function cheak() {
	$cur_time = time ();
	$ACC = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>提示：点击继续访问</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META content="text/html; charset=unicode" http-equiv=Content-Type>
</HEAD>
<BODY>
<P>刷新过于频繁,请:</P>
<form id="form" name="form" method="post" action=""/>
<P><INPUT type=submit value=点击继续访问 name=submit1></P></BODY></HTML>
</form>
';
	if (isset ( $_POST ['submit1'] ) && $_POST ['submit1']) {
		$_SESSION ['refresh_times'] = 0;
		$_SESSION ['last_time'] = $cur_time;
		echo '<script type="text/javascript">windowl.location.href=window.location.href;</script>';
	}
	
	$seconds = '10'; // 时间段[秒]
	$refresh = '7'; // 刷新次数
	
	if (isset ( $_SESSION ['last_time'] )) {
		$_SESSION ['refresh_times'] += 1;
	} else {
		$_SESSION ['refresh_times'] = 1;
		$_SESSION ['last_time'] = $cur_time;
	}
	
	if ($cur_time - $_SESSION ['last_time'] < $seconds) {
		if ($_SESSION ['refresh_times'] >= $refresh) {
			// 处理
			echo $ACC;
			exit ();
		}
	} else {
		$_SESSION ['refresh_times'] = 0;
		$_SESSION ['last_time'] = $cur_time;
	}
}
function CC_white()
{
    $phpself=substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
    return $phpself;
}
?>