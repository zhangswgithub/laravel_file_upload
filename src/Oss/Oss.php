<?php

namespace File\Upload\Oss;

use Obs\ObsClient;
use OSS\OssClient;

class Oss
{
    private $AccessKeyID;
    private $AccessKeySecret;
    private $EndPoint;
    private $Bucket;
    private $Host;

    public function __construct()
    {
        // 获取OSS参数值
        $this->AccessKeyID     = config('upload.aliyun_oss.AccessKeyID');
        $this->AccessKeySecret = config('upload.aliyun_oss.AccessKeySecret');
        $this->EndPoint        = config('upload.aliyun_oss.EndPoint');
        $this->Bucket          = config('upload.aliyun_oss.Bucket');
        $this->Host            = config('upload.aliyun_oss.Host');
    }

    /**
     * @param $file   文件流
     * @param string $fileName   文件名
     * @param string $filePath   文件目录
     * @return array
     */
    public function FileUpload($file, $fileName='', $filePath='')
    {
        // 文件名
        if(!$fileName){
            $fileName = sha1(date('YmdHis') . uniqid()) . $file->getClientOriginalName();
        }
        // 目录
        if($filePath){
            $fileName = $filePath . '/' . $fileName;
        }

        return $this->AliUploadFile($file, $fileName);
    }

    /**
     * 上传文件到阿里云OSS
     * @param $file      文件流
     * @param $fileName  文件名
     * @return array
     */
    public function AliUploadFile($file, $fileName)
    {
        try{
            // 实例化
            $ossClient = new OssClient($this->AccessKeyID , $this->AccessKeySecret, $this->EndPoint);
            // 执行阿里云上传
            $result = $ossClient->uploadFile($this->Bucket, $fileName,$file);

            if(!$this->Host){
                $array = ['code' => 200,  'msg' => 'Picture uploaded Oss successfully', 'url' => $result['info']['url'] ];
            }else{
                $Host = trim($this->Host,'/') . '/';
                $array = ['code' => 200,  'msg' => 'Picture uploaded Oss successfully', 'url' => $Host . $fileName ];
            }

        }catch (\Exception $e){
            $array = ['code' => 0,  'msg' => $e->getMessage(), 'url' => '' ];
        }

        return $array;
    }
}
