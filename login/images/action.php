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
include '../utf8-php/php/sdk/upload.php';
?>

<div style="margin-left:65px;padding-top:55px">
    <?php
        function ChangeName(){
            $format="{time}{rand:6}";
            //替换日期事件
            $t = time();
            $d = explode('-', date("Y-y-m-d-H-i-s"));
            $rand=rand();
            while($rand<100000){
                $rand=rand()*rand();
            }
            while($rand>1000000){
                $rand=floor($rand/10);
            }
            $format = str_replace("{time}", $t, $format);
            $format = str_replace("{rand:6}", $rand, $format);
            $format = str_replace("{yyyy}", $d[0], $format);
            $format = str_replace("{yy}", $d[1], $format);
            $format = str_replace("{mm}", $d[2], $format);
            $format = str_replace("{dd}", $d[3], $format);
            return $format;
        }

        //连接数据库，返回数据库连接句柄
        $link = mysqli_connect($mysql_root,$mysql_admin,$mysql_password,$mysql_db);
        //判断是否连接成功
        if (!$link) { //返回NULL
            echo '数据库连接失败，错误代码：', mysqli_connect_erron(), "<br>";
        } else {
            mysqli_set_charset($link, 'utf8'); //必须设置编码
            $photoname = $_FILES['img']['name'];
            $time = time();
            $path = $_FILES['img']['tmp_name'];
            $type = pathinfo($_FILES['img']['name'])['extension'];
            $typemap = array("png", "jpg", "jpeg", "gif", "bmp");

            $abstract = $_POST['abstract'];
            $albumname = $_POST['name'];

            if(in_array($type, $typemap)){
                $photoname=ChangeName();
                $photoname=$photoname.".".$type;
                $to="upload/album/images/";
                upload_all($to.$photoname,$path);
                $sql = "select ID from album ORDER BY ID DESC";
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_array($result);
                $ID = $row['ID'] + 1;

                $imgsrc='http://show.upwill.cn/'.$to.$photoname;
                $sql = 'insert `album`(`ID`,`name`,`abstract`,`time`,`imgsrc`) values('.$ID.' ,\''.$albumname.'\',\''.$abstract.'\','.$time.',\''.$imgsrc.'\')';
                //$sql = "INSERT INTO article VALUES('$ID' ,'$photoname','$abstract','$time','$imgsrc')";
                $result = mysqli_query($link, $sql);

            }else{
                $result = 0;
            }

            mysqli_close($link); //关闭数据库连接
            
        }
        ?>

    <div style="width:300px;margin-top:30px;margin-left:20px;text-align:center;box-shadow:2px 2px 20px rgb(200,200,200)">
    <h3>提交结果</h3>
    <hr>

    <?php
        if ($result) {
            echo '提交成功<br><meta http-equiv="refresh" content="1;url=index.php">';
        } else {
            echo '提交失败<br>';
        }
    ?>
<br>
</div>

<script type="text/javascript">
    setInterval(function(){
        var leftlead = document.getElementById("leftlead");
        leftlead.style.height= window.innerHeight - 55 +"px";
    }, 100);
</script>
</body>
</html>
