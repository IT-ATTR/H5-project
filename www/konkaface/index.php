<?php
    require_once __DIR__ . '/../../wechat/jssdk.php';
    $signPackage = ( new jssdk() )->getSignPackage();
?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/backg.jpg);">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>康佳面子研究院</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-43763106 { visibility:hidden; }
        /* #Stage_p2_img, #Stage_p2_img img{
            width: 100%;
            -webkit-user-drag: none;
            -moz-user-drag: none;
            -ms-user-drag: none;
            user-drag: none;
        }

        #Stage_p3_yuan-div img{
          -webkit-user-select: text;
          user-select: text;
          -webkit-touch-callout: default;
        } */
    </style>
    <link rel="stylesheet" type="text/css" href="css/style.css">
<script>
   AdobeEdge.loadComposition('index', 'EDGE-43763106', {
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
	<div id="Stage" class="EDGE-43763106" style="position: absolute;">
	</div>
    <audio src="./music/BGM.mp3" autoplay autoloop loop style='display: none' id="audio"></audio>
</body>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/h5.fit.common.js"></script>
<script type="text/javascript" src="js/hammer.js"></script>
<script type="text/javascript" src="js/iscroll-zoom.js"></script>
<script type="text/javascript" src="js/jquery.photoClip1.js"></script>
<script type="text/javascript" src="js/swiper-3.4.2.min.js"></script>
<script type="text/javascript" src="js/touch-0.2.14.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
<script>
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
                        'uploadFile',
                        'getLocalImgData'
                     ]
            });

            wx.ready(function(){
                var title = '康佳面子研究院';     //分享标题
                var desc = '面子大福利大，来测测你的面子有多大!';      //分享描述
                var desc1 = '面子大福利大，来测测你的面子有多大!';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/kjface20181101/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/kjface20181101/index.php';   //分享链接
                var link_url="https://www.mrgcgz.com/h5/html/kjface20181101/index.php";          //分享完跳转链接

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
    <!-- 截图 -->
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

    <script type="text/javascript">
        //设置全局变量
        var localIds;//保存用户选择的照片
        var reallyImg;//base64位图片的字符串，用于后期合成
        var localData;//人脸测试的参数
        // var circleImg;//最后的圆形背景图
        var faceNum;//人脸大小范围值
        var imgpath;//图片的全路径
        var bgImg;//背景图片

        var evt = document.createEvent("HTMLEvents");
         evt.initEvent("loadPicOver", true, true);

        function openAblum(){
            wx.chooseImage({
                  count: 1,
                  sizeType: ['original', 'compressed'],
                  sourceType: ['album', 'camera'],
                  success (res) {

                      localIds = res.localIds;

                      wx.getLocalImgData({
                            localId: localIds[0],
                            success: function (res) {
                            var localImg = res.localData;
                            localImg = localImg.replace(/\r|\n/g, '').replace('data:image/jgp;base64,','')
                            //第一个替换的是换行符，第二个替换的是图片类型，因为在IOS机上测试时看到它的图片类型时jgp，
                            //这不知道时什么格式的图片，为了兼容其他设备就把它转为jpeg
                            // circleImg = 'data:image/jpeg;base64,'+localImg;
                            // alert(localImg);

                            $.ajax({
                                   type: 'POST',
                                   dataType: 'json',
                                   url: 'upload.php',
                                                 // timeout: '8000',//请求超时时间
                                   data: {localimg:localImg},// 每次请求等待时间
                                    success: function(data,status){
                                                            $("#img").val(data);
                                                            imgpath= $.trim(data);
                                                            //
                                                            document.dispatchEvent(evt);
                                                            setTimeout(() => {
                                                              $(".htmleaf-container").show();
                                                            }, 100)

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



        function isFace(){
            if (!localIds) {
                if (confirm("请先拍照或者选择照片之后再操作！")) {openAblum();}else{
                    window.location.reload();
                }
            }
            localData = reallyImg.replace(/\r|\n/g, '').replace('data:image/jpeg;base64,', '')

            $.ajax({
                                    type: "post",
                                    url: "https://aip.baidubce.com/rest/2.0/face/v3/detect?access_token=24.e7132453fc5ed4ffb320ca488535dcf4.2592000.1547776696.282335-14320007",
                                    async: true,
                                    data: {"image":localData,"image_type":"BASE64","face_field":"age,beauty,expression,face_shape,gender,glasses,landmark,race,quality,face_type"},
                                    dataType: "json",
                                    success: function(res) {
                                        if (!res.result) {
                                            alert("测面子要上传人脸照片哦！");
                                        }else{
                                            //将图片上人脸的大小传过来
                                            var faceArea = res.result.face_list[0].location.width;
                                            // alert(faceArea);
                                            isBigFace(faceArea);
                                            pdFace();

                                             var c = document.createElement('canvas'); //创建canvas元素
                                              var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

                                               var wd = 240;
                                               var he = 240;
                                               var imgwd= 240;
                                               var imghe = 240;


                                               c.width = wd;   //设置画布宽
                                               c.height = he;  //设置画布高
                                               //创建一个矩形画布 填充白色
                                               ctx.rect(0,0,c.width,c.height);
                                               ctx.fillStyle='#fff';
                                               ctx.fill();

                                                var i = new Image;
                                                i.src = imgpath;
                                                i.crossOrigin = 'Anonymous';
                                                i.onload = function(){
                                                       var range = i.height > i.width ? i.width : i.height;
                                                       // alert(imgpath+","+range);
                                                       ctx.drawImage(i,0,0,range,range,0,0,imgwd,imghe);

                                                        showImg = c.toDataURL("image/jpeg");
                                                        // alert(showImg);
                                                      //调用相应方法判断
                                                       $("#Stage_p3_yuan-div").html("").append("<img src='"+showImg+"' alt='' style='height:100%;width:100%;border-radius:50%'>");
                                                   }



                                        }
                                    },
                            });
        }

        function getNum(){
            return faceNum;
        }


        //判断脸部大小
        function isBigFace(faceArea){
            switch(true){
                case faceArea>500:
                 faceNum = 7;
                 hc(imgpath,"./images/bg7.png");
                break;
                case faceArea>450:
                 faceNum = 6;
                 hc(imgpath,"./images/bg6.png");
                break;
                case faceArea>400:
                 faceNum = 5;
                 hc(imgpath,"./images/bg5.png");
                break;
                case faceArea>300:
                 faceNum = 4;
                 hc(imgpath,"./images/bg4.png");
                break;
                case faceArea>200:
                 faceNum = 3;
                 hc(imgpath,"./images/bg3.png");
                break;
                case faceArea>100:
                 faceNum = 2;
                 hc(imgpath,"./images/bg2.png");
                break;
                default :
                 faceNum = 1;
                 hc(imgpath,"./images/bg1.png");
            }
        }


        //合成图片
        function hc(user,bg){
              var c = document.createElement('canvas'); //创建canvas元素
              var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

               var wd = 640;
               var he = 1008;
               var imgwd= 240;
               var imghe = 240;


               c.width = wd;   //设置画布宽
               c.height = he;  //设置画布高
               //创建一个矩形画布 填充白色
               ctx.rect(0,0,c.width,c.height);
               ctx.fillStyle='#fff';
               ctx.fill();

               var img = new Image;
               img.src = user;
               img.crossOrigin = 'Anonymous';
               img.addEventListener( "load",function(){
                        var rang = img.height > img.width ? img.width : img.height;
                        // ctx.drawImage(img,0,0,imgwd,imghe);
                        ctx.drawImage(img,0,0,rang,rang,200,280,imgwd,imghe);
                            // alert(xk);
                           var img1 = new Image;
                           img1.src = bg;
                            // alert(2);
                           img1.onload = function(){
                              //ctx.drawImage(img1,0,0,wd,he);
                              ctx.drawImage(img1,0,0,wd,he);
                              bgImg = c.toDataURL("image/jpeg");

                               $("#Stage_p3_ca-div").html("").append("<img src='"+bgImg+"' style='width:100%;height:100%;opacity:0'>");
                          }
               },false );

        }


    $("#clipArea").photoClip({
        width: 273,
        height: 375,
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
            reallyImg = dataURL;
        }
    });


        // $("#clipBtn").click(function(){
        $("#clipBtn").on('click',function(){
            $(".htmleaf-container").hide();
            if ($("#Stage_p2_img").html()=='') {
                sccg();
            }

            $("#Stage_p2_img").html("").append("<img src='"+reallyImg+"' alt='' style='width:100%;height:100%'>");
    });


        function play(){
            $("#audio")[0].play();
        }

        //暂停音乐
        function pause(){
            $("#audio")[0].pause();
        }

    </script>
</html>