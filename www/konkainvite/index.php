<?php
    require_once __DIR__ . '/../../wechat/jssdk.php';
    $signPackage = ( new jssdk() )->getSignPackage();
?>
<!DOCTYPE html>
<html style="height:100%;background-color: #000000;">
	<head>
		<meta charset="utf-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes" />
		<meta content="yes" name="apple-mobile-web-app-capable" />
		<meta content="black" name="apple-mobile-web-app-status-bar-style" />
		<meta content="telephone=no" name="format-detection" />
		<title></title>
		<link rel="stylesheet" href="css/swiper-4.3.3.min.css" />
		<script type="text/javascript" src="js/jquery-3.2.1.min.js" ></script>
		<style>
			.swiper-container{
				height: 100%;
				width: 100%;
			}
			.swiper-wrapper{
				-webkit-perspective: 3000;
			    -webkit-backface-visibility: hidden;
			}
		</style>
	</head>
	<body style="margin:0;padding:0;height:100%;">
		<!--playsinline webkit-playsinline="true"    video全屏的处理-->
		<!--安卓端启用H5同层播放器 x5-video-player-type="h5" -->
		<!--是否开启全屏的同层播放器  x5-video-player-fullscreen="true" -->
		<!--高版本浏览器，对视频静音后，可以保证视频自动播放 muted属性-->
		<!--控件 controls="controls"-->
		<div class="swiper-container" style="width:100%;height: 100%;">
		    <div class="swiper-wrapper" style="width:100%;height: 100%;" >

		        <div class="swiper-slide" id="slide1" style="width:100%;height: 100%;position: relative;">
					<img src="img/ling.png"  onclick="enableMute()" id="bling" style="height: 4%;width: 7%;position: absolute;top: 29%;left:91%;z-index: 999;"/>
		        	<video src="http://pbdq6h8o3.bkt.clouddn.com/c.mp4" id="video1" loop="loop"  playsinline webkit-playsinline="true"  style="width:100%;height:34.75%;position: absolute;">
					</video>
                   <!--  <video src="video/movie.mp4" id="video1" loop="loop"  playsinline webkit-playsinline="true"  style="width:100%;height:34.75%;position: absolute;"> -->
                    </video>
					<img src="img/p1.jpg" id="imgp1"  style="width:100%;height:66.29%;margin:55.7% 0 0 0;position: absolute;"/>
		        </div>

		        <div class="swiper-slide" id="slide2" style="width:100%;height: 100%;background-color:#000000;">
	        		<video src="http://pbdq6h8o3.bkt.clouddn.com/d.mp4" id="video2" loop="loop" playsinline webkit-playsinline="true" style="width:100%;height: 100%;"></video>
                    <!-- <video src="video/movie2.mp4" id="video2" loop="loop" playsinline webkit-playsinline="true" style="width:100%;height: 100%;"></video> -->
		        </div>

		    </div>
        </div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/h5.fit.common.js"></script>
<script type="text/javascript" src="js/swiper.animate1.0.3.min.js" ></script>
<script type="text/javascript" src="js/swiper-4.3.3.min.js" ></script>
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>

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
                        'downloadImage' 
                     ]
            });

            
            wx.ready(function(){

                var title = '科技视界 智启未来';     //分享标题
                var desc ="深圳康佳电子科技有限公司战略发布暨秋季新品发布会";      //分享描述
                var desc1 ="深圳康佳电子科技有限公司战略发布暨秋季新品发布会" ;      //分享描述
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
	var video1 = document.getElementById('video1');
	var video2 = document.getElementById('video2');
    var slide1 = document.getElementById("slide1");
    var slide2 = document.getElementById("slide2");

    // //视频兼容性处理
    // video1.addEventListener("canplay", function(){
    //     if (video1.duration > 0) {}else{
    //         video1.src="video/movie.mp4";
    //     }
    //       });

    // video2.addEventListener("canplay", function(){
    //     if (video2.duration > 0) {}else{
    //         video2.src="video/movie2.mp4";
    //     }
    //       });

    function videoOnePlay(){
        video2.pause();
        video1.currentTime=0.1;
        video1.play();
    }


    function videoTwoPlay(){
        video1.pause();
        video2.currentTime= 0.1;
        video2.play();
    }

	//滑动触发事件
	var windowHeight = $(window).height();
    $("body").css("height", windowHeight);

	var mySwiper = new Swiper ('.swiper-container', {
		  on: {
		    slideChangeTransitionEnd: function(){
		    	if (this.activeIndex==1) {
						videoTwoPlay();
		    	}else if(this.activeIndex==0){
                       videoOnePlay();
		    	}
		    },
		  },

		   direction: 'vertical',
		   pagination: '.pagination', 
		   calculateHeight : true, 
		   autoHeight: true,
	       loop:false,   
	       freeMode:false,  
	       touchRatio:2,  
	       longSwipesRatio:0.1,  
	       threshold:50,  
	       followFinger:false,  
	       observer: true,//修改swiper自己或子元素时，自动初始化swiper  
	       observeParents: true,//修改swiper的父元素时，自动初始化swiper  
	       onSlideChangeEnd:function(swiper){ // 当滑动结束后---月份日期切换同步左右左右切换  
	           changeMonth();  
	       }
	  });

//视频暂停
	function enableMute(){
		video1.muted=true;
		document.getElementById("bling").src = "img/buling.png";
		document.getElementById("bling").setAttribute("onclick","disableMute()");
		document.getElementById("bling").setAttribute("id","ling");
	}


	function disableMute(){
		video1.muted=false;
		document.getElementById("ling").src = "img/ling.png";
		document.getElementById("ling").setAttribute("onclick","enableMute()");
		document.getElementById("ling").setAttribute("id","bling");
	}

    function hateAndroid(){
                            video1.pause();
                            $("#video1").hide();
                            var v1 = document.createElement("img");
                            v1.setAttribute("src","img/wei-hen.png");
                            v1.setAttribute("id","v1");
                            //样式
                            slide1.append(v1);
                            video2.pause();
                            $("#video2").hide();
                            var v2 = document.createElement("img");
                            v2.setAttribute("src","img/wei-su.png");
                            v2.setAttribute("id","v2");
                            //样式
                            slide2.append(v2);
    }

    var u = navigator.userAgent;
    // var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);
    var isAndroid = u.indexOf('Android') > -1 || u.indexOf('Adr') > -1;



    if (isAndroid) {
        $("#bling").hide();
         //触摸暂停
    document.addEventListener('touchstart',touch, false);
    document.addEventListener('touchmove',touch, false);
    document.addEventListener('touchend',touch, false);

        function touch (event){
                    var event = event || window.event;
                    switch(event.type){
                        case "touchstart":
                           hateAndroid();
                        break;
                        case "touchmove":
                           hateAndroid();
                        break;
                        case "touchend":
                        setTimeout(() => {
                            $("#video1").show();
                            $("#video2").show();
                             video1.play();
                             video2.play();
                        }, 500)
                        break;
                    }
            }
    };
</script>
	</body>
</html>
