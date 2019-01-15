<?php
  require_once "./jssdk1.php";
  $media_id = $_POST['serverid'];
  $access_token = get_access_token("wx750e1c5f632445e7","240ea6837a66a24006c953dcaba1f455");
  $orginimg=getmedia($access_token,$media_id);
  echo $orginimg;
  // echo thumb_img($orginimg);
  
  
  //echo $access_token;
function getmedia($access_token,$media_id){
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id;
        if (!file_exists("./wxvoice/")) {
            mkdir("./wxvoice/", 0777, true);
        }
        $targetName = './wxvoice'.'/'.date('YmdHis').rand(1000,9999).'.amr';		
		
		// $url ="http://www.mrgcgz.com/h5/html/recordtest/haha/index.php/Home/Index/index/uri/".$targetName;
		// // $url ="http://www.mrgcgz.com/h5/html/recordtest/haha/index.php/Home/Index/index?uri=".$targetName;
		
		$url = getCurl($url);

        return $url;

}

function getCurl($url){
		$ch = curl_init($url); // 初始化
        // $fp = fopen($url, 'wb'); // 打开写入
        curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        fclose($fp);
		return $result;
		
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


// function thumb_img($file){
//  header("Content-type: image/jpeg");
//     //$file = "Uploads/orginal/201610181630012329.jpg";
//     $percent = 0.8;  //图片压缩比
//     list($width, $height) = getimagesize($file); //获取原图尺寸
//     //缩放尺寸
//     $newwidth = $width * $percent;
//     $newheight = $height * $percent;
//     $src_im = imagecreatefromjpeg($file);
//     $dst_im = imagecreatetruecolor($newwidth, $newheight);
//     imagecopyresized($dst_im, $src_im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
//  $thumb_path = './Uploads/thumb/'.date('YmdHis').rand(1000,9999).'.jpeg';
//     $thumb = imagejpeg($dst_im,$thumb_path); //输出压缩后的图片
//  return $thumb_path;
// }




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