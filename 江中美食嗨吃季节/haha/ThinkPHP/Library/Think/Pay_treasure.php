<?php
/*
 *	支付宝
 */
namespace Think;
class Pay_treasure{
	function __construct(){

	}
	/**
	 * 统一下单
	 */
	function alipay_trade_query(){

	}
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
