<?php

require 'vendor/autoload.php';
    
    $cosClient = new Qcloud\Cos\Client(array(
    'region' => 'ap-beijing', #地域，如ap-guangzhou,ap-beijing-1
    'credentials' => array(
        'secretId' => '',
        'secretKey' => '',
        ),
    ));

    // 若初始化 Client 时未填写 appId，则 bucket 的命名规则为{name}-{appid} ，此处填写的存储桶名称必须为此格式
    $bucket = 'web-1255835707';
    //$key = 'st/phpunit.xml';//存储通中的路径
    //$local_path = "phpunit.xml";//上传的文件路径
try {
        $prefix = '';
        $marker = '';
        while (true) {
            $result = $cosClient->ListObjects(array(
                'Bucket' => $bucket,
                'Marker' => $marker,
                'MaxKeys' => 1000
                ));
            foreach ($result['Contents'] as $rt) {
                print_r($rt['Key'] . "<br>");
                /*
                 * 使用下面的代码可以删除全部object
                 */
                // try {
                //     $result = $cosClient->deleteobjects(array(
                //         'Bucket' => $bucket,
                //         'Key' => $rt['Key']));
                //     
                // } catch (\Exception $e) {
                //     
                // }
            }
            $marker = $result['NextMarker'];
            if (!$result['IsTruncated']) {
                break;
            }
        }
    } catch (\Exception $e) {
        
    }
        try {
        $result = $cosClient->listObjects(array(
            'Bucket' => $bucket,
            'Prefix' => 'upload/image/'
            ));
        foreach ($result['Contents'] as $rt) {
            //print_r($rt);
            print_r($rt['Key'] . "<br>");
        }
    } catch (\Exception $e) {
        
    }