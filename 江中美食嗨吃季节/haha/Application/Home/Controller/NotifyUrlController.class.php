<?php
namespace Home\Controller;	
use Think\Controller;
header("content-type:text/html;charset=utf-8");
/**
 *	语音转码回调
 */
class NotifyUrlController extends AuthController{
    /**
     *  通过回调参数进行逻辑处理
     */
    public function index(){
        $fileName = "/mnt/web/jsd/Uploads/1490687819845.mp3";     //文件名称
        $url = "http://wx.jtsjw.com/jsd/Uploads/1490687819845.amr";          //文件所在地址
        $this->saveWeixinFile($fileName,$url);
    }
    /**
     *  删除七牛文件
     *  @param        $bucket         string        存储空间位置
     *  @param        $key            string        文件名
     *  @return       obj
     */
    public function deleteQnFile($Bucket,$key){
        $auth = new \Vendor\Qiniu\Auth(C('AccessKey'),C('SecretKey'));
        $obj = new \Vendor\Qiniu\Storage\BucketManager($auth);
        return $obj->delete($Bucket,$key);
    }
}
?>