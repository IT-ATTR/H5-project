<?php
    require_once "../jssdk1.php";
    if(!$_COOKIE['openid']){
            header("location:../../../wx_login2.php?id=29&url=https://www.mrgcgz.com/h5/html/ydch20190111/index.php");
            die();
    }
 ?>
<!DOCTYPE html>
<html style="height:100%;background-image: url(images/background.jpg);background-color: #000;">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>π送团圆 云度送你回家</title>
<!--Adobe Edge Runtime-->
    <script type="text/javascript" charset="utf-8" src="https://animate.adobe.com/runtime/6.0.0/edge.6.0.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./layui/css/layui.css"  media="all">
	<script type="text/javascript" src="./js/jquery-2.1.1.min.js"></script>
    <style>
        .edgeLoad-EDGE-11420373 { visibility:hidden; }

        input,select,.layui-input{
            width: 100%;
            height: 100%;
            appearance:none;
            -moz-appearance:none;
            -webkit-appearance:none;
            border: 0;
            background: rgba(0, 0, 0, 0);
            font-size: 15px;
            font-weight: bold;
            color: #e8c88f;
        }
        #Stage_p3_yy2_city,#Stage_p3_yy2_city2,#Stage_p3_yy2_day,#Stage_p3_yy2_time{
            font-size: 15px;
            font-weight: bold;
            color: #e8c88f;
            padding: 2px 5px;
        }
        #Stage_p3_lookyy_name2,#Stage_p3_lookyy_gender2,#Stage_p3_lookyy_age2,#Stage_p3_lookyy_phone2,#Stage_p3_lookyy_work2,#Stage_p3_lookyy_home2,#Stage_p3_lookyy_add_jj,#Stage_p3_lookyy_add_sd,#Stage_p3_lookyy_time2{
            font-size: 10px;
            font-weight: bold;
            color: #e8c88f;
            text-align: center;
        }
        option{
            font-size: 10px;
        }
        .layui-laydate-content>.layui-laydate-list {
                padding-bottom: 0px;
                overflow: hidden;
            }
        .layui-laydate-content>.layui-laydate-list>li{
                width:50%
            }
 
        .merge-box .scrollbox .merge-list {
                padding-bottom: 5px;
            }
    </style>
