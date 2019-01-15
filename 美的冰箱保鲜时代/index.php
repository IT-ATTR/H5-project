<?php 
    require_once "../jssdk1.php";
 ?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/bg.jpg);">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>美的微晶冰箱开启智能保鲜时代</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="https://animate.adobe.com/runtime/6.0.0/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-3771986 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-3771986', {
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
        
        // $("body").height(bheight);//更改body高度
        document.getElementsByTagName("body")[0].style.height = bheight;

        if(cHeight>800){
            theight=(cHeight-pheight)/cHeight;
            ttheight=(theight/2)*100+"%";
        }else{
            theight=(cHeight-pheight)/cHeight;
            ttheight=(theight/2)*100+"%";
        }

        // $("#Stage").css("top",ttheight);
        document.getElementById("Stage").style.top = ttheight;
    }
</script>
<!--Adobe Edge Runtime End-->

</head>
<body style="margin:0;padding:0;height:100%;">
    <audio src="music/BGM.mp3" id="audio" autoplay loop style="display: none;"></audio>
	<div id="Stage" class="EDGE-3771986">
	</div>
</body>

<script type="text/javascript" src="./jquery-2.1.1.min.js"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    document.body.style.overflow='hidden';
        //配置相应的全局变量,想要操作的数据库表名称
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
                     ]
            });

            wx.ready(function(){

                var title = '美的微晶冰箱开启智能保鲜时代';     //分享标题
                var desc = '美的微晶冰箱开启智能保鲜时代';      //分享描述
                var desc1 = '美的微晶冰箱开启智能保鲜时代';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/mdbx20181214/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/mdbx20181214/index.php';   //分享链接
                var link_url="https://www.mrgcgz.com/h5/html/mdbx20181214/index.php";   //分享完跳转链接

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
    var audio = document.getElementById("audio");
    function bf(){
            audio.play();
        }

        //暂停音乐
        function zt(){
            audio.pause();
        }

         //解决iphone的播放问题,必须写
        document.addEventListener('DOMContentLoaded',function (){
                audio.play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
            }, false);
            audioAutoPlay();
        });
</script>
</html>