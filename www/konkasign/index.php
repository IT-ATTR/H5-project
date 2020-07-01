<?php
    require_once __DIR__ . '/../../wechat/jssdk.php';
    $signPackage = ( new jssdk() )->getSignPackage();

    if(!$_SESSION['openid']){
        header("Location:http://hd.520web.cn/wechat/connect.php?goto_url=http://hd.520web.cn/konkasign/");
    }
?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/backg.jpg);background-color: #000;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>签名助力为国品康佳添力量</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="edge_includes/edge.6.0.0.min.js"></script>
    <style>
        .edgeLoad-EDGE-4531241 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index', 'EDGE-4531241', {
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

</head>
<body style="margin:0;padding:0;">
    <audio src="./music/BGM.mp3" id="audio" autoplay  loop  style="display: none"></audio>
	<div id="Stage" class="EDGE-4531241" style="position: absolute;">
	</div>
</body>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<!--微信分享start-->
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
        var projectName = "kjqm20190107";
        var name;//用户领奖姓名
        var mobile;//用户领奖手机号码
        var addr;//用户领奖地址
        var QQ;//用户领奖QQ
        var prize;//用户的奖品
        var is_touch=false;//判定用户是否画图
        var prizeTime;//初始化抽奖次数
        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";

        $.ajaxSettings.async = false;
        //进行微信用户信息的首次入库，用于判断后来是否可以再次中奖
        var url= "https://www.mrgcgz.com/myAdmin/index.php/Admin/Project/";
        $.get(url+"userinfo",{"openid":openid,"nickname":nickname,"headimgurl":headimgurl,"projectName":projectName},function(res){},"json");


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

                var title = '征集签名为国品康佳送祝福';     //分享标题
                var desc = '贺康佳入选2019cctv国家品牌计划TOP品牌！!';      //分享描述
                var desc1 = '贺康佳入选2019cctv国家品牌计划TOP品牌！!';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/kjqm20190107/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/kjqm20190107/index.php';   //分享链接
                var link_url="https://www.mrgcgz.com/h5/html/kjqm20190107/index.php";          //分享完跳转链接

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
                       shareFinsh();

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
                        shareFinsh();
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

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/h5.fit.common.js"></script>
<script type="text/javascript" src="js/touch-0.2.14.min.js"></script>
<script type="text/javascript" src="js/imgpreload.js"></script>
<script type="text/javascript" src="js/touch-0.2.14.min.js"></script>
<script type="text/javascript">

        //加载完毕创建Canvas
        var canvas  = document.createElement("canvas");

        canvas.addEventListener('mousemove', onMouseMove, false);
        canvas.addEventListener('mousedown', onMouseDown, false);
        canvas.addEventListener('mouseup', onMouseUp, false);

        canvas.addEventListener('touchstart',onMouseDown,false);
        canvas.addEventListener('touchmove',onMouseMove,false);
        canvas.addEventListener('touchend',onMouseUp,false);

        var ctx = canvas.getContext('2d');
        // ctx.fillStyle = "#f00"; // 设置线的颜色

        var flag = false;


    //将canvas追加到相应的位置
    function appendCanvas(){
        canvas.width = $("#Stage_p2_qm_div").width();
        canvas.height = $("#Stage_p2_qm_div").height();
        ctx.strokeStyle = "#fff"; // 设置线的颜色
        ctx.lineWidth = 4.0; // 设置线宽

        $("#Stage_p2_qm_div").append(canvas);
    }


    function onMouseDown(evt){
            evt.preventDefault();
            ctx.beginPath();
            var p = pos(evt);
            ctx.moveTo(p.x, p.y);
            // ctx.shadowColor = "#FFFFFF";
            ctx.shadowBlur = 1;
            flag = true;
    }

    function onMouseMove(evt){
            evt.preventDefault();
            if (flag){
                var p = pos(evt);
                ctx.lineTo(p.x, p.y);
                //ctx.shadowOffsetX = 6;
                ctx.stroke();
            }
    }

        function onMouseUp(evt){
                evt.preventDefault();
                flag = false;
        }


        function pos(event){
            var x,y;
            var pxx,pyy;
            if(isTouch(event)){
                //手机触屏开始画图的坐标，根据实际情况进行微调

                pxx = 50;
                // pyy = 180;
                pyy = Math.floor(180+(theight5/2)*cHeight5);

                // alert(pyy);

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
                //说明用户画图了
                is_touch=true;

                return true;
            }else{
                return false;
            }
        }

        //上传签名到服务器
        function uploadSignature(){
            if (!is_touch) {
                alert("请先签上您的大名才可以提交哦~");
                return false;
            };

            canvas.style.opacity=0;
            var Pic = canvas.toDataURL("image/png");
            shotPic = Pic.replace(/^data:image\/(png|jpg);base64,/, "");

            $.post('upload.php',{"base64":shotPic,"openid":openid},function(res){
                //上传签名成功之后继续播放P3界面
                qmcg();
                $("#Stage_p3_qm_div2").append("<img src='"+Pic+"' style='width:100%;height:100%'>");
                $("#Stage_p3_name_num").find('span').html(res);
            },"json");
        }

        //清除画板
        function clearRect(){
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        //判断用户的抽奖次数
        function cjcishu(){
            var num;
            if (parseInt(prizeTime)<=0) {
                num=0;
            }else{
                num=1;
            }

            return num;
        }

        //点击抽奖,康佳kjqm20190107
        function LotteryBegan(){
               var num=5;

                $.ajaxSettings.async = false;
                //判断用户是否抽了三次奖品
               $.get(url+"judgeLotter",{"openid":openid,"projectName":projectName},function(res){
                    if (res=='success') {
                         $.get("https://www.mrgcgz.com/myAdmin/index.php/admin/Api/getNum",{"openid":openid,"projectName":projectName},function(obj){
                                num=obj;
                                prize = obj;
                            },"json");
                     }else{
                            num=5;
                     }

                     prizeTime=parseInt(prizeTime)-1;
                     $("#Stage_p4_cs").find('p').html(prizeTime);
               },"json");
               $.ajaxSettings.async = true;

                return num;

        }

        //接受用户填写的信息
        function getuserinfo(username,phone,address=null,qq=null){
            name   = username;
            mobile = phone;
            addr   = address;
            QQ     = qq;
        }

        //打印用户的二次信息
        function showuserinfo(){
            $("#Stage_p4_txxx_name_div").html("姓名："+name).css({'color':"#fff"});
            $("#Stage_p4_txxx_phone_div").html("手机："+mobile).css({'color':"#fff"});

            addr ? $("#Stage_p4_txxx_add_div").html("地址：</br>"+addr).css({'color':"#fff"}) : $("#Stage_p4_txxx_add_div").html("QQ："+QQ).css({'color':"#fff"});

        }

        //用户奖品的入库
        function userprizedb(){
             $.post(url+"addUserPrizeDb",{"openid":openid,"projectName":projectName,"prize":prize},function(res){},"json");
        }


        //进行用户信息的入库
        function adduserinfo(){
             $.post(url+"addUserReceieInfo",{"openid":openid,"projectName":projectName,"name":name,"phone":mobile,"address":addr,"qq":QQ},function(res){
                        res=="success" ?  xxcg() : alert("请重试！");
                 },"json");
        }

        //用户朋友圈的分享
        function shareFinsh(){
            $.ajaxSettings.async = false;
             $.post(url+"shareSuccess",{"openid":openid,"projectName":projectName},function(res){
                        if (res=='success') {
                            alert("恭喜您！分享成功！增加抽奖次数1次");
                            prizeTime = parseInt(prizeTime)+1;
                            $("#Stage_p4_cs").find('p').html(prizeTime);
                        }else{
                            alert("多谢您的分享，今日分享增加抽奖次数已经用完，请明日再试哦！");
                        }
                 },"json");
        }

        //初始化抽奖次数
        function initPrizeTime(){
             $.post(url+"getPrizeTime",{"openid":openid,"projectName":projectName},function(res){
                        $("#Stage_p4_cs").find('p').html(res);
                        prizeTime = res;
                 },"json");
        }

         //音乐暂停和播放
        function bf(){
            $("#audio")[0].play();
        }

        //暂停音乐
        function zt(){
            $("#audio")[0].pause();
        }

</script>
</html>