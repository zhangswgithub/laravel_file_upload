<?php

namespace File\Upload\Kodo;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Kodo
{
    private $AccessKeyID;
    private $AccessKeySecret;
    private $Bucket;
    private $Host;

    public function __construct()
    {
        // 获取OSS参数值
        $this->AccessKeyID     = config('upload.qiniu_kodo.AccessKeyID');
        $this->AccessKeySecret = config('upload.qiniu_kodo.AccessKeySecret');
        $this->Bucket          = config('upload.qiniu_kodo.Bucket');
        $this->Host            = config('upload.qiniu_kodo.Host');
    }

    /**
     * @param $LocalFileName    本地文件名
     * @param $QiniuFilename    上传到七牛的文件名
     * @return array
     * @throws \Exception
     */
    public function FileUpload($LocalFileName,$QiniuFilename)
    {
        // 鉴权
        $auth = new Auth($this->AccessKeyID, $this->AccessKeySecret);
        $upToken = $auth->uploadToken($this->Bucket);
        // 上传文件
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($upToken,$QiniuFilename,$LocalFileName);

        if ($err !== null) {
            $array = ['code' => 0,  'msg' => $err, 'url' =>''];
        } else {
            if($this->Host){
                $this->Host = trim($this->Host,'/') . '/';
            }
            $url = $this->Host . $ret['key'];

            $array = ['code' => 200,  'msg' => 'Picture uploaded Kodo successfully', 'url' => $url];
        }

        return $array;
    }
}
