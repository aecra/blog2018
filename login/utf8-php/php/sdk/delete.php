<?php
    
function delete_all($key){
    
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
    //$key = 'ss.txt';//存储通中的路径

    $condition=true;
    # 删除object
    ## deleteObject
    try {
        $result = $cosClient->deleteObject(array(
            'Bucket' => $bucket,
            'Key' => $key
            ));
        //print_r($result);
    } catch (\Exception $e) {
        $condition=false;
    }

    return $condition;
}
    