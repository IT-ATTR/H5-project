<?php
    require_once "../jssdk1.php";
    if(!$_COOKIE['openid']){
      //填写自己微信的回调地址
            header("");
            die();
    }
?>
<!DOCTYPE html>
<html style="height:100%;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>珍惜餐桌时光 陪孩子好好吃饭</title>
  <style type="text/css" media="screen">
    body{
      background-image: url(images/backg.jpg);
    }
    .savePic{
      display: none;
    }
  </style>
            <link href="css/swiper.min.css" rel="stylesheet" type="text/css">
            <link href="css/choose.css" rel="stylesheet" type="text/css">
            <link href="css/scene.css" rel="stylesheet" type="text/css">
            <link href="css/style1.css" rel="stylesheet" type="text/css">
            <link href="css/choose_postcard.css" rel="stylesheet" type="text/css">

            <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/h5.fit.common.js"></script>
            <script type="text/javascript" src="js/iscroll-zoom.js"></script>
            <script type="text/javascript" src="js/hammer.js"></script>
            <script type="text/javascript" src="js/jquery.photoClip.js"></script>
            <script type="text/javascript" src="js/swiper-3.4.2.min.js"></script>
            <script type="text/javascript" src="js/touch-0.2.14.min.js"></script>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-787373 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-787373', {
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
<!-- <audio id="audio" src="music/BGM.mp3" autoplay="autoplay" loop="loop" style="display:none;"></audio> -->
<body style="margin:0;padding:0;">
	<div id="Stage" class="EDGE-787373" style="position: absolute;">
	</div>
    <!-- 自动播放背景音乐 -->
    <audio id='audio' src="" loop autoplay></audio>
    <script src="js/imgpreload.js"></script>
    <script src="js/touch-0.2.14.min.js"></script>
    <script src="js/common.js"></script>
    <script type="text/javascript">
    //配置相应的全局变量,想要操作的数据库表名称
    var projectName = "jzbb20180526";
</script>
   <!--微信分享start-->
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";

        //进行用户信息的首次录入
        var url= "";
        $.get(url,{"openid":openid,"nickname":nickname,"headimgurl":headimgurl,"projectName":projectName},function(){},"json");

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
                var title = '再不陪，孩子一转眼就长大了';     //分享标题
                var desc = '儿童节大礼已为您准备好!';      //分享描述
                var desc1 = '儿童节大礼已为您准备好!';      //分享描述
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
                       window.location.href = link_url;
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
                        window.location.href = link_url;
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
                       window.location.href = link_url;
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
                       window.location.href = link_url;
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
      var thumb;
    var evt = document.createEvent("HTMLEvents");
         evt.initEvent("loadPicOver", true, true);
    //开启相机功能
    function openCamera(){
          //让浮层先出来
          wx.chooseImage({
                               count: 1, // 默认9
                               //sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
                               sizeType: ['compressed'],
                               sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
                               success: function (res) {
                                   var localIds = res.localIds; // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片
                                  $(".htmleaf-container").show();
                                  // $(".photo-clip-view").css("margin-left","-490px");
                                  // $(".photo-clip-area").css("margin-left","-492px");
                                  // $(".photo-clip-mask-left").css("margin-right","490px");

                                   wx.uploadImage({
                                       localId: '' + localIds,
                                       isShowProgressTips: 1,
                                       success: function(res) {
                                           serverId = res.serverId;
                                           $.ajax({
                                                 type: 'POST',
                                                 dataType: 'text',
                                                 url: 'download_img.php',
                                                 // timeout: '8000',//请求超时时间
                                                 data: {serverid:serverId},// 每次请求等待时间
                                                 success: function(data,status){
                                                            thumb=$.trim(data);
                                                            $("#img").val(thumb);
                                                            document.dispatchEvent(evt);
                                                            //压缩后的图片thumb_
                                                            // alert("双指捏合可旋转图片!");
                                                 },
                                                 // ajax超时,继续查询
                                                 error:function(XMLHttpRequest,textStatus,errorThrown){
                                                            alert("你的网络不太好哦，请重新上传吧！")
                                                            window.location.href="index.php";
                                                 }
                                           });
                                        },
                                    });
                               }
                        });
         }
