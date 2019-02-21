<?php
/* *
 * 功能：微信的JS-SDK的使用权限签名算法封装类
 * 版本：1.0
 * 作者：江亮（Eden）
 * 修改日期：2019-02-20
 * 说明：
 * 微信的JSSDK功能;ACCESS_TOKEN和jsapiTicket有效时间都是7200s

 *************************页面功能说明*************************
 * 后期进行完善
 * 使用规范的的代码格式
 * 使用redis和memcache的缓存进行数据的缓存
 */
class WeChatSignature{
	//微信公众号的appid
	private $appId;
	//微信公众号的appsecret
	private $appSecret;
	//ACCESS_TOKEN
	private $accessToken;
	//jsapi_ticket
	private $jsapiTicket;
	//随机字符串
	private $noncestr;
	//获取网页URL
	private $url;
	//当前时间戳
	private $time;

	//初始化公众号的参数
	public function __construct($appid,$appsecret){
		$this->appId         = $appid;
		$this->appSecret     = $appsecret;
		$this->time          = time();
		$this->noncestr      = $this->createNonceStr();
		$this->url           = $this->GetUrl();
		//过期时间都是7200s,注意使用缓存，不然影响业务
		$this->accessToken   = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&";
		$this->jsapiTicket   = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=";
	}


	//获取用户ACCESS_TOKEN，并缓存
	public function GetAccessToken(){
		$url  = $this->accessToken."appid=".$this->appId."&secret=".$this->appSecret;
		$res  = json_decode($this->Curd($url));
		//做业务逻辑，将access_token缓存到memcached中，设置过期时间
		return $res->access_token;
	}

	//创建随机字符串
	public function createNonceStr() {
   		$chars     = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   		$nonceStr  = substr(str_shuffle($chars),0,15);
   		return $nonceStr;
  }

	//获取当前网页的URL
	public function GetUrl(){
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    	$url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    	return $url;
	}

	//获取jsapi_ticket,并返回相关签名参数
	public function GetJsapiTicket(){
		$url  = $this->jsapiTicket.$this->GetAccessToken();
		$res  = json_decode($this->Curd($url));

		$string1 = "jsapi_ticket=".$res->ticket."&noncestr=".$this->noncestr."&timestamp=".$this->time."&url=".$this->url;


		$signPackage = array(
	      "appId"      => $this->appId,
	      "timestamp"  => $this->time,
	      "nonceStr"   => $this->noncestr,
	      "signature"  => sha1($string1)
	    );

	    return $signPackage;
	}


	//http_curd
	public function Curd($url,$data=null){
		 //第1步:初始化虚拟浏览器
        $ch = curl_init();
        //第2步:设置浏览器
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, false);//启用安全上传模式
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true );//以text/plain文本流返回
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);//没有ssl认证服务器
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//告诉api地址不要去找ssl证书
        //如果data不为空,我们就用post请求
        if( !empty($data) )
        {
            //post方式curl在php5.6以后会抛出温馨提示,所以我们要@屏蔽温馨提示,否则会影响返回结构
             @curl_setopt($ch, CURLOPT_POST, true); //设置请求方式为post
             @curl_setopt($ch,CURLOPT_POSTFIELDS,$data);//设置数据包
        }
        $result = curl_exec( $ch );
        curl_close($ch);
        return $result;
	}

}


   $jssdk = new WeChatSignature("wx3477b7903e1a4698","f5ddcec1b4500cf047b695403add169b");
   $signPackage = $jssdk->GetJsapiTicket();
