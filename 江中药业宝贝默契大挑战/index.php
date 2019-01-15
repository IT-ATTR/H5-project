<?php
    require_once "../jssdk1.php";
    if(!$_COOKIE['openid']){
            header("location:../../../wx_login2.php?id=6&url=https://www.mrgcgz.com/h5/html/jzbb20180620/index.php");
            die();
    }
 ?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/backg.jpg);background-color: #000;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
	<title>宝贝默契大挑战</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" src="edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-1855833 { visibility:hidden; }
        #canvas1,#canvas2{
            position: absolute;
            left: 8%;
            top: 21%;
            display: none;
        }
    </style>
<script>
   AdobeEdge.loadComposition('index1', 'EDGE-1855833', {
    scaleToFit: "none",
    centerStage: "none",
    minW: "0%",
    maxW: "undefined",
    width: "100%",
    height: "100%"
}, {"dom":{}}, {"dom":{}});

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
        //alert(pheight);
        
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
<!-- 百度统计代码 -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?1c2ebd16ec91929be57021c84c3170cf";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body style="margin:0;padding:0;">
    <audio src="./music/BGM.mp3" autoplay loop style="display: none;" id="audio"></audio>
	<div id="Stage" class="EDGE-1855833" style="position: absolute;">
	</div>
    <canvas id="canvas1"></canvas>
    <canvas id="canvas2"></canvas>
</body>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<!-- <script type="text/javascript" src="js/common.js"></script> -->
<script type="text/javascript" src="js/touch-0.2.14.min.js"></script>
<script type="text/javascript" src="js/imgpreload.js"></script>
<script src="js/touch-0.2.14.min.js"></script>
<script type="text/javascript">
    //配置相应的全局变量,想要操作的数据库表名称
    var projectName = "jzbb20180620";
