// var imgsArr = ["images/off.png", "images/on.png"];
var audio = document.getElementById('audio');

function onBridgeReady() {
    /*音频*/
    WeixinJSBridge.invoke("getNetworkType", {},function() {
        audio.play();
    })
    /*音频*/
}
if (typeof WeixinJSBridge == "undefined") {
    if (document.addEventListener) {
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    } else if (document.attachEvent) {
        document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
        document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
    }
} else {
    onBridgeReady();
}

// $.imgpreload(imgsArr,{
// 	all: function(){
// 		$('img').each(function(index,element){
// 			$(this).attr('src',$(this).attr('data-theme'));
// 		});
// 	}
// });

// $('#music').on('touchstart',function() {
// 	if (/on\.png$/.test($(this).attr('src'))) {
// 		$(this).attr('src', 'images/off.png');
// 		audio.pause();
// 	} else {
// 		$(this).attr('src', 'images/on.png');
// 		audio.play();
// 	}
// });
