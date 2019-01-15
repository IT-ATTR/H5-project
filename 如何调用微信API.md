## 如何成功调用微信API组件
>在微信中框架提供丰富的微信原生API，可以方便的调起微信提供的能力，如获取用户信息，本地存储，支付功能等。

> **说明:**
> * wx.on 开头的 API 是监听某个事件发生的API接口，接受一个 CALLBACK 函数作为参数。当该事件触发时，会调用 CALLBACK 函数。
> * 如未特殊约定，其他 API 接口都接受一个OBJECT作为参数。
> * OBJECT中可以指定success, fail, complete来接收接口调用结果。
> * 具体微信提供哪些API，可以[参考官方文档](https://developers.weixin.qq.com/miniprogram/dev/api/)

#### 在实际H5开发中我们需要调用的接口各式各样，究竟如何才能正确成功的调用这些接口呢，请参考我这片文档，将详细讲述如何进行微信API的调用。

#### jssdk.php文件
```php
$mysql_server_name=''; //改成自己的mysql数据库服务器
 
$mysql_username=''; //改成自己的mysql数据库用户名
 
$mysql_password=''; //改成自己的mysql数据库密码
 
$mysql_database=''; //改成自己的mysql数据库名

$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库
 

 
mysql_select_db($mysql_database); //打开数据库

//mysql_close($con);

mysql_query("SET NAMES UTF8"); 

class JSSDK {
  private $appId;
  private $appSecret;


  public function __construct($appId, $appSecret) {
    $this->appId = $appId;
    $this->appSecret = $appSecret;
	
  }

  public function getSignPackage() {
    $jsapiTicket = $this->getJsApiTicket();

    // 注意 URL 一定要动态获取，不能 hardcode.
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();
    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);
	
	$string1="1437472252E0o2-at6NcC2OsJiQTlwlPiJcBtWxQ1Nf_w-7oA3LWIhS_mKmgSPbPTUy1sPztNf8MQyKvQWxfDSTZFjtHAnRQabc123456789pN7drt7wWOXBuEnRO0fqHY0sYsdotdi07xy2yFX2uCV3";
	
	$signature1 = sha1($string1);

    $signPackage = array(
      "appId"     => $this->appId,
      "nonceStr"  => $nonceStr,
      "timestamp" => $timestamp,
      "url"       => $url,
      "signature" => $signature,
      "rawString" => $string,
	  "signature1" => $signature1
    );
    return $signPackage; 
  }

  private function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
  }

  private function getJsApiTicket() {
    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(file_get_contents("../jsapi_ticket.json"));
    if ($data->expire_time < time()) {
      $accessToken = $this->getAccessToken();
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $res = json_decode($this->httpGet($url));
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->jsapi_ticket = $ticket;
        $fp = fopen("../jsapi_ticket.json", "w");
        fwrite($fp, json_encode($data));
        fclose($fp);
      }
    } else {
      $ticket = $data->jsapi_ticket;
    }

    return $ticket;
  }

  public function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $sql=mysql_query("select * from active_wx_config where appid='$this->appId'");
	$info=mysql_fetch_array($sql);
	$nowtime=time();
	$surpluses_time=$nowtime-$info[update_time];
	if($surpluses_time>800){
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
        $res = json_decode($this->httpGet($url));
        $access_token = $res->access_token;
		$sql=mysql_query("update active_wx_config set token='$access_token',update_time='$nowtime' where appid='$this->appId'");
	}
	else{
	   $access_token=$info[token];
	}
    return $access_token;
  }

  private function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }
}



$jssdk = new JSSDK("wx750e1c5f632445e7", "240ea6837a66a24006c953dcaba1f455");
$signPackage = $jssdk->GetSignPackage();
//$signPackage = $jssdk->getAccessToken();
//print_r($signPackage);
//$json=json_encode($signPackage);
```

### 完整案例
```
<?php
    require_once "./jssdk1.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>获取用户位置</title>
</head>
<body>
	<button onclick="getposition()">获取用户消息</button>
	<button onclick="map()">看地图</button>
	<p>
		用户经度：<span id="lat"></span>
	</p>
	<p>
		用户维度：<span id="lng"></span>
	</p>
</body>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
	  var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";

        wx.config({
                    debug: false,
                    appId: '<?php echo $signPackage["appId"];?>',
                    timestamp: '<?php echo $signPackage["timestamp"];?>',
                    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
                    signature: '<?php echo $signPackage["signature"];?>',
                    jsApiList: [
                        'checkJsApi',
                        'onMenuShareTimeline',
                        'onMenuShareAppMessage',
                        'onMenuShareQQ',
                        'onMenuShareWeibo',
                        'chooseImage',
                        'previewImage',
                        'uploadImage',
                        'downloadImage',
                        'openLocation',
                        'getLocation'
                     ]
            });
            //需要调用的API接口，一定要添加到wx.config中

	function getposition(){
		wx.getLocation({
		  type: 'wgs84',
		  success: function(res) {
		    var latitude = res.latitude
		    var longitude = res.longitude
		    var speed = res.speed
		    var accuracy = res.accuracy

		    document.getElementById("lat").innerHTML = latitude;
		    document.getElementById("lng").innerHTML = longitude;

		  }
	})
	}

	function map(){
		wx.getLocation({
		  type: 'gcj02', //返回可以用于wx.openLocation的经纬度
		  success: function(res) {
		    var latitude = res.latitude
		    var longitude = res.longitude
		    wx.openLocation({
		      latitude: latitude,
		      longitude: longitude,
		      scale: 28
		    })
		  }
})
	}
</script>
</html>
```

#### 以上操作既能够调用微信接口了