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
        .edgeLoad-EDGE-18329763 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-18329763', {
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
	<div id="Stage" class="EDGE-18329763" style="position: absolute;">
	</div>
  <!--  背景音乐 -->
    <audio src="./music/BGM.mp3" id="audio"  autoloop  loop autoplay style='display: none;'></audio>
</body>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/h5.fit.common.js"></script>
<script type="text/javascript" src="./jquery.qrcode.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
        //配置相应的全局变量,想要操作的数据库表名称
        var projectName = "jzyy20180823";
        var localId = null; //用于记录录音ID
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

                var title = '江中美食HIGH吃季';     //分享标题
                var desc = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
                var desc1 = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/jzyy20180823/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/jzyy20180823/index.php';   //分享链接
                var link_url="https://www.mrgcgz.com/h5/html/jzyy20180823/index.php";   //分享完跳转链接

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
<!-- 抽奖方法开始 -->
<script type="text/javascript">
    var biaozhi = null;

    function choujiang(){
        var num = null;
        var url = "https://www.mrgcgz.com/myAdmin/index.php/admin/Api/getNumSpecial";

        $.ajaxSettings.async = false;
        $.get(url,{"openid":openid,"nickname":nickname,"headimgurl":headimgurl,"projectName":projectName},function(obj){
            console.log(obj);
            $param = obj.split(",");
            num = $param[0];
            console.log(num);
            biaozhi =  $param[1];

            console.log(obj);
            console.log(num);
        },"json");

        return num;
    }
</script>

<!-- 生成特殊二维码 -->
<script type="text/javascript">
    console.log(biaozhi);
    function prizeQcode(){
        if($('#Stage_p2_jg_ma:has(img)').length!=0){
            $('#Stage_p2_jg_ma img').remove();
            $('canvas').remove();
            createQr();
        }else{
            createQr();
        }
    }

    function createQr(){
        document.createElement('canvas').getContext('2d');
        var valText = "https://www.mrgcgz.com/h5/html/jzhesystem/index.php?biao_zhi="+biaozhi;
        $('#Stage_p2_jg_ewm').qrcode({render:"canvas",height:258, width:262,correctLevel:0,text:valText});
        //获取网页中的canvas对象
        var mycanvas=document.getElementsByTagName('canvas')[0];
        //将转换后的img标签插入到html中
        var img = convertCanvasToImage(mycanvas);
        $('#Stage_p2_jg_ma').append(img);//imgDiv表示你要插入的容器id
    }

    function convertCanvasToImage(canvas) {
        //新Image对象，可以理解为DOM
        var image = new Image();
        // canvas.toDataURL 返回的是一串Base64编码的URL
        // 指定格式PNG
        image.src = canvas.toDataURL("image/png",1.0);
        // console.log(image);
        return image;
    }

    //音乐播放
    function bf(){
        var audio = document.getElementById('audio');
        audio.play();
    }

    //音乐暂停
     function zt(){
        var audio = document.getElementById('audio');
        audio.pause();
    }
</script>
</html>