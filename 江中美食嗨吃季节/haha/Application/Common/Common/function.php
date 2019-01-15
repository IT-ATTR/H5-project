<?php
header("content-type:text/html;charset=utf-8");
/**
 *	删除图片
 *	@param 		$path 			String 			路径
 *	@return 		bool
 */
function delImg($path = ""){
	$arr = split("jsd",$path);
	$pathinfo = str_replace("//","/",$_SERVER['DOCUMENT_ROOT'].__ROOT__.$arr[1]);
	return unlink($pathinfo);
}
function getStrLen($str){
	preg_match_all('/./us', $str, $match); 
	return count($match[0]); 
}
function getIPaddress()

{
    $IPaddress='';
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $IPaddress = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $IPaddress = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $IPaddress = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $IPaddress = getenv("HTTP_CLIENT_IP");
        } else {
            $IPaddress = getenv("REMOTE_ADDR");
        }
    }
    return $IPaddress;
}
?>









