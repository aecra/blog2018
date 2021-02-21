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
    <link rel="stylesheet" type="text/css" href="../background.css">
    <script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
    <script src="../layer/layer.js"></script>
	<title>文芥博客后台管理</title>
</head>
<body style="margin:0">
<?php
include '../common.php';
?>

<div style="margin-left:65px;padding-top:55px">
	<div style="margin: 20px;">
		
        <div id="addblock">
            <a href="photo-add.php?ID=<?php echo $_GET['ID']; ?>" id="addblockfont">我有新的图片</a>
        </div>
        <br>
        <br>
        <!--
        <div style="width: 100px;height: 30px;text-align: center;background: rgb(255,255,255);">
            <a href="delete.php?ID=<?php echo $_GET['ID']; ?>">删除相册</a>
        </div>
    -->
		<h2>&nbsp;&nbsp;&nbsp;图片列表</h2>
        <div style="width: 80%"> 

            <?php
                require '../utf8-php/php/sdk/vendor/autoload.php';

                $cosClient = new Qcloud\Cos\Client(array(
                'region' => 'ap-beijing',
                'credentials' => array(
                    'secretId' => $tencent_secretId,
                    'secretKey' => $tencent_secretKey,
                    ),
                ));

                $bucket = 'web-1255835707';
                $ID=$_GET['ID'];

                echo '<div id="photoup">';

                try {
                    $result = $cosClient->listObjects(array(
                        'Bucket' => $bucket,
                        'Prefix' => 'upload/album/'.$ID.'_min/'
                        ));
                    foreach ($result['Contents'] as $rt) {
                        if($rt['Key']!='upload/album/'.$ID.'_min/'){
                            $oldsrc=str_replace('_min', '', $rt['Key']);
                            ?>

                            <div id="photo">
                                <img <?php echo 'layer-src="http://show.upwill.cn/'.$oldsrc.'" src="http://show.upwill.cn/'.$rt['Key']; ?>" style="width:100%"/>
                                <div id="operate">
                                    <a <?php echo 'href="photo-delete.php?path='.$rt['Key'].'&ID='.$ID; ?>">删除</a>
                                </div>
                            </div>

                            <?php
                        }
                    }
                } catch (\Exception $e) {
                    echo "程序出错！";
                }
                echo '</div>';
            ?>  
        </div> 

	</div>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
	
    function sumbit_sure(){
        var gnl=confirm("确定要执行吗？");
        if (gnl==true){
            return true;
        }else{
            return false;
        }
    }

    //相册集查看
    layer.photos({
        photos: '#photoup'
    }); 
</script>
</body>
</html>