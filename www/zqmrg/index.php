<?php 
    require_once __DIR__ . '/../wechat/jssdk.php';
    $signPackage = (new jssdk())->getSignPackage();
 ?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/bg.jpg);">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>邀你回“嘉”</title>
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-38124248 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-38124248', {
    scaleToFit: "none",
    centerStage: "none",
    minW: "0px",
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
<body style="margin:0;padding:0;">
	<div id="Stage" class="EDGE-38124248" style="position: absolute;">
	</div>
    <audio id="audio" src="./media/bgm.mp3" autoplay autoloop loop controls style="display: none;"></audio>
</body>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/h5.fit.common.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
    function bf(){
        document.getElementById("audio").play();
    }

    function zt(){
        document.getElementById("audio").pause();
    }
</script>
<script>
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

            'startRecord',
            'stopRecord',
            'onVoiceRecordEnd',
            'playVoice',
            'pauseVoice',
            'stopVoice',
            'onVoicePlayEnd',
            'uploadVoice',
            'downloadVoice',
            'translateVoice'
        ]
    });

    wx.ready(function(){
        var title = '邀你回“嘉”';     //分享标题
        var desc = '状元在哪里？';      //分享描述
        var desc1 = '状元在哪里？';      //分享描述
        var imgurl = 'https://www.mrgcgz.com/h5/html/jlzq20180914/icon.jpg';  //分享图片
        var shareurl='https://www.mrgcgz.com/h5/html/jlzq20180914/index.php';   //分享链接
        var link_url="https://www.mrgcgz.com/h5/html/jlzq20180914/index.php";   //分享完跳转链接

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
</html>