</script>
 <!--微信分享start-->
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";

        $.ajaxSettings.async = false;
        //进行微信用户信息的首次入库，用于判断后来是否可以再次中奖
        var url1= "https://www.mrgcgz.com/myAdmin/index.php/Admin/Project/userinfo";
        $.get(url1,{"openid":openid,"nickname":nickname,"headimgurl":headimgurl,"projectName":projectName},function(){},"json");

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

                var title = '亲子默契大考验，敢不敢来试试？';     //分享标题
                var desc = '丰富好礼等着你哟～!';      //分享描述
                var desc1 = '丰富好礼等着你哟～!';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/jzbb20180620/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/jzbb20180620/index.php';   //分享链接
                var link_url="https://www.mrgcgz.com/h5/html/jzbb20180620/index.php";          //分享完跳转链接

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
     var Pic1;
     var Pic2;
     var data=["./images/hc.jpg"];
     var word=[];
     var base64=[];
     var hcimg;
     var cwidth = document.body.clientWidth;
     var cheight = $(window).height();
     // 画第一张图
    var canvas1 = document.getElementById("canvas1");
    canvas1.addEventListener('mousemove', onMouseMove1, false);
    canvas1.addEventListener('mousedown', onMouseDown1, false);
    canvas1.addEventListener('mouseup', onMouseUp1, false);

    canvas1.addEventListener('touchstart',onMouseDown1,false);
    canvas1.addEventListener('touchmove',onMouseMove1,false);
    canvas1.addEventListener('touchend',onMouseUp1,false)

    canvas1.width = cwidth*0.8;
    canvas1.height = cheight*0.6;

    var ctx1 = canvas1.getContext('2d');
    ctx1.strokeStyle = "#000"; // 设置线的颜色

    var flag1 = false;

    function onMouseDown1(evt){
            evt.preventDefault();
            ctx1.beginPath();
            var p = pos(evt);
            ctx1.moveTo(p.x, p.y);
            ctx1.lineWidth = 2.0; // 设置线宽
            // ctx1.shadowColor = "#FFFFFF";
            ctx1.shadowBlur = 1;
            flag1 = true;
    }

    function onMouseMove1(evt){
            evt.preventDefault();
            if (flag1){
                var p = pos(evt);
                ctx1.lineTo(p.x, p.y);
                //ctx1.shadowOffsetX = 6;
                ctx1.stroke();
            }
    }

        function onMouseUp1(evt){
                evt.preventDefault();
                flag1 = false;
        }

        function clearRect1(){
            ctx1.clearRect(0, 0, canvas1.width, canvas1.height);
        }


        //画第二张图
    var canvas2 = document.getElementById("canvas2");
    canvas2.addEventListener('mousemove', onMouseMove2, false);
    canvas2.addEventListener('mousedown', onMouseDown2, false);
    canvas2.addEventListener('mouseup', onMouseUp2, false);

    canvas2.addEventListener('touchstart',onMouseDown2,false);
    canvas2.addEventListener('touchmove',onMouseMove2,false);
    canvas2.addEventListener('touchend',onMouseUp2,false)

    canvas2.width = cwidth*0.8;
    canvas2.height = cheight*0.6;

    var ctx2 = canvas2.getContext('2d');
    ctx2.strokeStyle = "#000"; // 设置线的颜色

    var flag2 = false;

        function onMouseDown2(evt){
                evt.preventDefault();
                ctx2.beginPath();
                var p = pos(evt);
                ctx2.moveTo(p.x, p.y);
                ctx2.lineWidth = 2.0; // 设置线宽
                // ctx2.shadowColor = "#FFFFFF";
                ctx2.shadowBlur = 1;
                flag2 = true;
        }

        function onMouseMove2(evt){
                evt.preventDefault();
                if (flag2){
                    var p = pos(evt);
                    ctx2.lineTo(p.x, p.y);
                    //ctx2.shadowOffsetX = 6;
                    ctx2.stroke();
                }
        }

        function onMouseUp2(evt){
                evt.preventDefault();
                flag2 = false;
        }

        function clearRect2(){
            ctx2.clearRect(0, 0, canvas2.width, canvas2.height);
        }

        //画第二张图结束
        function pos(event){
            var x,y;
            var pxx,pyy;
            if(isTouch(event)){
                //手机触屏开始画图的坐标，根据实际情况进行微调
                pxx = 50;
                pyy = 300;

                x = event.touches[0].pageX-pxx;
                y = event.touches[0].pageY-pyy;

            }else{
                x = event.layerX;
                y = event.layerY;
            }
                return {x:x,y:y};
            }

        function isTouch(event){
            var type = event.type;
            if(type.indexOf('touch')>=0){
                return true;
            }else{
                return false;
            }
        }

        function showCanvas1(){
            $("#canvas1").css("display","block");
        }

       function hideCanvas1(){
            var Pic1 = document.getElementById("canvas1").toDataURL("image/png");
            data.push(Pic1);
            // document.getElementById("Stage_p2_draw").setAttribute("src",Pic);
            $("#Stage_p2_sr_draw").append("<img src='"+Pic1+"' width='100%' height='100%'>");

            $("#canvas1").css("display","none");
         }

        function showCanvas2(){
            $("#canvas2").css("display","block");
        }


       function hideCanvas2(){
            var Pic2 = document.getElementById("canvas2").toDataURL("image/png");
             $("#canvas2").css("display","none");
            $("#Stage_p2_sr_draw2").append("<img src='"+Pic2+"' width='100%' height='100%'>");

            data.push(Pic2);

            // document.getElementById("Stage_p2_draw").setAttribute("src",Pic);

         }


          //接收前台所有用于图片的信息
          //
        function getPicAcount(param){
                var arr = param.split(",");
                // var arr =["./images/"+pic1+".png",pic2,"./images/sex"+pic3+".png",pic4,pic5];
                for (var i = 0; i < 5; i++) {
                    if (i==0) {
                        data.push("./images/"+arr[i]+".png");
                    }else if(i ==2){
                        data.push("./images/sex"+arr[i]+".png");
                    }else{
                        word.push(arr[i]);
                    }
                }
                // console.log(data);
                // console.log(word);
                 //进行最终图片的合成
                draw();
        }

         //进行多张图片的合成
        // var data=['./4.jpg','./3.jpg','./zpp.png'],base64=[];
        function draw(fn){
            var c=document.createElement('canvas'),
            ctx=c.getContext('2d'),
            len=data.length;
            c.width=656;
            c.height=1760;
            // console.log("width:"+c.width+",height"+c.height);

            ctx.rect(0,0,c.width,c.height);
            ctx.fillStyle='#fff';
            ctx.fill();
            function drawing(n){
                if(n<len){
                    var img=new Image;
                    // img.crossOrigin = 'Anonymous'; //解决跨域
                    img.src=data[n];
                img.onload=function(){
                    if(n==0){
                            ctx.drawImage(img,0,0,c.width,c.height);
                            // ctx.fillStyle = '#ffce00';   // 文字填充颜色
                            // ctx.font="2em stxingka";  //字体和字体大小
                            //设置阴影
                        }else if(n==1){
                            //宝宝的图
                            ctx.drawImage(img,656*0.143,1760*0.517,656*0.712,1760*0.184);
                        }else if(n==2){
                            //父母的图
                            ctx.drawImage(img,656*0.143,1760*0.743,656*0.712,1760*0.184);
                        }else if(n==3){
                            //星星图
                            ctx.drawImage(img,656*0.168,1760*0.069,656*0.663,1760*0.222);
                        }else if(n==4){
                            //性别图
                            ctx.drawImage(img,656*0.143,1760*0.385,656*0.28,1760*0.014);
                        }
                        drawing(n+1);//递归
                    }
                }else{
                    //保存生成作品图片
                    base64.push(c.toDataURL("image/png"));
                    //alert(JSON.stringify(base64));
                    var hcimg = base64[0];
                    //进行文字合成
                    // console.log(word);
                    // alert("图片合成成功");

                     wordpic1(word[0],hcimg);

                    fn();
                }
            }
            drawing(0);
        }
    </script>

    <script type="text/javascript">
          // 文字合成
         function wordpic1(wz,tp){
           var c = document.createElement('canvas'); //创建canvas元素
           var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

           c.width= 656;    //设置画布宽
           c.height= 1760;   //设置画布高

           //创建一个矩形画布 填充白色
           ctx.rect(0,0,c.width,c.height);
           ctx.fillStyle='#FFFFFF';
           ctx.fill();

            var img = new Image;
            img.src = tp;


            img.onload = function () {
                // ctx.drawImage(img,0,0,1000,701);
                ctx.drawImage(img,0,0,c.width,c.height);

                ctx.fillStyle = '#ffce00';   // 文字填充颜色
                ctx.font="2em stxingka";  //字体和字体大小
                ctx.shadowColor = '#444444';
                // 将阴影向右移动1px，向上移动1px
                ctx.shadowOffsetX = 1;
                ctx.shadowOffsetY = 1;
                // 轻微模糊阴影
                ctx.shadowBlur = 2;

                if(wz.length>23){
                  wz1 =  wz.substr(0,23);
                  wz2 =  wz.substr(23,wz.length-23);
                  ctx.fillText(wz1,656*0.143,1760*0.362);
                  ctx.fillText(wz2,656*0.143,1760*0.377);
                }else{
                  // wz1 = wz;
                  // ctx.fillText(wz1,wz1wd,wz1he);
                  ctx.fillText(wz,656*0.143,1760*0.362);
                }


                // var base64 = c.toDataURL("image/jpeg");
                var zhcimg1 = c.toDataURL("image/png");
                // alert("第一张文字合成成功");

                wordpic2(word[1],zhcimg1);

            }
        }
    </script>


    <script type="text/javascript">
          // 文字合成
         function wordpic2(wz,tp){
           var c = document.createElement('canvas'); //创建canvas元素
           var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

           c.width= 656;    //设置画布宽
           c.height= 1760;   //设置画布高

           //创建一个矩形画布 填充白色
           ctx.rect(0,0,c.width,c.height);
           ctx.fillStyle='#FFFFFF';
           ctx.fill();

            var img = new Image;
            img.src = tp;


            img.onload = function () {
                // ctx.drawImage(img,0,0,1000,701);
                ctx.drawImage(img,0,0,c.width,c.height);

                ctx.fillStyle = '#ffce00';   // 文字填充颜色
                ctx.font="2em stxingka";  //字体和字体大小
                ctx.shadowColor = '#444444';
                // 将阴影向右移动1px，向上移动1px
                ctx.shadowOffsetX = 1;
                ctx.shadowOffsetY = 1;
                // 轻微模糊阴影
                ctx.shadowBlur = 2;

                if(wz.length>23){
                  wz1 =  wz.substr(0,23);
                  wz2 =  wz.substr(23,wz.length-23);
                  ctx.fillText(wz1,656*0.143,1760*0.412);
                  ctx.fillText(wz2,656*0.143,1760*0.427);
                }else{
                  // wz1 = wz;
                  // ctx.fillText(wz1,wz1wd,wz1he);
                  ctx.fillText(wz,656*0.143,1760*0.412);
                }


                // var base64 = c.toDataURL("image/jpeg");
                var zhcimg2 = c.toDataURL("image/png");
                // alert("第二张文字合成成功");
                wordpic3(word[2],zhcimg2);

            }
        }
    </script>


    <script type="text/javascript">
          // 文字合成
         function wordpic3(wz,tp){
           var c = document.createElement('canvas'); //创建canvas元素
           var ctx = c.getContext('2d'); //getContext() 方法返回一个用于在画布上绘图的环境。目前仅支持2d

           c.width= 656;    //设置画布宽
           c.height= 1760;   //设置画布高

           //创建一个矩形画布 填充白色
           ctx.rect(0,0,c.width,c.height);
           ctx.fillStyle='#FFFFFF';
           ctx.fill();

            var img = new Image;
            img.src = tp;


            img.onload = function () {
                // ctx.drawImage(img,0,0,1000,701);
                ctx.drawImage(img,0,0,c.width,c.height);

                ctx.fillStyle = '#ffce00';   // 文字填充颜色
                ctx.font="2em stxingka";  //字体和字体大小
                ctx.shadowColor = '#444444';
                // 将阴影向右移动1px，向上移动1px
                ctx.shadowOffsetX = 1;
                ctx.shadowOffsetY = 1;
                // 轻微模糊阴影
                ctx.shadowBlur = 2;

                if(wz.length>23){
                  wz1 =  wz.substr(0,23);
                  wz2 =  wz.substr(23,wz.length-23);
                  ctx.fillText(wz1,656*0.143,1760*0.469);
                  ctx.fillText(wz2,656*0.143,1760*0.485);
                }else{
                  // wz1 = wz;
                  // ctx.fillText(wz1,wz1wd,wz1he);
                  ctx.fillText(wz,656*0.143,1760*0.469);
                }


                // var base64 = c.toDataURL("image/jpeg");
                var zhcimg3 = c.toDataURL("image/png");
                // alert("第三张文字合成成功");
                //将合成的图片进行展示；
                    $("#Stage_p2_sr_div_ca").append("<img src='"+zhcimg3+"' width='100%' height='100%'>").css("opacity","0");
                    // alert("图片展示成功，开始播放动画");
                    schc();
            }
        }
    </script>

    <script type="text/javascript">
        //音乐暂停和播放
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

    <script type="text/javascript">
        var zjnum;
        //抽奖方法开始
        function lotto(){
            var url = "https://www.mrgcgz.com/myAdmin/index.php/admin/Api/getNum";
            $.get(url,{"openid":openid,"projectName":projectName},function(res){
                //传中奖数值给前台
                     zjnum = res;
            },"json");

           return zjnum;
        }


        //获取用户填写的信息
        function add_entityreward(str1,str2,str3){
            var name = str1;
            var phone = str2;
            var address = str3;
            var num;

            //进行用户填写的信息入库
            var url = "https://www.mrgcgz.com/myAdmin/index.php/admin/Api/userAddress";
            $.get(url,{"openid":openid,"projectName":projectName,"name":name,"phone":phone,"address":address,"zjnum":zjnum},function(res){
                if (res =="success") {
                    //表示入库成功
                     num = 1;
                }
            },"json");

            return num;
        }
    </script>
</html>