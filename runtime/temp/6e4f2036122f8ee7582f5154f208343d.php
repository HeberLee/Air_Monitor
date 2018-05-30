<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\Software\phpstudy\WWW\study\Air_Monitor\public/../app/admin\view\map\index.html";i:1527414879;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\header.html";i:1522475539;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\footer.html";i:1520832898;}*/ ?>
<!--包含头部文件-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/hui/static/h-ui.admin/css/style.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/admin/css/common.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>o2o平台</title>
<meta name="keywords" content="tp5打造o2o平台系统">
<meta name="description" content="o2o平台">

<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<style type="text/css">  
html{height:100%}  
body{height:100%;margin:0px;padding:0px}  
#container{height:100%}  
</style>  
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=N2pS7HeyXvC0B5CjjvUwyIBMFGDHv9YX">

//v2.0版本的引用方式：src="http://api.map.baidu.com/api?v=2.0&ak=您的密钥"
//

</script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="__STATIC__/admin/js/echarts.js"></script>

</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 地图 <span class="c-gray en">&gt;</span> 监测点分布 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

<style>

        #allmap
        {
            margin-right: 0px;
            height: 96%;
            overflow: hidden;
        }
        ul li {
            margin-left: 50px;
        }
</style>

            <div id="allmap" style="width: 100%; height: 100%; float: left;" class="baidu-maps">

</body>
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("allmap");    // 创建Map实例
    map.centerAndZoom(new BMap.Point(118.614, 24.825), 18);  // 初始化地图,设置中心点坐标和地图级别
    map.addControl(new BMap.MapTypeControl());   //添加地图类型控件
    map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    map.addControl(new BMap.NavigationControl());
</script>
<!--包含头部文件-->
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="__STATIC__/admin/hui/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="__STATIC__/admin/hui/lib/jquery.validation/1.14.0/messages_zh.min.js"></script>  
<script type="text/javascript" src="__STATIC__/admin/hui/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="__STATIC__/admin/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/admin/js/common.js"></script>
<!-- <script type="text/javascript" src="__STATIC__/admin/js/echarts.js"></script> -->


<script>
	var SCOPE = {
		'city_url':"<?php echo url('api/City/getCitiesByParentId'); ?>",
		'xypoint_url':"<?php echo url('api/Machine/change'); ?>",
		'map_url':"<?php echo url('map/markers'); ?>",
	};


    $(function () {
        initMarker("");

    })
    //单击单个苗圃事件
    function LoadPartial(id, systemid) {
        initMarker(id);
    }
    
    //加载标注点
    function initMarker(id) {
        $.ajax({
            type: "POST",
            url: SCOPE.map_url,
            dataType: "json",
            async: false,
            data: {},
            success: function (data) {
            	console.log(data);
                map.clearOverlays();
                var i = 0;
                var points = [];
                for (var item in data) {
                    (function (x) {
                        //创建标注
                        var pt = new BMap.Point(data[item].xpoint, data[item].ypoint);
                        points[i] = pt;
                        var marker = new BMap.Marker(pt);
                        map.addOverlay(marker);
                        var label = new BMap.Label(data[item].name, { offset: new BMap.Size(30, -10) });
                        marker.setLabel(label);
                        label.setStyle({
                            color: "White",
                            fontSize: "14px",
                            backgroundColor: "#5CACEE",
                            border: "0"
                        });
                        //创建信息窗口
                        var opts = {
                            width: 400,     // 信息窗口宽度
                            height: 120,     // 信息窗口高度
                            title: "<strong style=\"font-size:16px;font-weight:bold\">" + data[item].name + "</strong>", // 信息窗口标题
                            enableMessage: true, //设置允许信息窗发送短息
                            message: ""
                        }
                        var showInfo = "地址：" + data[item].city_path + "<br/>" + "纬度：" + data[item].ypoint + "<br/>经度：" + data[item].xpoint;
                        var infoWindow = new BMap.InfoWindow(showInfo, opts);  // 创建信息窗口对象
                        marker.addEventListener("click", function (e) {
                            //map.centerAndZoom(pt, 12);
                            marker.openInfoWindow(infoWindow, pt); //开启信息窗口
                        });
                        map.addOverlay(marker);
                        i++;
                    })(i);
                }

                if (id == "") {
                    map.setViewport(points);
                } else {
                    map.setViewport(points);
                    setTimeout(function () {
                        map.setZoom(18);
                    }, 100);  //0.1秒后放大到14级
                }

            },
            error: function (error) {
                alert("加载失败，请检查网络或其他原因");
            }
        });
    }

    //清除覆盖物
    function cleardd() {
        for (var i = 0; i < overlays.length; i++) {
            map.removeOverlay(overlays[i]);
        }
        overlays.length = 0;
    }

</script>
</body>
</html>
