/**
 * h5兼容自适应
 */

(function(){
    //font fit
    var deviceWidth = document.documentElement.clientWidth;
    if (deviceWidth > 750) deviceWidth = 750;
    document.documentElement.style.fontSize = deviceWidth / 7.5 + 'px';

    //ios music can not play
    document.addEventListener('DOMContentLoaded',function (){
        var audio = document.getElementById("audio");
           audio.play();
       document.addEventListener("WeixinJSBridgeReady", function () {
           audio.play();
       }, false);
   });

   //input scroll
   $(document).on("blur focus","input,textarea",function(){
     window.scroll(0,0);
   });

   //youmeng statistics
   document.write(unescape("%3Cspan id='cnzz_stat_icon_1279020596'%3E%3C/span%3E%3Cscript src='https://s9.cnzz.com/z_stat.php%3Fid%3D1279020596' type='text/javascript'%3E%3C/script%3E"));

   //online debug
    if (/debug=eruda/.test(window.location)){
        $.getScript("//cdn.jsdelivr.net/npm/eruda")
        .done(function() { 
            eruda.init();
        }).fail(function() {
            console.error("Eden Tips: VConsole load fail...");
        });
    } else if(/debug=vconsole/.test(window.location)){
        $.getScript("//cdn.bootcdn.net/ajax/libs/vConsole/3.3.4/vconsole.min.js")
        .done(function() { 
            new VConsole();
        }).fail(function() {
            console.error("Eden Tips: VConsole load fail...");
        });
    };
})();