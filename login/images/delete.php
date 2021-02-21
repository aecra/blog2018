<?php
include '../config.php';
include '../cheack.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="http://upwill.cn/tupian/ioc.png" >
	<title>文芥博客后台管理</title>
</head>
<body style="margin:0">

<?php
include '../common.php';
include '../utf8-php/php/sdk/delete.php';
?>

<div style="margin-left:65px;padding-top:55px">
    <?php
        //连接数据库，返回数据库连接句柄
        $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
        //判断是否连接成功
        if(!$link){//返回NULL
            echo '数据库连接失败，错误代码：',mysqli_connect_erron(),"<br>";
        }
        else {
            mysqli_set_charset($link, 'utf8');//必须设置编码
            $album_ID = $_GET['ID'];
            $condition = 1;

            require '../utf8-php/php/sdk/vendor/autoload.php';

            $cosClient = new Qcloud\Cos\Client(array(
            'region' => 'ap-beijing', #地域，如ap-guangzhou,ap-beijing-1
            'credentials' => array(
                'secretId' => $tencent_secretId,
                'secretKey' => $tencent_secretKey,
                ),
            ));

            $bucket = 'web-1255835707';

            try {
                $result = $cosClient->listObjects(array(
                    'Bucket' => $bucket,
                    'Prefix' => 'upload/album/'.$album_ID.'/'
                    ));
                foreach ($result['Contents'] as $rt) {
                    //print_r($rt);
                    delete_all($rt['Key']);
                }
            } catch (\Exception $e) {
                echo $condition = 0;
            }

            try {
                $result = $cosClient->listObjects(array(
                    'Bucket' => $bucket,
                    'Prefix' => 'upload/album/'.$album_ID.'_min/'
                    ));
                foreach ($result['Contents'] as $rt) {
                    //print_r($rt);
                    delete_all($rt['Key']);
                }
            } catch (\Exception $e) {
                echo $condition = 0;
            }

            if($condition){
                $sql = 'DELETE FROM album WHERE ID = '.$album_ID;
                $result = mysqli_query($link, $sql);
            }
        }
    ?>
    <?php
        echo '<meta http-equiv="refresh" content="0.001;url=index.php">';
    ?>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
</script>
</body>
</html>