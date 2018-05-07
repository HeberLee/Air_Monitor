<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"D:\Software\phpstudy\WWW\study\Air_Monitor\public/../app/admin\view\chart\index.html";i:1523083144;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\header.html";i:1522475539;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\footer.html";i:1520832898;}*/ ?>
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
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 数据中心 <span class="c-gray en">&gt;</span> 查看数据 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->

    <div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<div class="text-c">


        <span class="select-box inline">
            <select name="machine_id" class="select chart_machine_id">
                <option value="0">选择设备</option>
                <?php if(is_array($machines) || $machines instanceof \think\Collection || $machines instanceof \think\Paginator): $i = 0; $__LIST__ = $machines;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </span>
 
		日期范围：
		<input type="text" name="start_time"  class="input-text start_time" id="countTimestart" onfocus="selecttime(1)" value="" style="width:120px;" >
			-
		<input type="text" name="end_time"  class="input-text end_time" id="countTimestart" onfocus="selecttime(1)" value=""  style="width:120px;">

		<button name="" id="" class="btn btn-success create-chart" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索
		</button>

	</div>
</div>
    <div id="main" style="width: 600px;height:400px;"></div>

    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
       

    </script>
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
        'machine_url':"<?php echo url('api/Machine/getMacinesByCityId'); ?>",
        'chart_url':"<?php echo url('admin/Chart/chart'); ?>",
    };
</script>
</body>
</html>