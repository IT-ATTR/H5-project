<?php
  require_once "../jssdk1.php";
  $media_id = $_POST['serverid'];
  $access_token = get_access_token("wx750e1c5f632445e7","240ea6837a66a24006c953dcaba1f455");
  $orginimg=getmedia($access_token,$media_id);
  // $orginimg=getmedia();
  echo $orginimg;
  // echo thumb_img($orginimg);
  
  

function getmedia($access_token,$media_id){
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id;
        if (!file_exists("./haha/Uploads/")) {
            mkdir("./haha/Uploads/", 0777, true);
        }
        $targetName = './haha/Uploads'.'/'.date('YmdHis').rand(1000,9999).'.amr';
        $ch = curl_init($url); // 初始化
        $fp = fopen($targetName, 'wb'); // 打开写入
        curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
		
		$targetName3 = basename($targetName);

        // return $targetName3;
	   
		$url1 ="https://www.mrgcgz.com/h5/html/jzyy20180823/haha/index.php/Home/Index/index/uri/".$targetName3;
		
        // return $url1;die;
		$url2 = curl_file_get_contents($url1);

        return $url2;

}

// function getmedia(){

//      $targetName3 = '201706221751451368.amr';

//      $url1 ="https://www.mrgcgz.com/h5/html/zydt20170614/haha/index.php/Home/Index/index/uri/".$targetName3;
        
//      $url2 = curl_file_get_contents($url1);

//      return $url2;
// }




function curl_file_get_contents($durl){  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $durl);

    $res = @curl_exec($curl);
    curl_close($curl);

    return $res;
}

function getCurl($url){
		$ch = curl_init($url); // 初始化
        $fp = fopen($url, 'wb'); // 打开写入
        curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
        curl_setopt($ch, CURLOPT_HEADER, 0);
        // $result = curl_exec($ch);
		curl_exec($ch);
        curl_close($ch);
        fclose($fp);
		// return $result;	
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