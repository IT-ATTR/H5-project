<?php
    require_once __DIR__ . '/../../wechat/jssdk.php';
    $signPackage = ( new jssdk() )->getSignPackage();

?>
<!DOCTYPE html>
<html style="height:100%;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <title>征战洞庭湖</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="https://animate.adobe.com/runtime/6.0.0/edge.6.0.0.min.js"></script>
    <script src="../jquery-2.1.4.min.js"></script>
    <style>
        .edgeLoad-EDGE-2661171 { visibility:hidden; }
    </style>
<script>
   AdobeEdge.loadComposition('index5', 'EDGE-2661171', {
    scaleToFit: "none",
    centerStage: "none",
    minW: "0%",
    maxW: "undefined",
    width: "100%",
    height: "100%"
}, {"dom":{}}, {"dom":{}});
</script>

<script>

//添加成绩
function add_score(score){
    
    $.ajaxSettings.async = false; 
    var url='../../index.php?m=ztlls20170928&a=add_score&callback=?';
    
    $.post(url,
           {openid:openid,nickname:nickname,headimgurl:headimgurl,score:score,game_type:1},
            function(data,status){
               result = data
               
     });
     return result; 
    
}

//分享后递减分数
function add_score1(score){
    
    $.ajaxSettings.async = false; 
    var url='../../index.php?m=ztlls20170928&a=add_score1&callback=?';
    
    $.post(url,
           {openid:openid,nickname:nickname,headimgurl:headimgurl,score:score,game_type:1},
            function(data,status){
               result = data
               
     });
     return result; 
}

//显示排行榜
function rank_refresh(){
    
    $.ajaxSettings.async = false; 
    var url='../../index.php?m=ztlls20170928&a=rank_refresh&callback=?';
    
    $.post(url,
           {openid:openid,nickname:nickname,headimgurl:headimgurl,game_type:1},
            function(data,status){
               result = data
               
     });
     return result;
}

//是众泰车主+1
function carer1(){
    
    $.ajaxSettings.async = false; 
    var url='../../index.php?m=ztlls20170928&a=carer1&callback=?';
    
    $.post(url,
           {openid:openid,nickname:nickname,headimgurl:headimgurl,game_type:1},
            function(data,status){
               // result = data
               
     });
     // return result;
}

// 不是众泰车主+1
function carer2(){
    
    $.ajaxSettings.async = false; 
    var url='../../index.php?m=ztlls20170928&a=carer2&callback=?';
    
    $.post(url,
           {openid:openid,nickname:nickname,headimgurl:headimgurl,game_type:1},
            function(data,status){
               // result = data
               
     });
     // return result;
}

</script>

</head>
<body style="margin:0;padding:0;height:100%;">
    <audio id='audio' src="media/BGM.mp3" loop autoplay></audio> 
    <div id="Stage" class="EDGE-2661171">
    </div>
</body>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/h5.fit.common.js"></script>
<script type="text/javascript" src="js/imgpreload.js"></script>
<script type="text/javascript" src="js/touch-0.2.14.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    var appid,timestamp,nonceStr,signature,jsApiList;    
            wx.config({
                debug: false,
                appId: '<?php echo $signPackage["appId"];?>',
                timestamp: "<?php echo $signPackage["timestamp"];?>",
                nonceStr: '<?php echo $signPackage["nonceStr"];?>',
                signature: '<?php echo $signPackage["signature"];?>',
                jsApiList: [
                    'checkJsApi',    
                    'onMenuShareTimeline',    
                    'onMenuShareAppMessage',    
                    'onMenuShareQQ',    
                    'onMenuShareWeibo',
                    'hideMenuItems',
                    'hideAllNonBaseMenuItem',
                    'hideOptionMenu' 
                 ]
        });
             
      
        
        wx.ready(function(){
            
            var title = '征战洞庭湖';
            var desc = '众泰云100plus,耀你更出众!征战洞庭湖,惊喜等你来.';
            var imgurl = 'http://www.mrgcgz.com/h5/html/ztlls20170928/icon.jpg';
            
            wx.onMenuShareTimeline({
            title: desc,
            link: window.location.href,
            imgUrl: imgurl,
                trigger: function (res) {
                 //alert('用户点击分享到朋友圈');
                },
                success: function (res) {
                //alert('已分享');
                   // _hmt.push(['_trackEvent', 'sharewx', 'fxcg', '']);
                    
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
                link: window.location.href, // 分享链接
                imgUrl: imgurl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    // 用户确认分享后执行的回调函数
                    // _hmt.push(['_trackEvent', 'sharewx', 'fxcg', '']);
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareQQ({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: window.location.href, // 分享链接
                imgUrl: imgurl, // 分享图标
                success: function () { 
                   // 用户确认分享后执行的回调函数
                },
                cancel: function () { 
                   // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareWeibo({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: window.location.href, // 分享链接
                imgUrl: imgurl, // 分享图标
                success: function () { 
                   // 用户确认分享后执行的回调函数
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


        function setShareword(){
            
            var title = '征战洞庭湖';
            // var desc = str;
            var desc = '众泰云100plus,耀你更出众!征战洞庭湖,惊喜等你来.';            
            var imgurl = 'http://www.mrgcgz.com/h5/html/ztlls20170928/icon.jpg';
            var link_url = window.location.href;
            
            wx.onMenuShareTimeline({
            title: desc,
            link: link_url,
            imgUrl: imgurl,
                trigger: function (res) {
                   //alert('用户点击分享到朋友圈');
                },
                success: function (res) {
                   // 用户确认分享后执行的回调函数 
                   JCFX();                      

                   //alert('已分享');
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
                link: link_url, // 分享链接
                imgUrl: imgurl, // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    // 用户确认分享后执行的回调函数
                    JCFX();  
                    
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareQQ({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link_url, // 分享链接
                imgUrl: imgurl, // 分享图标
                success: function () { 
                   // 用户确认分享后执行的回调函数
                   JCFX();

                },
                cancel: function () { 
                   // 用户取消分享后执行的回调函数
                }
            });
            wx.onMenuShareWeibo({
                title: title, // 分享标题
                desc: desc, // 分享描述
                link: link_url, // 分享链接
                imgUrl: imgurl, // 分享图标
                success: function () { 
                   // 用户确认分享后执行的回调函数
                   JCFX();  
                },
                cancel: function () { 
                    // 用户取消分享后执行的回调函数
                }
            });
            
            
        } 
                    
</script>
</html>