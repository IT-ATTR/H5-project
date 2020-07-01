<?php
/**
 * Created by PhpStorm.
 * User: Jiangliang
 * Date: 2020/7/1
 * Time: 10:55
 * Email: jiangliang@tanwan.com
 * Desc: 非静默授权.
 */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../class/Helper.php';

class connect
{
    /**
     * @var string
     */
    private $callback_url = __DIR__ . '/callback.php?phpsessid=';

    /**
     * connect constructor.
     */
    public function __construct(){}

    /**
     * @param string $app_id
     */
    public function run()
    {
        $this->callback_url = $this->callback_url.session_id();
        $this->callback_url = $_SERVER["QUERY_STRING"] ? $this->callback_url.'&'.$_SERVER["QUERY_STRING"] : $this->callback_url;
        $_SESSION['wxlogin'][APPID]['callback'] = $this->callback_url;
        $_SESSION['wxlogin'][APPID]['state'] = md5(uniqid(rand(), TRUE));

        $login_url = "https://open.weixin.qq.com/connect/oauth2/authorize?response_type=code&appid="
            . APPID
            . "&scope=" . SCOPE
            . "&redirect_uri=" . urlencode($_SESSION['wxlogin'][APPID]['callback'])
            . "&state=" . $_SESSION['wxlogin'][APPID]['state']
            . "#wechat_redirect";
        redirect($login_url);
    }
}

(new connect())->run();