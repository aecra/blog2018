<?php
session_start ();
//幽灵web应用层防火墙配置文件
//拦截开关(1为开启，0关闭)
$webscan_switch=1;
//提交方式拦截(1开启拦截,0关闭拦截,post,get,cookie,referre选择需要拦截的方式)
$webscan_post=1;
$webscan_get=1;
$webscan_cookie=1;
$webscan_referre=1;
//后台白名单,后台操作将不会拦截,添加"|"隔开白名单目录下面默认是网址带 admin  /dede/ 放行
$webscan_white_directory='admin|\/dede\/';
//url白名单,可以自定义添加url白名单,默认是对phpcms的后台url放行
//写法：比如phpcms 后台操作url index.php?m=admin php168的文章提交链接post.php?job=postnew&step=post ,dedecms 空间设置edit_space_info.php
$webscan_white_url = array('index.php' => 'm=admin','post.php' => 'job=postnew&step=post','edit_space_info.php'=>'');
//其他设置
$adminsbQQ = '1296564236'; //管理员QQ
$CCsec_white = 'api.php'; //cc攻击白名单 建议是api接口.默认是所有api.php页面都会放行,只支持一个.
$CC_sec = '1'; 
//cc攻击防御 详解（不会影响API接口）:  
// 0 不开防御 
// 1 - 普通模式,非蜘蛛会检查浏览器完整性,如果不完整判断为get空请求的则会进入检查页面.有效拦截GET洪水！
// 要注意的是,默认情况下浏览器必须启用cookie才能进入网站！
// 2 - 强力模式,非蜘蛛第一次进入检查页面.之后不会
//CC防御规则.默认是 10秒内刷新7次弹出验证码.请自己去CCsec.php修改！
?>