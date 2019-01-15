<?php
/*
 *	微信类
 */
namespace Think;
class WX{
	public $config = array(
						"appid" => "",			//Appid
						"secret" => "",			//appSecret
						"save_path" => "",		//access_token和ticket保存地址如果不填默认保存在\Application\Common\
					);
	public $access_token = "";					//access_token
	public $ticket = "";						//ticket
	/*
	 *	获取code
	 */
	public function get_code(){
		if(isset($_GET['code'])){
			return $_GET['code'];
		}else{
			return false;
		}
	}
	/**
	 *	获取access_token
	 */
	public function access_token(){
		if(!$this->config['save_path']){
			$root = substr(__ROOT__,1);
			$this->config['save_path'] = $_SERVER['DOCUMENT_ROOT'].$root."/Application/Common/";
		}
		$access_token_time = filemtime($this->config['save_path']."wx_access_token.txt");
		if(time() - $access_token_time >= 7000){
			$str = $this->get_curl("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appid}&secret={$this->appSecret}");
			$access_token = json_decode($str)->access_token;
			fwrite_txt($this->config['save_path'],$access_token);
		}else{
			$access_token = fread_txt($this->config['save_path']."wx_access_token.txt");
		}
		return $access_token;
	}
	/*
	 *	获取ticket
	 */
	function ticket($path = ""){
		if(!$this->config['save_path']){
			$root = substr(__ROOT__,1);
			$this->config['save_path'] = $_SERVER['DOCUMENT_ROOT'].$root."/Application/Common/";
		}
		$tocket_time = filemtime($path."wx_ticket.txt");
		if(time() - $tocket_time >= 7000){
			$this->ticket = $this->get_curl("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$this->access_token}&type=jsapi");
			$this->fwrite_txt($this->config['save_path']."wx_ticket.txt",$this->ticket);
		}else{
			$ticket = $this->fread_txt($this->config['save_path']."wx_ticket.txt");
		}
		return json_decode($ticket);
	}
	/*
	 *	获取用户信息
	 */
	function get_usInfo(){
		$code = $this->get_code();
		$res = get_curl("https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->appid}&secret={$this->appSecret}&code={$code}&grant_type=authorization_code");
		$openid = json_decode($res)->openid;
		$refresh_token = json_decode($res)->refresh_token;
		$access_token = get_curl("https://api.weixin.qq.com/sns/oauth2/refresh_token?appid={$this->appid}&grant_type=refresh_token&refresh_token={$refresh_token}");
		$token = json_decode($access_token);
		return get_curl("https://api.weixin.qq.com/sns/userinfo?access_token={$token->access_token}&openid={$openid}");
	}
	/*
	 *	获取jssdk签名
	 */
	function signature(){
		$timestamp = time();
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$noncestr = createNonceStr(10);
		$string = "jsapi_ticket={$this->ticket}&noncestr=$noncestr&timestamp=$timestamp&url=$url";
		$signature = sha1($string);
		return array(
			'timestamp' => $timestamp,
			'noncestr' => $noncestr,
			'signature' => $signature
		);
	}
	/*
	 *	获取带参数的二维码
	 */
	function get_ercode($us_id = 1){
		$url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$this->access_token}";
		$param = array(
				"action_name"=>"QR_LIMIT_SCENE",
				"scene"=>array("scene_id"=>$us_id)
			);
		$xml = post_curl($url,json_encode($param));
		return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode(json_decode($xml)->ticket);
	}
	/*
	 *	获取上传的图片
	 */
	function get_image($media_id){
		$imageName = time().".png";
		$json = "{media_id:'{$media_id}'}";
		$res = get_curl("http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$this->access_token}&media_id={$media_id}",2);
		$this->fwrite_txt($_SERVER['DOCUMENT_ROOT'].__ROOT__."/Uploads/".$imageName,$res);
		return "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].__ROOT__."/Uploads/".$imageName;
	}
	/*
	 *	文件写入
	 */
	function fwrite_txt($path,$txt){
		$myfile = fopen($path,"w") or die("Unable to open file!");
		fwrite($myfile,$txt);
		fclose($myfile);
	}
	/*
	 *	文件读取
	 */
	function fread_txt($path){
		$myfile = fopen($path,"r") or die("Unable to open file!");
		$txt = fread($myfile,filesize($path));
		fclose($myfile);
		return $txt;
	}
	/*
	 *跨域请求数据(GET)
	 *$url			请求参数
	 *$agreement	https|http
	 */
	function get_curl($url,$agreement = 0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		if($agreement == 0){//0	https	1	http
			unset($_REQUEST['agreement']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		}
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result; 
	}
	/*
	 *	跨域请求数据(POST)
	 *	$url	请求地址
	 *	$agreement	https |	http
	 *	$data	参数
	 */
	function post_curl($url,$data,$agreement = 0){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		if($agreement == 0){//0	https	1	http
			unset($_REQUEST['agreement']);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		}
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}
