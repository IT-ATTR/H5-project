<?php
/**
 * Desc: 全局辅助函数.
 * Created by PhpStorm.
 * User: Jiangliang
 * Date: 2018/05/20
 * Time: 15:29
 * Email: jiangliang@tanwan.com
 */

if(!function_exists("get_curl")) {
    /**
     * get请求
     * @param $url
     * @param int $timeout
     * @return mixed
     */
    function get_curl($url, $timeout = 5)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

if(!function_exists("post_curl")) {
    /**
     * post请求
     * @param $url
     * @param $post_data
     * @param array $header
     * @param int $timeout
     * @return mixed
     */
    function post_curl($url, $post_data, $header = [], $timeout = 5)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($header) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

if(!function_exists("http_request_protocol")) {
    /**
     * 获取请求协议
     * @return string
     */
    function http_request_protocol()
    {
        if(
            isset($_SERVER['HTTP_X_FORWARDED_PROTO'])
            && $_SERVER['HTTP_X_FORWARDED_PROTO'] == "https"
        ) {
            return "https://";
        }

        return (
            !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] != 'off'
            || $_SERVER['SERVER_PORT'] == 443
        ) ? "https://" : "http://";
    }
}

if(!function_exists("json_back")) {
    /**
     * 返回json数据
     * @param $data
     * @param bool $is_exit
     */
    function json_back($data, $is_exit = true)
    {
        $callback = (take_http_data(['callback'], [], false))['callback'];
        if ($callback) {
            echo '' . $callback . "(" . json_encode($data, JSON_UNESCAPED_UNICODE) . ")";
        } else {
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if ($is_exit) {
            exit();
        }
    }
}

if(!function_exists("take_http_data")) {
    /**
     * 获取get数据
     * @param $field
     * @param array $error_msg
     * @param bool $strict
     * @return array
     */
    function take_http_data($field, $error_msg = [], $strict = true)
    {
        $http_data = [];
        foreach ($field as & $field_name) {
            if (isset($_GET[$field_name]) && $_GET[$field_name] != '') {
                $http_data[$field_name] = check_data($_GET[$field_name]);
            } else {
                if (!$strict) {
                    $http_data[$field_name] = check_data(isset($_GET[$field_name]) ? $_GET[$field_name] : '');
                } else {
                    json_back([
                        'status' => 0,
                        'msg' => (isset($error_msg[$field_name]) && $error_msg[$field_name]) ? "{$error_msg[$field_name]}不能为空！" : "{$field_name}不能为空！"
                    ]);
                }
            }
        }
        return $http_data;
    }
}

if(!function_exists("get_real_ip")) {
    /**
     * 获取客户端真实的ip | 阿里云cdn规则
     * @return array|false|string
     */
    function get_real_ip()
    {
        if(@$_SERVER["HTTP_ALI_CDN_REAL_IP"]){
            $ip = $_SERVER["HTTP_ALI_CDN_REAL_IP"];
        }
        elseif (@$_SERVER["HTTP_X_FORWARDED_FOR"] ?: false) {
            $ip  = $_SERVER["HTTP_X_FORWARDED_FOR"];
            $ips = explode(',', $ip);
            $ip  = $ips[0];
        } elseif (@$_SERVER["HTTP_CDN_SRC_IP"] ?: false) {
            $ip = $_SERVER["HTTP_CDN_SRC_IP"];
        } elseif (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $ip = str_replace(array('::ffff:', '[', ']'), array('', '', ''), $ip);

        return $ip;
    }
}

if(!function_exists("check_data")) {
    /**
     * 数据检测
     * @param $data
     * @return array|string
     */
    function check_data($data) {
        if (is_array($data)) {
            foreach ($data as $key => $v) {
                $data[$key] = check_data($v);
            }
        } else {
            $data = trim($data);
            $data = strip_tags($data);
            $data = htmlspecialchars($data);
            $data = addslashes($data);
        }
        return $data;
    }
}