<script>
	
   AdobeEdge.loadComposition('index', 'EDGE-11420373', {
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
        // 获取屏幕宽度
        cWidth5=window.screen.width;
        //alert(cWidth);
        // 获取屏幕高度
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
    <div id="Stage" class="EDGE-11420373"  style="position: absolute;">
	</div>
</body>

<!--微信分享start-->
<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
        var projectName = "ydch20190111";
        var work_pro;//工作省份
        var home_pro;//家庭省份
        var work_city;
        var home_city;
        var order_date;//预约日期
        var order_time;//预约日期
        var from_area;//来自区域
        var init_time_year;
        var init_time_month;
        var init_time_day;
        var init_min_month;
        var init_min_day;
        var to_area;//到达
        var flag = false;//是否填写姓名


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
                    timestamp: '<?php echo $signPackage["timestamp"];?>',
                    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
                    signature: '<?php echo $signPackage["signature"];?>',
                    jsApiList: [
                        'checkJsApi',
                        'onMenuShareTimeline',
                        'onMenuShareAppMessage',
                        'onMenuShareQQ',
                        'onMenuShareWeibo',
                     ]
            });

            wx.ready(function(){

                var title = 'π送团圆 云度送你回家';     //分享标题
                var desc = '还在为回家而烦恼？找云度！';      //分享描述
                var desc1 = '还在为回家而烦恼？找云度！';      //分享描述
                var imgurl = 'https://www.mrgcgz.com/h5/html/ydch20190111/icon.jpg';  //分享图片
                var shareurl='https://www.mrgcgz.com/h5/html/ydch20190111/index.php';   //分享链接
                var link_url="https://www.mrgcgz.com/h5/html/ydch20190111/index.php";          //分享完跳转链接

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
    <!-- 微信分享end -->
<script src="./layer/layer.js"></script>
<script type="text/javascript" src="./layui/layui.js"></script>

<script type="text/javascript">

    $("#Stage").hide();
    function aa(){
        if ($("#Stage_p4").length>0){
            $("#Stage").show();
            //解决背景图被压缩问题

            // $h = (1008-screen.height)/2;
            // $w = ($('body')[0].clientHeight-640)/2;
            // $('#Stage').css({'position':"absolute",'top':$h})

            $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/isFirst",{"openid":openid,"projectName":projectName},function(res){
                    //进行信息打印
                    if (res=='success') {
                        bofangrule();
                    }else{
                        bofang1();
                    }
            },"json");
            window.clearTimeout(t1);
        }
    }

    var t1=window.setInterval(aa,1000);
    //生成选项框
    function initInfoPage(){
        //先判断用户是否已经预约
        $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/is_order",{"openid":openid,"projectName":projectName},function(res){
                if (res=='success') {
                    tjcg();
                }else{
                    initStage();
                }
        },"json");
    }



    function initStage(){
        $("#Stage_p3_yy2_city,#Stage_p3_yy2_city2").html("城市名");
        //解决背景图被压缩问题
        var HEIGHT = $('body').height();
        $(window).resize(function() {
            $("#Stage_p3_yy2").height(HEIGHT);
        });
        $("#Stage_p3_yy2_name").find('input').on("blur",function(){
            $("#Stage_p3_yy2").height(HEIGHT);
        });
        $("#Stage_p3_yy2_name").find('input').val("需与身份证信息一致").on("focus",function(){
            $(this).val("");
            flag = true;
        })
        //省份选择框
        $("#Stage_p3_yy2_add_sheng").append("<select id='province' onchange='province(this)'><option value=''>选择省份</option></select>");
        //市选择框
        $("#Stage_p3_yy2_add_shi").append("<select id='city' onclick='isset_province()' onchange='get_city(this)'><option value=''>选择城市</option></select>");
        //工作省份
        $("#Stage_p3_yy2_add_sheng2").append("<select id='hprovince' onchange='hprovince(this)'><option value=''>选择省份</option></select>");
        //工作市选择框
        $("#Stage_p3_yy2_add_shi2").append("<select id='hcity' onclick='isset_hprovince()' onchange='get_hcity(this)'><option value=''>选择城市</option></select>");
        //接驾区
        $("#Stage_p3_yy2_add_qu").append("<select id='fromarea' onclick='is_city()' onchange='f_area(this)'><option value=''  >选择区域</option></select>");
        //送达区
        $("#Stage_p3_yy2_add_qu2").append("<select id='toarea' onclick='is_city()' onchange='t_area(this)'><option value=''>选择区域</option></select>");

        //初始化时间选择
        // $("#Stage_p3_yy2_day").append("<input type='text' class='layui-input' id='date'>");

        //初始化省份选择框
        $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/getProvice","",function(res){
                for (var i = 0; i< res.length; i++) {
                    var option = new Option(res[i].local_name,res[i].local_name+","+res[i].id);
                    $("#province,#hprovince").append(option);
                }
        },"json");



            //初始化时间
            layui.use('laydate', function(){
              var laydate = layui.laydate;

              //执行一个laydate实例
              laydate.render({
                elem: '#Stage_p3_yy2_day' //指定元素
                ,format:"yyyy/MM/dd"
                ,value: init_time_year+"/"+init_time_month+"/"+init_time_day
                ,theme: '#e4d594'
                ,min: init_time_year+"-"+init_min_month+"-"+init_min_day
                ,max: '2019-2-3'
                ,done: function(date){ //监听日期被切换
                    order_date = date;
                  }
              });


              laydate.render({
                elem: '#Stage_p3_yy2_time' //指定元素
                ,type:"time"
                ,format:"HH:mm"
                ,value: '00:00'
                ,theme: '#e4d594'
                ,btns: ['clear', 'confirm']
                ,ready: formatminutes
                ,done: function(date){ //监听日期被切换
                    order_time = date;
                  }
              });


        function  formatminutes(date) {
            var aa = $(".laydate-time-list li ol")[1];
            var showtime = $($(".laydate-time-list li ol")[1]).find("li");
            for (var i = 0; i < showtime.length; i++) {
                var t00 = showtime[i].innerText;
                if (t00 != "00" && t00 != "10" && t00 != "20" && t00 != "30" && t00 != "40" && t00 != "50") {
                    showtime[i].remove()
                }
            }
            $($(".laydate-time-list li ol")[2]).find("li").remove();

        }

            });
    }



    //省市联动源代码
    function province(obj){
            var cityinfo = obj.value.split(",");

            $("#city").find('option').not(":first").remove();
            city(cityinfo[1],"work");
            work_pro = cityinfo[0];
    }

    function hprovince(obj){
            var hcityinfo = obj.value.split(",");
            $("#hcity").find('option').not(":first").remove();
            $("#Stage_p3_yy2_city,#Stage_p3_yy2_city2").html("城市名");
            city(hcityinfo[1],"home");
            home_pro = hcityinfo[0];
    }

    //有省份才可以选择市区
    function isset_province(){
        if (!work_pro) {
            layer.msg('请先选择工作省份');
            return false;
        }
    }

    //选择的区
    function f_area(obj){
        from_area = obj.value;
    }

    //选择的区
    function t_area(obj){
        to_area = obj.value;
    }


    function isset_hprovince(){
        if (!home_pro) {
            layer.msg('请先选择家乡省份');
            return false;
        }

    }

    //获取城市
    function get_city(obj){
        var hcityinfo = obj.value.split(",");
        work_city = hcityinfo[0];
    }

    function is_city(){
        if (!home_city) {
             layer.msg('请先选择家庭所在城市');
        }
    }

    function get_hcity(obj){
        var hcityinfo = obj.value.split(",");
        home_city = hcityinfo[0];


        var showcity = home_city.split("");
        if (showcity.length>3) {
            showcity = showcity[0]+showcity[1]+"...";
        }

        $("#Stage_p3_yy2_city,#Stage_p3_yy2_city2").html(showcity);
        $("#fromarea").find("option").not(":first").remove();
        $("#toarea").find("option").not(":first").remove();

        $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/getCity",{"city_id":hcityinfo[1]},function(res){
                    for (var i = 0; i< res.length; i++) {
                        var option = new Option(res[i].local_name,res[i].local_name);
                        $("#fromarea,#toarea").append(option);
                    }
        },"json");
    }

    function city(pram,statu){
        if (!pram) {
            layer.msg('省份必选');
        }else{
            switch(statu){
                case "work":
                //请求相应省份下的城市
                $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/getCity",{"city_id":pram},function(res){
                    for (var i = 0; i< res.length; i++) {
                        var option = new Option(res[i].local_name,res[i].local_name+","+res[i].id);
                        $("#city").append(option);
                    }
                },"json");
                break;
                case "home":
                //请求相应省份下的城市
                $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/getCity",{"city_id":pram},function(res){
                    for (var i = 0; i< res.length; i++) {
                        var option = new Option(res[i].local_name,res[i].local_name+","+res[i].id);
                        $("#hcity").append(option);
                    }
                },"json");
                break;

            }
        }
    }

    //添加用户信息
    function adduserinfo(name,sexy,age,phone,frompos,topos){
        if (!name || !flag) {
            layer.msg('姓名必填');
            return false;
        }else if(!/^[\u4e00-\u9fa5]{1,5}$/.test(name)){
            layer.msg('姓名格式错误');
            return false;
        }else if(!sexy){
            layer.msg('性别必填');
            return false;
        }else if(!/^[\u4e00-\u9fa5]{1,3}$/.test(sexy)){
            layer.msg('性别格式错误');
            return false;
        }else if(!age){
            layer.msg('年龄必填');
            return false;
        }else if(!/^\d{1,3}$/.test(age)){
            layer.msg('年龄格式错误！');
            return false;
        }else if(!phone){
            layer.msg('手机号必填');
            return false;
        }else if(!/^1[3-9]\d{9}$/.test(phone)){
            layer.msg('手机号格式错误');
            return false;
        }else if(!work_pro){
            layer.msg('工作省份必选');
            return false;
        }else if(!work_city){
            layer.msg('工作城市必选');
            return false;
        }else if(!home_pro){
            layer.msg('家乡省份必选');
            return false;
        }else if(!home_city){
            layer.msg('家乡城市必选');
            return false;
        }else if(!from_area){
            layer.msg('接驾区域必填');
            return false;
        }else if(!to_area){
            layer.msg('送达区域必填');
            return false;
        }else if(!frompos){
            layer.msg('接驾地址必填');
            return false;
        }else if(!topos){
            layer.msg('送达地址必填');
            return false;
        }else if(!from_area){
            layer.msg('接送区域必选');
            return false;
        }else if(!to_area ){
            layer.msg('送达区域必选');
            return false;
        }else if(!order_date){
            layer.msg('预约日期必选');
            return false;
        }else if(!order_time){
            layer.msg('预约时间必选');
            return false;
        }

        $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/addUserInfo",{"openid":openid,"projectName":projectName,"name":name,"sexy":sexy,"age":age,"phone":phone,"work_pro":work_pro,"work_city":work_city,"home_pro":home_pro,"home_city":home_city,"frompos":frompos,"topos":topos,"from_area":from_area,"to_area":to_area,"order_date":order_date,"order_time":order_time},function(res){
                    if (res=='success') {
                        tjcg();
                    }else{
                        layer.msg('当天的预约已经满了，尝试其他日期吧~');
                    }
        },"json");
    }


    //展示预约信息
    function getOrderInfo(){
         $.post("https://www.mrgcgz.com/myAdmin/index.php/admin/City/getOrderInfo",{"openid":openid,"projectName":projectName},function(res){
                    //进行信息打印
                    $("#Stage_p3_lookyy_name2").html(res.name);
                    $("#Stage_p3_lookyy_gender2").html(res.sexy);
                    $("#Stage_p3_lookyy_age2").html(res.age);
                    $("#Stage_p3_lookyy_phone2").html(res.phone);
                    $("#Stage_p3_lookyy_work2").html(res.work_area);
                    $("#Stage_p3_lookyy_home2").html(res.hometown);
                    $("#Stage_p3_lookyy_add_jj").html(res.from);
                    $("#Stage_p3_lookyy_add_sd").html(res.to);
                    $("#Stage_p3_lookyy_time2").html(res.order_time);
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

        //解决iphone的播放问题,必须写
        document.addEventListener('DOMContentLoaded',function (){
             var audio = document.getElementById("audio");
                audio.play();
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
            }, false);
        });

    //防止输入框的导致其上下晃动
    $(document).on("blur focus","input,select",function(){
        window.scroll(0,0);
     });

      //去除弹窗网址
      window.alert = function(name){
      var iframe = document.createElement("IFRAME");
      iframe.style.display="none";
      iframe.setAttribute("src", 'data:text/plain,');
      document.documentElement.appendChild(iframe);
      window.frames[0].window.alert(name);
      iframe.parentNode.removeChild(iframe);
     };
</script>
<script type="text/javascript">
    var date = new Date();
    init_time_year = date.getFullYear();
    init_time_month = date.getMonth()+1;
    init_time_day = date.getDate();

    if (init_time_month==1 && init_time_day==30) {
        init_min_month = "02";
        init_min_day ="01";
    }else if(init_time_month==1 && init_time_day==31) {
        init_min_month = "02";
        init_min_day ="01";
    }else{
        init_min_month = init_time_month;
        init_min_day = init_time_day+2
    }
</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?3003949a0236e2cd49e90b81f85445bc";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</html>