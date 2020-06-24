<?php
    require_once "../jssdk1.php";
    if(!$_COOKIE['openid']){
            header("location:../../../wx_login2.php?id=4&url=https://www.mrgcgz.com/h5/html/sfyx20181225/index.php");
            die();
    }
 ?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/backg.jpg);">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>2019吃货生存技巧</title>
    <!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="https://animate.adobe.com/runtime/6.0.0/edge.6.0.0.min.js"></script>
    <script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <style>
        .edgeLoad-EDGE-37292765 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-37292765', {
    scaleToFit: "none",
    centerStage: "none",
    minW: "0%",
    maxW: "undefined",
    width: "100%",
    height: "100%"
}, {"style":{"${symbolSelector}":{"isStage":"true","rect":["undefined","undefined","640px","1008px"]}},"dom":[{"rect":["0%","0%","100%","100%","auto","auto"],"id":"loading","fill":["rgba(0,0,0,0)","images/loading.gif","0px","0px"],"type":"image","tag":"img"}]}, {"dom":{}});


    var cWidth5;
    var cHeight5;
    var pheight5;
    var bheight5;
    var theight5;
    var ttheight5;
    window.onload = function(){
        // 获取屏幕高度
        cWidth5=window.screen.width;
        //alert(cWidth);
        // 获取屏幕宽度 
        cHeight5=window.screen.height;
        //alert(cHeight);

        // 计算出的高度
        pheight5=cWidth5*1138/640;

        // 计算出的显示高度占屏幕的百分比
        bheight5=(pheight5/cHeight5*100)+"%";
        //alert(bheight);

        $("body").height(bheight5);//更改body高度

        if(cHeight5>800){
            theight5=(cHeight5-pheight5)/cHeight5;
            ttheight5=(theight5/2)*100+"%";
        }else{
            theight5=(cHeight5-pheight5)/cHeight5;
            ttheight5=(theight5/2)*100+"%";
        }

        $("#Stage").css("top",ttheight5);
    }
</script>
<!--Adobe Edge Runtime End-->

</head>
<body style="margin:0;padding:0;">
    <img src="./images/loading.gif" id="loading" width="100%" height="100%">
    <audio src="./music/BGM.mp3" id="audio" loop autoplay style="display: none"></audio>
    <audio src="" id="music" loop autoplay style="display: none"></audio>
	<div id="Stage" class="EDGE-37292765" style="position: absolute;">
	</div>
</body>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/h5.fit.common.js"></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
        //配置相应的全局变量,想要操作的数据库表名称
        var projectName = "sfyx20181225";

        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";
        // alert(nickname+headimgurl);
        $.ajaxSettings.async = false;
        //进行用户信息的首次录入
        var url= "https://www.mrgcgz.com/myAdmin/index.php/Admin/Project/";
        $.get(url+"userinfo",{"openid":openid,"nickname":nickname,"headimgurl":headimgurl,"projectName":projectName},function(res){},"json");

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

                var title = '2019吃货生存技巧！';     //分享标题
                var desc = '来看看吃货的你2019年该如何生存~';      //分享描述
                var desc1 = '来看看吃货的你2019年该如何生存~';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/sfyx20181225/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/sfyx20181225/index.php';   //分享链接
                var link_url="https://www.mrgcgz.com/h5/html/sfyx20181225/index.php";   //分享完跳转链接

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
<!-- 印上图片 -->
<script type="text/javascript">
    $("#Stage").hide();
      function aa(){
        if ($("#Stage_p1").length>0) {
          $("#loading").hide();
          $("#Stage").show();
          window.clearTimeout(t1);
      }
      
      }
  var t1=window.setInterval(aa,1000);


  $(function(){
    // $("#loading").hide();

    $.ajaxSettings.async = true;

    $.get("./upload.php",{"openid":openid,"headimgurl":headimgurl,"projectName":projectName},function(res){
           console.log(res);
      },"json");

    $.ajaxSettings.async = false;
  });

    function userInfo(){
        $('#Stage_p2_head').append("<img src='"+headimgurl+"' style='width:100%;height:100%;border-radius:50%'/>");

        $("#Stage_p2_name").find('p').css({'text-align':"center"}).find("span").html(nickname);
    }

    function clearUser(){
        $('#Stage_p2_head').html("").append("<img src='"+headimgurl+"' style='width:100%;height:100%;border-radius:50%'/>");
    }
</script>
<!-- 微信分享end -->


