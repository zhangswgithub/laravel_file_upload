## 文档说明
> 该SDK是基于laravel框架开发

> 该SDK的作用：上传文件到阿里云Oss, 七牛云Kodo, 腾讯云 Cos
* 注：该SDK为第一版，以后持续更新，后期会加上其他云端的上传，和其他操作

### Laravel 应用：
1、包安装方式：
* composer require file/upload

2、注册服务提供者，在 config/app 下添加
>  File\Upload\ServiceProvider::class

3、发布配置文件
> php artisan vendor:publish --provider="File\Upload\ServiceProvider"
* 各个云端的配置不一样，请仔细查看


4、使用
> app('oss')->FileUpload($param)    或者  app()->make('oss')->FileUpload($param)

> app('cos')->FileUpload($param)    或者  app()->make('cos')->FileUpload($param)

> app('kodo')->FileUpload($param)   或者  app()->make('kodo')->FileUpload($param)
* 注：各个服务下的 FileUpload() 方法，参数不同，请自行查看

5、 接口返回，统一格式
* 成功
~~~~
{
    "code": 200,
    "msg": "Picture uploaded Oss successfully",
    "url": 'http://*********'
}
~~~~~
* 失败
~~~
{
    "code": 0,
    "msg": "错误信息",
    "url": ''
}
~~~
