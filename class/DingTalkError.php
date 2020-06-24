<?php
/**
 * Desc: 异常处理钉钉报错
 * Created by PhpStorm.
 * User: Jiangliang
 * Date: 2018/05/20
 * Time: 13:14
 * Email: jiangliang@tanwan.com
 */
require __DIR__ . '/Helper.php';

class DingTalkError {
    /**
     * @var object
     */
    private static $instance;

    /**
     * @var string
     */
    private static $pro_name = "";

    /**
     * @var string
     */
    private static $url = "";

    /**
     * DingTalkError constructor.
     */
    private function __construct()
    {
        register_shutdown_function([$this, "fatal_error"]);
        set_error_handler([$this, "normal_error"]);
    }

    /**
     * @return DingTalkError
     */
    public static function instance() {
        if(!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 致命错误，发送钉钉报错
     */
    public function fatal_error()
    {
        if ($e = error_get_last()) {
            $e['level'] = 'fatal';
            call_user_func_array([$this, "error_map"], array(&$e));
            post_curl(self::$url, $e);
        }
    }


    /**
     * 普通错误
     * @param $type
     * @param $message
     * @param $file
     * @param $line
     */
    public function normal_error($type, $message, $file, $line)
    {
        $data = [
            'level'    => 'normal',
            'type'     => $type,
            'message'  => $message,
            'file'     => $file,
            'line'     => $line,
        ];
        call_user_func_array([$this, "error_map"], array(&$data));
        post_curl(self::$url, $data);
    }

    /**
     * @param $data
     */
    private function error_map(&$data){
        $data['project']   = self::$pro_name;
        $data['time']      = time();
        $data['url']       = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $data['ip']        = $_SERVER['SERVER_ADDR'] ?: $_SERVER['LOCAL_ADDR'];
        $data['client_ip'] = get_real_ip();
        $data['user_name'] = !empty($_SESSION["login"]) ? $_SESSION['login']['user_name'].'-'.$_SESSION['login']['true_name'] : '未知用户';
    }

    private function __clone()
    {
    }
}

DingTalkError::instance();