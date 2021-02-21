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
        $ID = $_POST['ID'];

        for($i = 0;$i < count($_FILES['file']['name']);$i = $i + 1 ){
            $name = $_FILES['file']['name'][$i];
            $time = time();
            $path = $_FILES['file']['tmp_name'][$i];
            $type = pathinfo($_FILES['file']['name'][$i])['extension'];
            $typemap = array("png", "jpg", "jpeg", "gif", "bmp");
            if(in_array($type, $typemap)){
                $name=ChangeName();
                $name=$name.".".$type;
                $to='upload/album/'.$ID.'/';
                upload_all($to.$name,$path);

                //缩略图上传
                $thumbnail_to='upload/album/'.$ID.'_min/';
                upload_string($thumbnail_to.$name,imagepress($path,600,400));
            }
        }
        
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

    function imagepress($filepath, $new_width, $new_height)
            {
            $source_info   = getimagesize($filepath);
            $source_width  = $source_info[0];
            $source_height = $source_info[1];
            $source_mime   = $source_info['mime'];
            $source_ratio  = $source_height / $source_width;
            $target_ratio  = $new_height / $new_width;
            // 源图过高
            if ($source_ratio > $target_ratio)
            {
                $cropped_width  = $source_width;
                $cropped_height = $source_width * $target_ratio;
                $source_x = 0;
                $source_y = ($source_height - $cropped_height) / 2;
            }
            // 源图过宽
            else if ($source_ratio < $target_ratio)
            {
                $cropped_width  = $source_height / $target_ratio;
                $cropped_height = $source_height;
                $source_x = ($source_width - $cropped_width) / 2;
                $source_y = 0;
            }
            // 源图适中
            else
            {
                $cropped_width  = $source_width;
                $cropped_height = $source_height;
                $source_x = 0;
                $source_y = 0;
            }
            switch ($source_mime)
            {
                case 'image/gif':
                    $source_image = imagecreatefromgif($filepath);
                    break;
                case 'image/jpeg':
                    $source_image = imagecreatefromjpeg($filepath);
                    break;
                case 'image/png':
                    $source_image = imagecreatefrompng($filepath);
                    break;
                default:
                    return false;
                    break;
            }
            $target_image  = imagecreatetruecolor($new_width, $new_height);
            $cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);
            // 裁剪
            imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
            // 缩放
            imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $new_width, $new_height, $cropped_width, $cropped_height);
            //header('Content-Type: image/jpeg');
            imagejpeg ($target_image,'var.jpg');
            $string=file_get_contents('var.jpg');
            unlink('var.jpg');
            return $string;
        }
    ?>

    <?php
        echo '<meta http-equiv="refresh" content="0.001;url=photo-list.php?ID='.$ID.'">';
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