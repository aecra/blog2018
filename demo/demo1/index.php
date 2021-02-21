<?php
/*幽灵 PHP web 防火墙
 * @copyright  http://www.wghostk.com
 * @QQ 1296564236
 */
//包含配置文件
define('CHECK', true);
require_once('/web_config/websfe_config.php');
// 主功能
$sbIP = GetIP();
if ($sbIP != "FUCK"){
	if(check_spider($sbIP,$_SERVER['HTTP_USER_AGENT']) == false){
		//先进行CC攻击验证
		if($CC_sec != '0'){
		require_once('/CCsec.php');
		}
		require_once('/websafe/index.php');
		//进行参数过滤

	}else{
		//什么都不要写,thanks :)
		require_once('/websafe/index.php');
		return;
	}
}else{
	echo '警告,本网站的防火墙无法取得您的真实IP,可能是防火墙版本太老！请联系管理员 ：'.$adminsbQQ;
}
 //内核模块 版本 v0.1 demo版本
 
 /*
 //原本是判断爬虫ua的，不过不准确，就换成IP反向解析了
 function is_crawler() { 
    $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']); 
    $spiders = array( 
        'Googlebot', // Google 爬虫 
        'Baiduspider', // 百度爬虫 
        'Yahoo! Slurp', // 雅虎爬虫 
        'YodaoBot', // 有道爬虫 
        'msnbot' // Bing爬虫 
        // 更多爬虫关键字 
    ); 
    foreach ($spiders as $spider) { 
        $spider = strtolower($spider); 
        if (strpos($userAgent, $spider) !== false) { 
            return true; 
        } 
    } 
    return false; 
} 
*/




/*
-------------------------------------------------------------------------------------
*/
/*  检查是否为真蜘蛛，通过反向代解析IP判断蜘蛛真实性。
 * (check_spider($sbIP,$_SERVER['HTTP_USER_AGENT']));
 * @copyright  http://www.wghostk.com
 * @QQ 1296564236
 * @param string $ip IP地址
 * @param string $ua ua地址
 * @return false  false检测失败不在指定列表中
 */
function check_spider($ip,$ua)
{
    static $spider_list=array(
    'google'=>array('Googlebot','googlebot.com'),
    'baidu'=>array('Baiduspider','.baidu.'),
    'yahoo'=>array('Yahoo!','inktomisearch.com'),
    'msn'=>array('MSNBot','live.com'),
    'bing'=>array('bingbot','msn.com')
    );
 
    if(!preg_match('/^(\d{1,3}\.){3}\d{1,3}$/',$ip)) return false;
    if(empty($ua)) return false;
 
    foreach ($spider_list as $k=>$v)
    {
        ///如果找到了
        if(stripos($ua,$v[0])!==false)
        {
            $domain = gethostbyaddr($ip);
 
            if($domain && stripos($domain,$v[1])!==false)
            {
                return true;
            }
        }
    }
    return false;
}



function GetIP(){ 
if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
$ip = getenv("HTTP_X_FORWARDED_FOR"); 
else if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
$ip = getenv("HTTP_CLIENT_IP"); 
else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
$ip = getenv("REMOTE_ADDR"); 
else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
$ip = $_SERVER['REMOTE_ADDR']; 
else 
$ip = "FUCK"; 
return($ip); 
} 

?>