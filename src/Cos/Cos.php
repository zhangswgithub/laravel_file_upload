<?php

namespace File\Upload\Cos;

use Qcloud\Cos\Client;

class Cos
{
    private $AccessKeyID;
    private $AccessKeySecret;
    private $Bucket;
    private $Region;

    public function __construct()
    {
        // 获取Cos参数值
        $this->AccessKeyID     = config('upload.tx_cos.AccessKeyID');
        $this->AccessKeySecret = config('upload.tx_cos.AccessKeySecret');
        $this->Bucket          = config('upload.tx_cos.Bucket');
        $this->Region          = config('upload.tx_cos.Region');
        $this->Host            = config('upload.tx_cos.Host');
    }

    /***
     * 上传文件
     * @param $LocalFileName 本地文件绝对路径
     * @param $FileName 上传到cos的文件名，如果为空，则默认和本地一样，可以传带目录的文件
     */
    public function FileUpload($LocalFileName, $FileName='')
    {
        $cosClient = new Client([
            'region' => $this->Region,
            'schema' => 'http', //协议头部，默认为http
            'credentials' => [
                'secretId' => $this->AccessKeyID,
                'secretKey' => $this->AccessKeySecret
            ]
        ]);
        if(!$FileName){
            $FileName = trim(strrchr($LocalFileName,DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR);
        }

        try {
            $file = fopen($LocalFileName, "rb");
            if ($file) {
                $result = $cosClient->putObject([
                    'Bucket' => $this->Bucket,   //存储桶名称 格式：BucketName-APPID
                    'Key' => $FileName,   // 此处的 key 为对象键，对象键是对象在存储桶中的唯一标识
                    'Body' => $file
                ]);
                if($this->Host){
                    $url = trim($this->Host,'/') . '/' . trim($FileName,'/');
                }else{
                    $url = $result['Location'];
                }
                $array = ['code' => 200,  'msg' => 'Picture uploaded Cos successfully', 'url' => $url ];
            }
        } catch (\Exception $e) {
            $array = ['code' => 0,  'msg' => $e->getMessage(), 'url' => '' ];
        }

        return $array;
    }
}
