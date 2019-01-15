<?php
namespace Home\Controller;	
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class IndexController extends AuthController{
	// public function index(){	
        // $url = $_SERVER['DOCUMENT_ROOT'].__ROOT__."/Uploads/1494400412284.amr";
		// // $url = "D:\wwwroot\mrgcgz\wwwroot\h5\html\recordtest\wxvoice\201706121633581489.amr";
        // $obj = new \Vendor\Qiniu\Index();
        // $rs = $obj->index($url,"wx1234");
        // $uri = "http://ojarr8qsm.bkt.clouddn.com/f0ZhdfBuStBT1zwU3OUQUMDT9tQ=/".$rs['0']['key'];
        // echo $uri;
		// // echo $_SERVER['DOCUMENT_ROOT'];
		// // echo '</br>';
		// // echo __ROOT__;
		// // echo '</br>';
		// // echo $url;
    // }
	
	public function index(){	
        // $url = $_SERVER['DOCUMENT_ROOT'].__ROOT__."/Uploads/1494400412284.amr";
		$name = $_GET['uri'];
        $url = $_SERVER['DOCUMENT_ROOT'].__ROOT__."/Uploads/".$name;

        $obj = new \Vendor\Qiniu\Index();
        $rs = $obj->index($url,"jz-amr");
		//echo $rs;die;
        
		// $uri = "http://or9wkz8jb.bkt.clouddn.com/f0ZhdfBuStBT1zwU3OUQUMDT9tQ=/".$rs['0']['key'];
		    
		$uri = "http://pebry98ur.bkt.clouddn.com/UAA-4hndfVc5V6DJX0EvslAUBBI=/".$rs['0']['key'];
		
        echo $uri;
		
		// echo $url;
    }
	
	// public function index(){	
        // $obj = new \Vendor\Qiniu\Index();
        // $rs = $obj->index($_GET['uri'],"wx1234");
        // $uri = "http://ojarr8qsm.bkt.clouddn.com/f0ZhdfBuStBT1zwU3OUQUMDT9tQ=/".$rs['0']['key'];
        // return $uri;
    // }
}
?>