<?php
    require_once __DIR__ . '/../../wechat/jssdk.php';
    $signPackage = ( new jssdk() )->getSignPackage();

    if(!$_SESSION['openid']){
        header("Location:http://hd.520web.cn/wechat/connect.php?goto_url=http://hd.520web.cn/jzfood/");
    }
?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/bg.jpg);">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>江中美食HIGH吃季</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-4789689 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index3', 'EDGE-4789689', {
    scaleToFit: "none",
    centerStage: "none",
    minW: "0%",
    maxW: "undefined",
    width: "100%",
    height: "100%"
}, {"dom":{}}, {"dom":{}});

var cWidth;
	var cHeight; 
	var pheight;
	var bheight;
	var theight;
	var ttheight;
    window.onload = function(){
        // 获取屏幕高度
        cWidth=window.screen.width;
        //alert(cWidth);
        // 获取屏幕宽度 
        cHeight=window.screen.height;
		//alert(cHeight);
		
		// 计算出的高度
		pheight=cWidth*1138/640; 
		
		// 计算出的显示高度占屏幕的百分比
		bheight=(pheight/cHeight*100)+"%";
		
	    $("body").height(bheight);//更改body高度
	    
	    if(cHeight>800){
	    	theight=(cHeight-pheight)/cHeight;
		    ttheight=(theight/2)*100+"%";
	    }else{
		    theight=(cHeight-pheight)/cHeight;
		    ttheight=(theight/2)*100+"%";
	    }

	    $("#Stage").css("top",ttheight);
    }
</script>
<!--Adobe Edge Runtime End-->

</head>
<body style="margin:0;padding:0;">
	<div id="Stage" class="EDGE-4789689" style="position: absolute;">
	</div>
    <audio id="recode" src=''  style="display:none;"></audio>
</body>
<script type="text/javascript" src="./jquery.min.js" ></script>
<!--微信分享start-->
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
        //配置相应的全局变量,想要操作的数据库表名称
        var projectName = "jzyy20180823";
        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";
        //进行用户信息的入库
        var url= "https://www.mrgcgz.com/myAdmin/index.php/Admin/Project/userinfo";
        $.get(url,{"openid":openid,"nickname":nickname,"headimgurl":headimgurl,"projectName":projectName},function(){},"json");

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

                        'startRecord',
                        'stopRecord',
                        'onVoiceRecordEnd',
                        'playVoice',
                        'pauseVoice',
                        'stopVoice',
                        'onVoicePlayEnd',
                        'downloadVoice',
                        'translateVoice'
                     ]
            });

            wx.ready(function(){
                //这里表示微信链接初始化的过程，只要携带语音和图像就可以了，因为只会显示这个部分
                var touxiang = getQueryString('headimgurl');
                var wxyy = getQueryString('wxvoice');
                var num = getQueryString('param');

                if (touxiang=='' || wxyy=='' || num=='') {
                    window.location.href="https://www.mrgcgz.com/h5/html/jzyy20180823/index.php";
                    return false;
                }else{
                    sharetz(num);//播放相应的动画
                    $("#Stage_p1_tx-div2").append("<img src='"+touxiang+"' width='100%' height='100%' alt=''>");
                     //印上录音
                    $audio = document.getElementById("recode");
                     $audio.src=wxyy;
                }

               // $.get('./findUserInfo.php',{'openid':pid},function(obj){
               //      if (obj.wx_voice=='') {
               //          //用户没有录音
               //          alert("她的语音好像丢失了，咱们自己去录一段吧！");
               //      }else{
               //          //将其印上去
               //          $("#Stage_p1_tx-div2").append("<img src='"+obj.headimgurl+"' width='100%' height='100%' alt=''>");
               //      }
               // },'json');


                 // alert(getnum1);
                var title = '江中美食HIGH吃季';     //分享标题
                var desc = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
                var desc1 = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/jzyy20180823/icon.jpg';  //分享图片
                // alert(shareurl);
                var link_url="";   //分享完跳转链接
                var shareurl="https://www.mrgcgz.com/h5/html/jzyy20180823/index3.php?headimgurl="+touxiang+"&param="+num+"&wxvoice="+wxyy;   //分享链接

                wx.onMenuShareTimeline({

                    title: desc1,
                    link: shareurl,
                    imgUrl: imgurl,
                    trigger: function (res) {
                       //alert('用户点击分享到朋友圈');
                    },
                    success: function (res) {
                       // _hmt.push(['_trackEvent', 'sharewx', 'fxcg', '']);
                       // window.location.href = link_url;
                       // console.log("前");
                       // uploadVoice();
                       // console.log("后");

                    },
                    cancel: function (res) {
                    //alert('已取消');
                    },
                    fail: function (res) {
                    //alert(JSON.stringify(res));
                    }
                });
                wx.onMenuShareAppMessage({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: shareurl, // 分享链接
                    imgUrl: imgurl, // 分享图标
                    type: '', // 分享类型,music、video或link，不填默认为link
                    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () { 
                        // 用户确认分享后执行的回调函数
                        // _hmt.push(['_trackEvent', 'sharewx', 'fxcg', '']);
                        // window.location.href = link_url;
                       // console.log("前");
                       // uploadVoice();
                       //console.log("后");

                    },
                    cancel: function () { 
                        // 用户取消分享后执行的回调函数
                    }
                });
                wx.onMenuShareQQ({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: shareurl, // 分享链接
                    imgUrl: imgurl, // 分享图标
                    success: function () {
                       // 用户确认分享后执行的回调函数
                       // window.location.href = link_url;
                       // console.log("前");
                       // uploadVoice();
                       // console.log("后");

                    },
                    cancel: function () {
                       // 用户取消分享后执行的回调函数
                    }
                });
                wx.onMenuShareWeibo({
                    title: title, // 分享标题
                    desc: desc, // 分享描述
                    link: shareurl,// 分享链接
                    imgUrl: imgurl, // 分享图标
                    success: function () {
                       // 用户确认分享后执行的回调函数
                       // window.location.href = link_url;
                       // console.log("前");
                       // uploadVoice();
                       // console.log("后");

                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                    }
                });

                //wx.hideOptionMenu();
        });
            wx.error(function(res){
                //alert(res+"111");
            });

</script>
<!-- 微信分享end -->
<script type="text/javascript">
     //获取url参数值
    function getQueryString(name) {

        var reg = new RegExp('(^|&)'+name+'=([^&]*)(&|$)', 'i');
        var r = window.location.search.substr(1).match(reg);
        if (r != null) {
            return unescape(r[2]);
        }else{
            return null;
        }
    }

    //播放录音
    function playLanguage(){
        $audio = document.getElementById("recode");
        $audio.play();
    }

        //暂停音乐
    function pauseLanguage(){
         $audio = document.getElementById("recode");
         $audio.pause();
    }
</script>
</html>