<?php

function upload_all($key,$local_path){

    require 'vendor/autoload.php';
    
    $cosClient = new Qcloud\Cos\Client(array(
    'region' => 'ap-beijing', #地域，如ap-guangzhou,ap-beijing-1
    'credentials' => array(
        'secretId' => '',
        'secretKey' => '',
        ),
    ));

    $bucket = 'web-1255835707';
    //$key = 'st/phpunit.xml';//存储通中的路径
    //$local_path = "phpunit.xml";//上传的文件路径

    # 上传文件
	## putObject(上传接口，最大支持上传5G文件)

	### 上传文件流
	try {
	    $result = $cosClient->putObject(array(
	        'Bucket' => $bucket,
	        'Key' => $key,
	        'Body' => fopen($local_path, 'rb')));
	} catch (\Exception $e) {
	}
    return true;
}

function upload_string($key,$string){
    require 'vendor/autoload.php';
    
    $cosClient = new Qcloud\Cos\Client(array(
    'region' => 'ap-beijing', #地域，如ap-guangzhou,ap-beijing-1
    'credentials' => array(
        'secretId' => '',
        'secretKey' => '',
        ),
    ));

    $bucket = 'web-1255835707';
    //$key = 'st/phpunit.xml';//存储通中的路径
    //$local_path = "phpunit.xml";//上传的文件路径

    # 上传文件
    ## putObject(上传接口，最大支持上传5G文件)
    ### 上传内存中的字符串
    try {
        $result = $cosClient->putObject(array(
            'Bucket' => $bucket,
            'Key' => $key,
            'Body' => $string));
        //print_r($result);
    } catch (\Exception $e) {
        //echo "$e\n";
    }

    return true;
}

function upload_handle($key,$handle){

    require 'vendor/autoload.php';
    
    $cosClient = new Qcloud\Cos\Client(array(
    'region' => 'ap-beijing', #地域，如ap-guangzhou,ap-beijing-1
    'credentials' => array(
        'secretId' => '',
        'secretKey' => '',
        ),
    ));

    $bucket = 'web-1255835707';
    //$key = 'st/phpunit.xml';//存储通中的路径
    //$local_path = "phpunit.xml";//上传的文件路径

    # 上传文件
    ## putObject(上传接口，最大支持上传5G文件)

    ### 上传文件流
    try {
        $result = $cosClient->putObject(array(
            'Bucket' => $bucket,
            'Key' => $key,
            'Body' => $handle));
    } catch (\Exception $e) {
    }
    return true;
}