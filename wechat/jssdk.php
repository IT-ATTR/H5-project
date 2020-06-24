<?php
/**
 * Desc: 微信授权登陆
 * Created by PhpStorm.
 * User: Jiangliang
 * Date: 2018/05/20
 * Time: 15:21
 * Email: jiangliang@tanwan.com
 */

defined('APPID') or define('APPID', '');
defined('APPKEY') or define('APPKEY', '');

require_once __DIR__ . '/../class/Helper.php';

class jssdk
{
    /**
     * jssdk constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getSignPackage()
    {
        $protocol = http_request_protocol();

        $encrypt_data = [
            "jsapi_ticket" => $this->getJsApiTicket(),
            "noncestr" => $this->createNonceStr(),
            "timestamp" => time(),
            "url" => "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ];

        ksort($encrypt_data);

        return $signPackage = [
            "appId"     => APPID,
            "nonceStr"  => $encrypt_data['noncestr'],
            "timestamp" => $encrypt_data['timestamp'],
            "url"       => $encrypt_data['url'],
            "signature" => sha1(http_build_query($encrypt_data)),
            "rawString" => http_build_query($encrypt_data)
        ];
    }

    /**
     * @param int $length
     * @return bool|string
     */
    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = substr(str_shuffle($chars), mt_rand(0, strlen($chars) - $length), $length);
        return $str;
    }

    /**
     * @return mixed
     */
    private function getJsApiTicket()
    {
        $accessToken = $this->getAccessToken();
        $request_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token={$accessToken}";
        $request_res = json_decode(get_curl($request_url), true);
        return $request_res['ticket'];
    }

    /**
     * @return mixed
     */
    private function getAccessToken()
    {
        $request_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . APPID . '&secret=' . APPKEY;
        $request_res = json_decode(get_curl($request_url), true);
        return $request_res['access_token'];
    }
}