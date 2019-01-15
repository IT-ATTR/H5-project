<?php 
    require_once "../jssdk1.php";
 ?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/bg.jpg);">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>吃货理论测试</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-2.1.1.min.js" ></script>
    <script type="text/javascript">
            var _hmt = _hmt || [];
            (function() {
              var hm = document.createElement("script");
              hm.src = "https://hm.baidu.com/hm.js?c513510ae8a2d8d8652803b43f249f01";
              var s = document.getElementsByTagName("script")[0]; 
              s.parentNode.insertBefore(hm, s);
            })();
    </script>
    <style>
        .edgeLoad-EDGE-17941080 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index1', 'EDGE-17941080', {
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
    <audio id='audio' src="./music/BGM0.mp3" autoplay  loop style="display: none;"></audio>
    <audio id='music' src="" autoplay style="display: none;"></audio>
	<div id="Stage" class="EDGE-17941080" style="position: absolute;">
	</div>
</body>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
 <!--微信分享start-->
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
  
                var title = '吃货理论测试';     //分享标题
                var desc = '维他奶豆荚学院入学考!';      //分享描述
                var desc1 = '维他奶豆荚学院入学考!';      //分享描述
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

        function bf1(){
            $("#music").attr('src',"music/BGM1.mp3");
            $("#music").load();
            $("#music").play();
            console.log(111);
        }

        function bf2(){
            $("#music").attr('src',"music/BGM2.mp3");
            $("#music").load();
            $("#music").play();
            console.log(222);
        }

        function bf3(){
            $("#music").attr('src',"music/BGM3.mp3");
            $("#music").load();
            $("#music").play();
            console.log(222);
        }


        //解决iphone的播放问题,必须写
        document.addEventListener('DOMContentLoaded',function (){
             var audio = document.getElementById("audio");
             var music = document.getElementById("music");
                audio.play();
                music.play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
                music.play();
            }, false);
            audioAutoPlay();
        });
    </script>

   <!--  方法区域 -->
   <script type="text/javascript">
       function getNum($number){
        if ($number=="") {
            alert("您此次没有分数，请重新尝试！");
            window.location.href="index.php";
        }

          if ($number>90) {
             wordpic($number,"./hc_img/d.jpg");

          }else if($number>75){
             wordpic($number,"./hc_img/c.jpg");

          }else if($number>60){
             wordpic($number,"./hc_img/b.jpg");

          }else if($number>=0){
             wordpic($number,"./hc_img/a.jpg");
          }
       }
   </script>


    <script>

    // 合成文字图片
          function wordpic(wz,tp){

           var wd = 640;
           var he = 1008;

           if (parseInt(wz)==100) {
            //如果分数100，根据实际情况将字体
               var wz1wd =347;
               var wz1he = 168;
           }else{
               var wz1wd =365;
               var wz1he =168;
           }


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

            var img = new Image;
            img.src = tp;
            img.crossOrigin = 'Anonymous';

            img.onload = function () {
                // ctx.drawImage(img,0,0,1000,701);
                ctx.drawImage(img,0,0,wd,he);

                ctx.fillStyle = 'rgb(0,143,255)';   // 文字填充颜色
                ctx.font="45px Arial,Helvetica,sans-serif";  //字体和字体大小

                ctx.fillText(wz,wz1wd,wz1he);

                var base64 = c.toDataURL("image/jpeg",1);
                // var base64 = c.toDataURL("image/png");
                $("#Stage_p3_hc").append("<img src='"+base64+"' style='width:100%;height:100%'>").css("opacity",'0');
                // alert(base64);
                // picurl = base64.replace(/^data:image\/(jpeg|png|jpg);base64,/, "");

                // $.ajax({
                //          async: false,
                //          type: 'POST',
                //          dataType: 'JSON',
                //          url: 'uploadhcword.php',
                //          // timeout: '8000',//请求超时时间
                //          data: {dataimg:picurl},// 每次请求等待时间
                //          success: function(data,status){
                //                 hc_img = $.trim(data);
                //                 // $("#Stage_p3_hc").css("opacity",'0');让其透明
                //                 $("#Stage_p3_hc").append("<img src='"+data+"' style='width:100%;height:100%'>").css("opacity",'0');

                //          },

                //          // ajax超时,继续查询
                //          error:function(XMLHttpRequest,textStatus,errorThrown){
                //                     alert(XMLHttpRequest.status+","+XMLHttpRequest.readyState);
                //                     alert("您的网络不太好哦，请重新尝试一遍吧！");
                //                     window.location.href="index.php";
                //          }


                //     });

            }

        }



    </script>
</html>