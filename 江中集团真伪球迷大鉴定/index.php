<?php
    require_once "../jssdk1.php";
     if(!$_COOKIE['openid']){
            header("location:../../../wx_login2.php?id=8&url=https://www.xxxx.com/h5/xxxx/index.php");
            die();
    }
?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/bg.jpg);">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>真伪球迷大鉴定</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <style>
        .edgeLoad-EDGE-1384962 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-1384962', {
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
	<div id="Stage" class="EDGE-1384962" style="position: absolute;">
	</div>
    <audio src="music/BGM.mp3" autoplay autoloop loop controls id="audio" style="display: none;"></audio>
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?458645cd69fc5a2afb410b21f5a01e05";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
</script>

</body>
<!--微信分享start-->
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";
        //为了解决傻逼苹果系统Ajax获取不到数据的取巧办法，ios你搞我是吧，我有的是办法对付你
        var time = Date.parse(new Date());

            $.ajaxSettings.async = false;
             $.ajax({
                    type: 'POST',
                    async:false,
                    dataType: 'json',
                    url: 'saveUserImg.php',
                    // timeout: '8000',//请求超时时间
                    data: {dataimg:headimgurl,filename:time},// 每次请求等待时间
                    success: function(data,status){
                            //进行微信的跨域处理
                            }
            });

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
                        'downloadImage'
                     ]
            });


            wx.ready(function(){

                var title = '揭秘世界杯球迷背后的真实身份';     //分享标题
                var desc = '揭秘'+nickname+'球迷背后的真实身份!';      //分享描述
                var desc1 = '揭秘'+nickname+'球迷背后的真实身份!';     //分享描述
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
    <!-- 播放音乐暂停 -->
    <script type="text/javascript">
         function bf(){
            $("#audio")[0].play();
        }

        //暂停音乐
        function zt(){
            $("#audio")[0].pause();
        }


        //解决iphone的播放问题,必须写
        document.addEventListener('DOMContentLoaded',function (){
             var audio = document.getElementById("audio");
                audio.play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
            }, false);
            audioAutoPlay();
        });
    </script>

    <!-- 图片长按保存 -->
    <script type="text/javascript">

        var num;

        function getNum(obj){
            num = obj;
        }

        function savePic(){
            wordpic(nickname,"./images/s"+num+".jpg");
            // draw("./images/s"+num+".jpg","./user_images/"+time+".jpg");
        }
    </script>

    <script type="text/javascript">
        function getUserNickname(){
            return nickname;
        }

        function getUserHeadImg(){
            return headimgurl;
        }
    </script>
    <!-- 合成图片 -->
 <script type="text/javascript">
      function draw(jt,xk){
              // alert(jt);
              // alert(xk);
                // alert(0);
               var c = document.createElement('canvas'); //创建canvas元素
               var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

               var wd = 640;
               var he = 1008;
               var imgwd= 98;
               var imghe = 93;


               c.width = wd;   //设置画布宽
               c.height = he;  //设置画布高
               //创建一个矩形画布 填充白色
               ctx.rect(0,0,c.width,c.height);
               ctx.fillStyle='#fff';
               ctx.fill();

               var img2 = new Image;
               img2.src = jt;
               img2.crossOrigin = 'Anonymous';
               // alert(img2.onload());
               img2.addEventListener( "load",function(){
                        ctx.drawImage(img2,0,0,wd,he);
                            // alert(xk);
                           var img3 = new Image;
                           img3.src = xk;
                            // alert(2);
                           img3.onload = function(){
                              ctx.drawImage(img3,284,264,imgwd,imghe);
                              var bgImg = c.toDataURL("image/jpeg");

                               $("#Stage_p3_ght").append("<img src='"+bgImg+"' style='width:100%;height:100%'>");
                                 schc();
                          }
               },false );


            }
    </script>

    <!-- 合成文字 -->
    <script type="text/javascript">
         function wordpic(wz,tp){

           var wd = 640;
           var he = 1008;

           // var wz1wd = $(window).width()*0.365;
           // var wz1he = $(window).height()*0.105;

           // var wz1wd = $(document).width()*0.57;
           // var wz1he = $(document).height()*0.17;

           var c = document.createElement('canvas'); //创建canvas元素
           var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

           c.width=wd;    //设置画布宽
           c.height=he;   //设置画布高
           //创建一个矩形画布 填充白色
           ctx.rect(0,0,c.width,c.height);
           ctx.fillStyle='#FFFFFF';
           ctx.fill();

            var img1 = new Image;
            img1.crossOrigin = 'Anonymous';
            img1.src = tp;
            // alert(4);
            img1.onload = function () {
                // ctx.drawImage(img,0,0,1000,701);
                ctx.drawImage(img1,0,0,wd,he);
                // alert(5);
                ctx.fillStyle = 'rgb(0,0,0)';   // 文字填充颜色
                ctx.font="2em Arial, Helvetica, sans-serif";  //字体和字体大小

                //移轴居中设置
                ctx.textAlign='center';
                var wz1wd =330;
                var wz1he = 383;

                if(wz.length>7){
                    name = wz.substr(0,7)+"…";
                    ctx.fillText(name,wz1wd,wz1he);
                }else{
                    ctx.fillText(wz,wz1wd,wz1he);
                }


                var hcImg = c.toDataURL("image/jpeg");


                $.ajaxSettings.async = false;
            $.ajax({
                                                     type: 'POST',
                                                     dataType: 'text',
                                                     url: 'upload.php',
                                                     data: {"dataimg":hcImg},
                                                     success: function(data,status){
                                                                draw(data,"./user_images/"+time+".jpeg");
                                                     },
                                                
            });

                // $("#Stage_p3_ght").append("<img src='"+hcImg+"' style='width:100%;height:100%'>");

                // schc();
            }
        }
    </script>
</html>