</script>

 <input type="hidden" id="img">
    <article class="htmleaf-container">
        <div id="clipArea"></div>
        <div class="foot-use">
            <div class="uploader1 blue">
                <input type="button" id="file"   class="button"  style="display:none;">
            </div>
            <button id="clipBtn"></button>
        </div>
        <div id="view"></div>
    </article>

    <script>
    var obUrl = ''
    var picurl1;
    var picurl;
    var hc_img;
    var return_img;

    var wd = $(window).width()*0.9;
    var he = $(window).height()*0.6;
    // var wd = 640;
    // var he = 604;

    $("#clipArea").photoClip({
        width: wd,
        height: he,
        file: "#file",
        view: "#view",
        ok: "#clipBtn",
        strictSize:true,    //是否严格按照截取区域宽高裁剪
        loadStart: function() {
            console.log("照片读取中");
        },
        loadComplete: function() {
            console.log("照片读取完成");
        },
        clipFinish: function(dataURL) {
            $.ajaxSettings.async = false;
            $.ajax({
                                                     type: 'POST',
                                                     dataType: 'text',
                                                     url: 'upload.php',
                                                     data: {"dataimg":dataURL},
                                                     success: function(data,status){
                                                                return_img = $.trim(data);
                                                                alert('图片裁剪成功');
                                                                $(".htmleaf-container").hide();
                                                                scwb();
                                                                $("#Stage_p3_div1").append('<img src="'+ return_img+'" style=" width: 100%;height: 100%;">');
                                                     },
                                                     // ajax超时,继续查询
                                                     error:function(XMLHttpRequest,textStatus,errorThrown){
                                                                alert("网络不好，请重新上传！");
                                                                window.location.href="index.php";
                                                     }
            });
        }
    });
    </script>


  <script type="text/javascript">
    var xcvl;
    function xcvalue(xcv){
        return xcvl=xcv;
    }

    //进行照片合成
      function hc(){
                var xkpic= "./images/img/xc"+xcvl+".png";
                draw(return_img,xkpic,xcvl);
    }
             //合成图片
            function draw(jt,xk,xcv){

               var c = document.createElement('canvas'); //创建canvas元素
               var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

               var wd = 640;
               var he = 1008;

               switch(xcv){
                case 1:
                   var imgwd= 579;
                   var imghe = 580;
                break;
                case 2:
                   var imgwd= 579;
                   var imghe = 580;
                break;
                case 3:
                   var imgwd= 500;
                   var imghe = 500;
                break;
                case 4:
                   var imgwd= 458;
                   var imghe = 458;
                break;
                case 5:
                   var imgwd= 340;
                   var imghe = 340;
                break;
               }

               c.width = wd;   //设置画布宽
               c.height = he;  //设置画布高

               //创建一个矩形画布 填充白色
               ctx.rect(0,0,c.width,c.height);
               ctx.fillStyle='#fff';
               ctx.fill();

               var img = new Image;

               // jtpic = get_jtpic();
               img.src = jt;

               img.onload =function(){
          switch(xcv){
            case 1:
            ctx.drawImage(img,30,73,imgwd,imghe);
            break;
            case 2:
            ctx.drawImage(img,30,73,imgwd,imghe);
            break;
            case 3:
            ctx.drawImage(img,71,92,imgwd,imghe);
            break;
            case 4:
            ctx.drawImage(img,91,141,imgwd,imghe);
            break;
            case 5:
            ctx.drawImage(img,142,214,imgwd,imghe);
            break;
            
          }
                   // ctx.drawImage(img,29,279,584,584);
                   var img2 = new Image;
                   // xkpic = getQueryString('xk');
                   // img2.src = './images/'+xkpic+'.png';
                   img2.src = xk;

                   img2.onload = function(){
                      // ctx.drawImage(img2,0,0,640,1008);
                      ctx.drawImage(img2,0,0,wd,he);
                      // var base64 = c.toDataURL("image/jpeg");
                      var base64 = c.toDataURL("image/png");
                      picurl = base64.replace(/^data:image\/(jpeg|png|jpg);base64,/, "");
                      base64_zm();
                   }
               }

            }



            //base64图片转码
            function base64_zm(){
                  $.ajax({
                             async: false,
                             type: 'POST',
                             dataType: 'text',
                             url: 'uploadhcpic.php',
                             // timeout: '8000',//请求超时时间
                             data: {dataimg:picurl},// 每次请求等待时间
                             success: function(data,status){
                                        //合成图片的上传
                                        mixPic = $.trim(data);
                                        schc();
                                        $("#Stage_p4_div2").css({"position":"fixed","z-index":"5"});
                                        $("#Stage_p4_div2").append("<img src='' id='mixpic' style='height:100%;width:100%;'/>");
                                        $("#mixpic").attr("src",mixPic);

                                        var url='';
                                       $.get(url,{"openid":openid,"projectName":projectName,"mixPic":mixPic}, function(){
                                              //进行上传图片的删除
                                       },"json");
                             },
                             // ajax超时,继续查询
                             error:function(XMLHttpRequest,textStatus,errorThrown){
                                           alert("您的网络不太好哦，请重新打开！");
                                           window.location.href="index.php";
                             }
                        });

            }


            //设置显示层级
            function showLelve(){
              $("#Stage_p4_black").css({"position":"fixed","z-index":"6"});
              $("#Stage_p4_p112").css({"position":"fixed","z-index":"7"});
            }

            //播放音乐
        function play(){
            audio.play();
            console.log('播放');
        }

        //暂停音乐
        function pause(){
            audio.pause();
            console.log('暂停');
        }
  </script>
</body>

</html>