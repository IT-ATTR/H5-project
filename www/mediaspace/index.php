<?php
    require_once __DIR__ . '/../../wechat/jssdk.php';
    $signPackage = ( new jssdk() )->getSignPackage();
?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/bg.jpg);background-color: #000;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<meta name="viewport" content="user-scalable=0" />
	<title>穿越“鲜”时空</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.1.min.js" ></script>
    <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?e796a3331dbfb8fef099ff0eb8cab762";
          var s = document.getElementsByTagName("script")[0];
          s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <style>
        .edgeLoad-EDGE-9039389 { visibility:hidden; }
        .loading{position: absolute; width: 100%; height: 100%; background:#000000; z-index: 99;}
	    .loading img{position: fixed; left: 50%; top: 50%; -webkit-transform: translate(-50%,-50%); text-align: center;}
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-9039389', {
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
        //alert(pheight);
        
        // 计算出的显示高度占屏幕的百分比
        bheight=(pheight/cHeight*100)+"%";
        //alert(bheight);
        
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
    <audio src="music/BGM.mp3" id="audio" autoplay loop style="display: none;"></audio>
	<div class="loading">
        <img src="images/loading.gif" />
    </div>

	<div id="Stage" class="EDGE-9039389" style="position: absolute;"></div>

	<script type="text/javascript">
        document.onreadystatechange = function () {
               if(document.readyState=="complete") {
                // $("body").css("background-color","#000");
                //解决闪屏问题，白色忽闪即逝，让其延迟两秒进入
                         // var time = setInterval(function(){
                                $(".loading").hide();
                          //       clearInterval(time);
                          // },2000);
               }else{
                   $("body").css("background-color","#000");
                   $("body").height("100%");
               }
           }

    //嵌入loading图片
        // var time = setInterval(function(){
        //     $(".loading").hide();
        //     clearInterval(time);
        // },3000);

	</script>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/h5.fit.common.js"></script>
    <script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";


                wx.config({
                    debug: false, 
                    appId: '<?php echo $signPackage["appId"];?>',
                    timestamp: <?php echo $signPackage["timestamp"];?>,
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
                        'downloadImage' 
                     ]
            });

            
            wx.ready(function(){
  
                var title = '穿越“鲜”时空';     //分享标题
                var desc = '从冰块藏鲜到冰箱保鲜，我们经历了几千年，未来的保鲜世界又是什么样子？坐上时空飞船，出发吧！';      //分享描述
                var desc1 = '从冰块藏鲜到冰箱保鲜，我们经历了几千年，未来的保鲜世界又是什么样子？坐上时空飞船，出发吧！';      //分享描述
                var imgurl = '';  //分享图片
                var shareurl='';   //分享链接
                var link_url="";          //分享完跳转链接
  
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
        //播放音乐
        function bf(){
            $("#audio")[0].play();
        }

        //暂停音乐
        function zt(){
            $("#audio")[0].pause();
        }
    </script>
</body>
</html>