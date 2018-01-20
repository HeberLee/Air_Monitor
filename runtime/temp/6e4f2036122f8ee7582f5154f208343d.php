<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\Software\phpstudy\WWW\study\Air_Monitor\public/../app/admin\view\map\index.html";i:1516447236;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\header.html";i:1515491265;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\footer.html";i:1514785741;}*/ ?>
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
</script>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 地图 <span class="c-gray en">&gt;</span> 监测点分布 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>


<div id="iframe_box" class="Hui-article">
<!-- 		<div class="show_iframe">
			<div style="display:none" class="loading"></div>
			<iframe scrolling="yes" frameborder="0" src="<?php echo url('index/welcome'); ?>"></iframe>
		</div> -->
		<div id="container"></div> 
			<script type="text/javascript"> 
			var map = new BMap.Map("container");
			// 创建地图实例  
			var point = new BMap.Point(118.604, 24.915);
			// 创建点坐标  
			map.centerAndZoom(point, 13);
			map.enableScrollWheelZoom(true); 
			// 初始化地图，设置中心点坐标和地图级别  
			var opts = {type: BMAP_NAVIGATION_CONTROL_LARGE};
			map.addControl(new BMap.NavigationControl(opts));    
			map.addControl(new BMap.ScaleControl());    
			map.addControl(new BMap.OverviewMapControl());    
			map.addControl(new BMap.MapTypeControl());    
			map.setCurrentCity("泉州");
			//标注点
			var marker = new BMap.Marker(point,{fillColor:"green"});        // 创建标注    
			map.addOverlay(marker); 
			//点击标注点触发事件
			marker.addEventListener("mouseover", function(){    
    		alert("您点击了标注");    
			}); 
			marker.setAnimation(BMAP_ANIMATION_BOUNCE);
			</script>  
	</div>
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


<script>
	var SCOPE = {
		'city_url':"<?php echo url('api/City/getCitiesByParentId'); ?>",
		'xypoint_url':"<?php echo url('api/Machine/change'); ?>",
	};
</script>
</body>
</html>
