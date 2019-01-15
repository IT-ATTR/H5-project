<?php
    require_once "../jssdk1.php";
    if(!$_COOKIE['openid']){
            header("location:../../../wx_login2.php?id=8&url=https://www.mrgcgz.com/h5/html/jzyy20180823/index2.php");
            die();
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
        .edgeLoad-EDGE-40278163 { visibility:hidden; }
    </style>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?f2ce89145ba9daa9eca98c1a76a039af";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script>
   AdobeEdge.loadComposition('index2', 'EDGE-40278163', {
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
	<div id="Stage" class="EDGE-40278163" style="position: absolute;">
	</div>
 <audio id="languege" src=''  style="display:none;"></audio>
</body>
<script type="text/javascript" src="./jquery.min.js" ></script>
<!--微信分享start-->
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
        //配置相应的全局变量,想要操作的数据库表名称
        var projectName = "jzyy20180823";
        var localId = null; //用于记录录音ID
        var page=1;//翻页的页码
        var tabname;
        var wxyy;
        var luyin=null;//录音
        var appid,timestamp,nonceStr,signature,jsApiList;
        var openid="<?php echo $_COOKIE['openid']; ?>";
        var nickname="<?php echo $_COOKIE['nickname']; ?>";
        var headimgurl="<?php echo $_COOKIE['headimgurl']; ?>";

        //进行用户信息的入库
        var url= "https://www.mrgcgz.com/myAdmin/index.php/Admin/Project/userinfo";
        $.get(url,{"openid":openid,"nickname":nickname,"headimgurl":headimgurl,"projectName":projectName},function(){},"json");

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
                 // alert(getnum1);
                var title = '江中美食HIGH吃季';     //分享标题
                var desc = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
                var desc1 = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/jzyy20180823/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/jzyy20180823/index2.php';   //分享链接
                // alert(shareurl);
                var link_url="";   //分享完跳转链接

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
                       // console.log("前");
                       // alert(shareurl);
                       // uploadVoice();
                       //console.log("后");

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
                       // console.log("前");
                       // uploadVoice();
                       // console.log("后");

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
                       // console.log("前");
                       // uploadVoice();
                       // console.log("后");

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
     //用localStorage进行记录，之前没有授权的话，先触发录音授权，避免影响后 续交互
        if (!localStorage.allowRecord || localStorage.allowRecord !== 'true') {
            wx.startRecord({
                success: function() {
                    localStorage.allowRecord = 'true';
                },
                cancel: function() {
                    alert('用户拒绝授权录音');
                }
            });
        }

   //      //解决iphone音乐不能自动播放的问题
   //  document.addEventListener('DOMContentLoaded', function () {
   //      function audioAutoPlay() {
   //          var audio = document.getElementById('languege');
   //              audio.play();
   //          document.addEventListener("WeixinJSBridgeReady", function () {
   //              audio.play();
   //          }, false);
   //   }
   //     audioAutoPlay();
   // });

    //播放录音
    function playLanguage(){
        $audio = document.getElementById("languege");
        $audio.play();
    }
    //河北话
    function playLanguage1(){
        $audio = document.getElementById("languege");
        console.log($audio);
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E6%B2%B3%E5%8C%97%E8%AF%9D%E3%80%8A%E5%8D%9C%E7%AE%97%E5%AD%90%E3%80%8B.mp3";
        $audio.play();
    }

     //上海话
    function playLanguage2(){
        $audio = document.getElementById("languege");
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E4%B8%8A%E6%B5%B7-%E6%B1%9F%E5%9F%8E%E5%AD%90.mp3";
        $audio.play();
    }

     //长沙话
    function playLanguage3(){
        $audio = document.getElementById("languege");
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E9%95%BF%E6%B2%99%E8%AF%9D%E3%80%8A%E5%A4%A9%E5%87%80%E6%B2%99%E3%80%8B.mp3";
        $audio.play();
    }

    //抚州话
    function playLanguage4(){
        $audio = document.getElementById("languege");
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E6%8A%9A%E5%B7%9E%E8%AF%9D%E3%80%8A%E5%A4%A9%E5%87%80%E6%B2%99%E3%80%8B.mp3";
        $audio.play();
    }

     //萍乡话
    function playLanguage5(){
        $audio = document.getElementById("languege");
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E8%90%8D%E4%B9%A1-%E5%A4%A9%E5%87%80%E6%B2%99.mp3";
        $audio.play();
    }

     //南昌话
    function playLanguage6(){
        $audio = document.getElementById("languege");
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E5%8D%97%E6%98%8C-%E5%A4%A9%E5%87%80%E6%B2%99.mp3";
        $audio.play();
    }

    //景德镇话
    function playLanguage7(){
        $audio = document.getElementById("languege");
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E6%99%AF%E5%BE%B7%E9%95%87-%E9%B1%BC%E6%88%91%E6%89%80%E6%AC%B2%E4%B9%9F.mp3";
        $audio.play();
    }

     //南康话(待定)————测试数据
    function playLanguage8(){
        $audio = document.getElementById("languege");
        $audio.src = "http://pe5w1xggm.bkt.clouddn.com/%E5%8D%97%E5%BA%B7-%E7%9B%B8%E8%A7%81%E6%AC%A2.mp3";
        $audio.play();
    }


    //点击录音
    function startRecode(){
        pause();
        event.preventDefault();

        wx.startRecord({
          success: function(res) {
            var tempFilePath = res.tempFilePath
            // console.log(tempFilePath);
          },
          fail: function(res) {
             //录音失败
          },
          cancel: function() {
                alert('对不起,您未进行语音授权，不能进行录音哦!');
            }
        })
    }

  //停止录音
  function pause(){
           event.preventDefault();
            wx.stopRecord({
                success: function(res) {
                    localId = res.localId;
                    // 上传到服务器
                    // uploadVoice();
                },
                fail: function(res) {
                    // alert(JSON.stringify(res));
                }
            });
        }

    function play(){
        if(!localId){
                alert("别着急,您还未录音哦!");
                return false;
            }
            wx.playVoice({
                  localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
            });
            // 播放录音完毕
            wx.onVoicePlayEnd({
                    success: function (res) {
                        // var localId = res.localId; // 返回音频的本地ID
                    }
            });
    }

    //停止播放录音
    function pauseVoice(){
        wx.stopVoice({
                  localId: localId // 需要播放的音频的本地ID，由stopRecord接口获得
            });
    }

    //暂停音乐
    function pauseLanguage(){
         $audio = document.getElementById("languege");
         $audio.pause();
    }

    //获取分页数据
    function getPageData(num){
        tabname=num;
        var tablename;
        switch(num){
            case 1:
                tablename = "hebei";
            break;
            case 2:
                tablename = "shanghai";
            break;
            case 3:
                tablename = "changsha";
            break;
            case 4:
                tablename = "fuzhou";
            break;
            case 5:
                tablename = "pingxiang";
            break;
            case 6:
                tablename = "nanchang";
            break;
            case 7:
                tablename = "jingdezhen";
            break;
            case 8:
                tablename = "nankang";
            break;
            case 9:
                tablename = "jiujiang";
            break;
        }

        $.ajaxSettings.async = false;
        $.get("./page.php",{'tablename':tablename},function(data){
                //打印图像，昵称和评论
                for (var i = 1; i <= data.length; i++) {
                    var headimg = $("<img src="+data[i-1].headimgurl+" width='100%' height='100%'>");
                    //图像打印
                    $("#Stage_p2_pl_tx"+i).append(headimg);
                    //console.log($("#Stage_p2_pl_name"+i).find("p"));
                    //昵称打印
                    $("#Stage_p2_pl_name"+i).find("p").html(data[i-1].nickname);
                    //评论打印
                    $("#Stage_p2_pl_comments"+i).find("p").html(data[i-1].comment);


                }
                //初始化数据
        },'json')
    }

    //点击上翻页
    function prePage(){
        var tablename;

        switch(tabname){
            case 1:
                tablename = "hebei";
            break;
            case 2:
                tablename = "shanghai";
            break;
            case 3:
                tablename = "changsha";
            break;
            case 4:
                tablename = "fuzhou";
            break;
            case 5:
                tablename = "pingxiang";
            break;
            case 6:
                tablename = "nanchang";
            break;
            case 7:
                tablename = "jingdezhen";
            break;
            case 8:
                tablename = "nankang";
            break;
            case 9:
                tablename = "jiujiang";
            break;
        }
        //分页数据
        if (page-1<1) {
            return false;
        }else{
            page = page-1;
        }

        $.ajaxSettings.async = false;
        $.get("./page.php",{'tablename':tablename,"page":page},function(data){
                //解决最后一页只清除前面几条的bug,
                for (var i = 1; i <=10; i++) {
                     //先清除数据
                    $("#Stage_p2_pl_tx"+i).html("");
                    $("#Stage_p2_pl_name"+i).find("p").html("");
                    $("#Stage_p2_pl_comments"+i).find("p").html("");
                }
                //打印图像，昵称和评论
                for (var i = 1; i <= data.length; i++) {
                    var headimg = $("<img src="+data[i-1].headimgurl+" width='100%' height='100%'>");
                    //图像打印
                    $("#Stage_p2_pl_tx"+i).append(headimg);
                    //console.log($("#Stage_p2_pl_name"+i).find("p"));
                    //昵称打印
                    $("#Stage_p2_pl_name"+i).find("p").html(data[i-1].nickname);
                    //评论打印
                    $("#Stage_p2_pl_comments"+i).find("p").html(data[i-1].comment);


                }
                //初始化数据
        },'json')
    }

    //点击下翻页
    function nextPage(){
        var tablename;

        switch(tabname){
            case 1:
                tablename = "hebei";
            break;
            case 2:
                tablename = "shanghai";
            break;
            case 3:
                tablename = "changsha";
            break;
            case 4:
                tablename = "fuzhou";
            break;
            case 5:
                tablename = "pingxiang";
            break;
            case 6:
                tablename = "nanchang";
            break;
            case 7:
                tablename = "jingdezhen";
            break;
            case 8:
                tablename = "nankang";
            break;
            case 9:
                tablename = "jiujiang";
            break;
        }
        //分页数据(这边应该有个bug)
        page = page+1;
        $.ajaxSettings.async = false;
        $.get("./page.php",{'tablename':tablename,"page":page},function(data){
             //解决最后一页只清除前面几条的bug,
                for (var i = 1; i <=10; i++) {
                     //先清除数据
                    $("#Stage_p2_pl_tx"+i).html("");
                    $("#Stage_p2_pl_name"+i).find("p").html("");
                    $("#Stage_p2_pl_comments"+i).find("p").html("");
                }

                //打印图像，昵称和评论
                for (var i = 1; i <= data.length; i++) {

                    var headimg = $("<img src="+data[i-1].headimgurl+" width='100%' height='100%'>");
                    //图像打印
                    $("#Stage_p2_pl_tx"+i).append(headimg);
                    //console.log($("#Stage_p2_pl_name"+i).find("p"));
                    //昵称打印
                    $("#Stage_p2_pl_name"+i).find("p").html(data[i-1].nickname);
                    //评论打印
                    $("#Stage_p2_pl_comments"+i).find("p").html(data[i-1].comment);


                }
                //初始化数据
        },'json')
    }

    //用户评论的录入
    function commentInsertDb(content,num){
        var backval;
        var tablename;
        tabname=num;
        switch(num){
            case 1:
                tablename = "hebei";
            break;
            case 2:
                tablename = "shanghai";
            break;
            case 3:
                tablename = "changsha";
            break;
            case 4:
                tablename = "fuzhou";
            break;
            case 5:
                tablename = "pingxiang";
            break;
            case 6:
                tablename = "nanchang";
            break;
            case 7:
                tablename = "jingdezhen";
            break;
            case 8:
                tablename = "nankang";
            break;
            case 9:
                tablename = "jiujiang";
            break;
        }

       $.ajaxSettings.async = false;
        $.get("./comment.php",{'tablename':tablename,'nickname':nickname,'headimgurl':headimgurl,'openid':openid,'comment':content},function(data){
                backval = data;
        },'json');
        return backval;
    }

    //分享时的图片
    function sharePic(){
        $("#Stage_p3_tx-div").append("<img src='"+headimgurl+"' width='100%' height='100%'>");
    }

    //上传用户录音
    function uploadVoice(){
         //调用微信的上传录音接口把本地录音先上传到微信的服务器
        //不过，微信只保留3天，而我们需要长期保存，我们需要把资源从微信服务器下载到自己的服务器
        if(!(localId==null)){
            wx.uploadVoice({
                localId: localId, // 需要上传的音频的本地ID，由stopRecord接口获得
                isShowProgressTips: 1, // 默认为1，显示进度提示
                success: function (res) {
                    //把录音在微信服务器上的id（res.serverId）发送到自己的服务器供下载。
                     var serverId = res.serverId;
                     // console.log(res);
                    $.ajax({
                        // url: './haha/index.php/Home/Index/index',
                        url: './qiniu666.php',
                        async:false,
                        type: 'post',
                        dataType: 'text',
                        // data: JSON.stringify(res),
                        data: {serverid:serverId},
                        // dataType: "json",
                        success: function (obj) {
                           wxyy = $.trim(obj);
                            bcyy();
                           // var wxyy111 = $.trim(obj);
                           //  $.get('./insertVoice.php',{openid:openid,wx_voice:wxyy111},function(data,status){
                           //      console.log("入库成功");
                           //   },'json');
    }
 });
                }
    });
    }
}


//判断能不能保存语音
function cannotSaveRecode(){
    var recodestatus;
    if (!(localId==null)) {
        recodestatus=1;
    }else{
        recodestatus=0;
    }

    return recodestatus;
}


function setShareword(num){
            // alert(getnum1);
            var title    = '江中美食HIGH吃季';     //分享标题
            var desc     = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
            var desc1    = '大家都说这里有奖品 我看是谁走漏了风声!';      //分享描述
            var imgurl   = 'https://www.mrgcgz.com/h5/html/jzyy20180823/icon.jpg';  //分享图片
            var shareurl = "https://www.mrgcgz.com/h5/html/jzyy20180823/index3.php?headimgurl="+headimgurl+"&param="+num+"&wxvoice="+wxyy;

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
                       // console.log("前");
                       // alert(shareurl);
                       // uploadVoice();
                       //console.log("后");

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
                       // console.log("前");
                       // uploadVoice();
                       // console.log("后");

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
                       // console.log("前");
                       // uploadVoice();
                       // console.log("后");

                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                    }
                });

                //wx.hideOptionMenu();

}
</script>
</html>