<!-- 判定是不是会员 -->
<script type="text/javascript">

    function isVip(phone){
               var num = 0;

                //表明用户没有抽奖
                $.ajaxSettings.async = false;
                $.post("https://m.sfbest.com/regsend/verifyUserName",{"userName":phone},function(res){
                   if (res.code == 10310010) {
                    //获取新人礼包注册界面
                    num = 1;
                   }else{
                    //VIP已经存在10310009用户已经存在
                    num = 2;
                   }

                   //然后进行手机号入库
                  $.get(url+"sfyx20181225",{"openid":openid,"projectName":projectName,"phone":phone},function(res){},'json');

         },"json");

         // console.log(num)
         return num;

    }



     //合成图片
   function cz(val){

        var shareText;
        switch(val){
          case 1:
          shareText = "出轨";
          break;
          case 2:
          shareText = "剁手";
          break;
          case 3:
          shareText = "家暴";
          break;
          case 4:
          shareText = "精分";
          break;
          case 5:
          shareText = "巨婴";
          break;
          case 6:
          shareText = "破产";
          break;
          case 7:
          shareText = "撕逼";
          break;
          case 8:
          shareText = "整容";
          break;
          default:
          shareText = "18禁";
          break;

        }

            var title    = '2019吃货生存技巧！';     //分享标题
            var desc     = '擦！2019我居然要靠【'+shareText+'】活下去！快进来领平衡车和无人机吧！';      //分享描述
            var desc1    = '擦！2019我居然要靠【'+shareText+'】活下去！快进来领平衡车和无人机吧！';      //分享描述
            var imgurl   = 'https://www.mrgcgz.com/h5/html/sfyx20181225/icon.jpg';  //分享图片
            var shareurl = "https://www.mrgcgz.com/h5/html/sfyx20181225/index.php";

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
                       console.log(shareurl);
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



             $.get(url+"getUserPic",{"openid":openid,"projectName":projectName},function(res){ 

                           var c = document.createElement('canvas'); //创建canvas元素
                           var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

                           var wd = 640;
                           var he = 1008;

                           c.width = wd;   //设置画布宽
                           c.height = he;  //设置画布高
                           //创建一个矩形画布 填充白色
                           ctx.rect(0,0,c.width,c.height);
                           ctx.fillStyle='#fff';
                           ctx.fill();

                           var img = new Image;

                           img.src = "./upload/"+res;
                           img.crossOrigin = 'Anonymous';


                           img.addEventListener( "load",function(){

                                    ctx.drawImage(img,18,34,100,100);


                                       var img1 = new Image;


                                       img1.src = "./images/sc"+val+".png";
                                       img1.crossOrigin = 'Anonymous';
                                       img1.addEventListener( "load", function(){
                                          ctx.drawImage(img1,0,0,wd,he);

                                            ctx.fillStyle = 'rgb(0,0,0)';   // 文字填充颜色
                                            ctx.font="3em Arial, Helvetica, sans-serif";  //字体和字体大小

                                            //移轴居中设置
                                            ctx.textAlign='center';
                                            var wz1wd =250;
                                            var wz1he = 100;

                                            ctx.fillText(nickname,wz1wd,wz1he);
   
                                            var bgImg = c.toDataURL("image/jpeg");



                                           $("#Stage_p2_ca").html("").append("<img src='"+bgImg+"' style='width:100%;height:100%'>").css({'opacity':0});


                                      },false);

                                        },false );

             },"json");
}

</script>

<script type="text/javascript">
    var audio = document.getElementById("audio");
    var music = document.getElementById("music");

    function bf(){
            audio.play();
        }


    function bgmusic(param){
        switch(param){
            case 1:
            music.src = "./music/BGM1.mp3";
            music.play();
            break;
            case 2:
            music.src = "./music/BGM2.mp3";
            music.play();
            bf();
            break;
            default:
            music.src='';
            music.pause();
            break;
        }

    }

        //暂停音乐
        function zt(){
            audio.pause();
        }

         //解决iphone的播放问题,必须写
        document.addEventListener('DOMContentLoaded',function (){
                audio.play();
                music.play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
                music.play();
            }, false);
            // audioAutoPlay();
        });

</script>


<!-- 防止页面滚动 -->
<script type="text/javascript">
    $(document).on("blur focus","input",function(){
      window.scroll(0,0);
    });
</script>



<script type="text/javascript">
       var sessId;
      //浏览器唯一标识
      $.ajaxSettings.async = false;
      //获取sessionid
        $.post("https://m.sfbest.com/regsend/getSessionId","",function(res){
             sessId = res.data;
         },"json");


   //进行验证码的显示
  function showCode(){

      var xmlhttp=new XMLHttpRequest();
      xmlhttp.open("POST","https://m.sfbest.com/regsend/getCode",true);
      xmlhttp.responseType = "blob";
      xmlhttp.onload = function(){

          if (this.status == 200) {
              var blob = this.response;

              var img = document.createElement("img");
              img.onload = function(e) {
                  window.URL.revokeObjectURL(img.src);
              };
              img.src = window.URL.createObjectURL(blob);
              img.style.width="100%";
              img.style.height="100%";


              $("#Stage_p3_yzm-tt").append(img);
              // document.body.appendChild(img);
          }
      }


          xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          xmlhttp.send("sessionId="+sessId);


  }



  //发送手机验证码
  function sendSms(mobile,code){
    var status;
    $.ajaxSettings.async = false;
    //获取sessionid
    $.post("https://m.sfbest.com/regsend/sendSms",{"mobile":mobile,"verifyCode":code,"sessionId":sessId},function(res){
      //发送信息
      res.code == "10310000" ? status=1 : status=0;
    },"json");
    return status;
  }


  //点击注册
  function register(moblie,smsCode){
    var zc;
    $.ajaxSettings.async = false;
  $.post("https://m.sfbest.com/regsend/doActivityRegist",{"mobile":moblie,"smsCode":smsCode},function(res){
      res.code=="10310000" ? zc = 1 : zc=0;
    },"json");
  return zc;

}

</script>

</html>