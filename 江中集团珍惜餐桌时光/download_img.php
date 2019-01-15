<?php
  require_once "./jssdk1.php";
  $media_id = $_POST['serverid'];
  //请填写自己微信的相关信息
  $access_token = get_access_token("","");
  $orginimg=getmedia($access_token,$media_id);
  echo thumb_img($orginimg);
  
  
  //echo $access_token;
function getmedia($access_token,$media_id){
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id;
        if (!file_exists("./Uploads/orginal/")) {
            mkdir("./Uploads/orginal/", 0777, true);
        }
        if (!file_exists("./Uploads/thumb/")) {
            mkdir("./Uploads/thumb/", 0777, true);
        }
        $targetName = './Uploads/orginal'.'/'.date('YmdHis').rand(1000,9999).'.jpg';
        $ch = curl_init($url); // 初始化
        $fp = fopen($targetName, 'wb'); // 打开写入
        curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        return $targetName;
}


function get_access_token($appid,$appsecret){
	
	$sql=mysql_query("select * from active_wx_config where appid='$appid'");
	$wx_config=mysql_fetch_array($sql);
	$datetime=time();
	$exprie_time=$datetime-$wx_config[update_time];
	
	/*
	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
    $access_token_json=https_request_get($url);
    $access_token_arr=json_decode($access_token_json,true);
    $access_token=$access_token_arr['access_token'];
    $sql="update ".$ecs->table('wx_config')." set token='$access_token',update_time='$datetime' where appid='$appid'";
	$db->query($sql);
	*/
	
	
	if($exprie_time>1000){
	    $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        $access_token_json=https_request_get($url);
        $access_token_arr=json_decode($access_token_json,true);
        $access_token=$access_token_arr['access_token'];
		$sql_1 = mysql_query("update active_wx_config set token='$access_token',update_time='$datetime' where appid='$appid'");
	}
	else{
		$access_token=$wx_config[token];
	}
	
	
	return $access_token;
}


function thumb_img($file){
	header("Content-type: image/jpeg");
    //$file = "Uploads/orginal/201610181630012329.jpg";
    $percent = 0.5;  //图片压缩比
    list($width, $height) = getimagesize($file); //获取原图尺寸
    //缩放尺寸
    $newwidth = $width * $percent;
    $newheight = $height * $percent;
    $src_im = imagecreatefromjpeg($file);
    $dst_im = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresized($dst_im, $src_im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	$thumb_path = './Uploads/thumb/'.date('YmdHis').rand(1000,9999).'.jpeg';
    $thumb = imagejpeg($dst_im,$thumb_path); //输出压缩后的图片
	return $thumb_path;
}




function https_request_get($url)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    if (curl_errno($curl)) {return 'ERROR '.curl_error($curl);}
    curl_close($curl);
    return $data;
  }
  
  
 
	
?>