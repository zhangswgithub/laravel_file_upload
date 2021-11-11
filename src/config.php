<?php
return [
    // 阿里云OSS
    'aliyun_oss' => [
        'AccessKeyID'     => env('ALI_AccessKeyID', 'AccessKeyID'),
        'AccessKeySecret' => env('ALI_AccessKeySecret', 'AccessKeySecret'),
        // 地域节点
        'EndPoint'        => env('ALI_EndPoint', 'EndPoint'),
        // Bucket 名称
        'Bucket'          => env('ALI_Bucket', 'Bucket'),
        // 访问域名
        'Host'            => env('ALI_Aliyun_Host', 'Host'),
    ],

    // 七牛云 kodo
    'qiniu_kodo' => [
        'AccessKeyID'     => env('QINIU_AccessKeyID', 'AccessKeyID'),
        'AccessKeySecret' => env('QINIU_AccessKeySecret', 'AccessKeySecret'),
        'Bucket'          => env('QINIU_Bucket', 'Bucket'),
        // 访问域名
        'Host'            => env('QINIU_Host', 'Host'),
    ],

    // 腾讯 Cos
    'tx_cos' => [
        'AccessKeyID'     => env('TX_AccessKeyID', 'AccessKeyID'),
        'AccessKeySecret' => env('TX_AccessKeySecret', 'AccessKeySecret'),
        'Bucket'          => env('TX_Bucket', 'Bucket'),
        // bucket 地域
        'Region'          => env('TX_Region', 'Region'),
        // 访问域名
        'Host'            => env('TX_Host', 'Host'),
    ],
];
