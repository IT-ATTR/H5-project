<?php
/**
 * Created by PhpStorm.
 * User: Jiangliang
 * Date: 2020/7/1
 * Time: 10:55
 * Email: jiangliang@tanwan.com
 * Desc: 微信授权回调.
 */
namespace wechat;

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../class/Helper.php';

class callback
{
    /**
     * @var string
     */
    public $user_info_url = 'https://api.weixin.qq.com/sns/userinfo';

    /**
     * @var string
     */
    public $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token';

    /**
     * callback constructor.
     */
    public function __construct()
    {
    }

    public function run()
    {
        $request_data = take_http_data([
            'appid',
            'scope',
            'redirect_uri',
            'state',
            'ext_data'
        ], [], false);

        if ( $request_data['state'] == $_SESSION['wxlogin'][$request_data['app_id']]['state'] )
        {
            $request_res = json_decode(get_curl($this->token_url . '?' . http_build_query([
                    "appid" => $request_data['app_id'],
                    "secret" => APPKEY,
                    "code" => $request_data['code'],
                    "grant_type" => "authorization_code",
                ])), true);

            if(!$request_res['openid'] || !$request_res['access_token'])
            {
                json_back($request_res);
            }
        } else {
            exit("The state does not match. You may be a victim of CSRF.");
        }

        //获取头像和昵称
        if(SCOPE == 'snsapi_userinfo')
        {
            $response = get_curl($this->user_info_url. '?' .http_build_query([
                    "access_token" => $request_res['access_token'],
                    "openid" => $request_res['openid']
                ]));

            $response = json_decode($response, true);
            $_SESSION['login'][$request_data['app_id']]['nickname'] = $response['nickname'];
            $_SESSION['login'][$request_data['app_id']]['headimgurl'] = $response['headimgurl'];
        }

        $_SESSION['login'][$request_data['app_id']]['open_id'] = $request_res['openid'];
        $go_url = urldecode($request_data['redirect_uri']);
        if($ext_data = $request_data['ext_data']){
            if(strpos($go_url, '?') !== false){
                $go_url = $go_url.'&ext_data='.$ext_data;
            }else{
                $go_url = $go_url.'?ext_data='.$ext_data;
            }
        }

        if($request_data['open_id']){
            echo $request_res['openid'];exit;
        }else{
            redirect($go_url);
        }
    }
}


(new callback())->run();

