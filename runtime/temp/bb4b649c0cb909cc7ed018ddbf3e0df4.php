<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"D:\Software\phpstudy\WWW\study\Air_Monitor\public/../app/admin\view\user\userlist.html";i:1527404870;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\header.html";i:1522475539;s:76:"D:\Software\phpstudy\WWW\study\Air_Monitor\app\admin\view\public\footer.html";i:1520832898;}*/ ?>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>用户管理<span class="c-gray en">&gt;</span> 用户列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	

	<div class="cl pd-5 bg-1 bk-gray mt-20"> 
	<div class="text-c">
		<form action="<?php echo url('user/userList'); ?>" method="post">

		<span class="select-box inline">
			<select name="status" class="select">
				<option value="" >两者</option>
				<option value="1" <?php if($status == 1): ?>selected="selected"<?php endif; ?>>普通用户</option>
				<option value="2" <?php if($status == 2): ?>selected="selected"<?php endif; ?>>管理员</option>
				
		
			</select>
		</span> 
		<input type="text" name="name" id="" value="<?php echo $name; ?>" placeholder="用户名" style="width:250px" class="input-text">
		日期范围：
		<input type="text" name="start_time"  value="<?php echo $start_time; ?>" class="input-text start_time" id="countTimestart" onfocus="selecttime(1)" value="" style="width:120px;" >
			-
		<input type="text" name="end_time"   value="<?php echo $end_time; ?>" class="input-text end_time" id="countTimestart" onfocus="selecttime(1)" value=""  style="width:120px;">

		<button name="" id="" class="btn btn-success create-chart" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索
		</button>
	</form>
	</div>
</div>

	<!--<img style="margin:20px" width="500" height="400" src="<?php echo url('index/index/map'); ?>"/>-->
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="80">ID</th>
					<th width="100">用户名</th>
					<th width="150">申请时间</th>
					<th width="60">状态</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody class="machine">
				<?php if(is_array($userinfo) || $userinfo instanceof \think\Collection || $userinfo instanceof \think\Paginator): $i = 0; $__LIST__ = $userinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr class="text-c">
					<td id="id"><?php echo $vo['id']; ?></td>
					<td id="username"><?php echo $vo['username']; ?></td>
					<td id="create_time"><?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></td>
					<td id="status" class="td-status"><a href="<?php echo url('user/status',['id'=>$vo['id'],'status'=>$vo['status']==1?2:1]); ?>" title="点击改变用户类型"><?php echo liststatus($vo['status']); ?></a></td>
					<td class="td-manage"><a style="text-decoration:none" class="ml-5" onClick="o2o_del('<?php echo url('user/status',['id'=>$vo['id'],'status'=>'-1']); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
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
<!-- <script type="text/javascript" src="__STATIC__/admin/js/echarts.js"></script> -->


<script>
	var SCOPE = {
		'city_url':"<?php echo url('api/City/getCitiesByParentId'); ?>",
		'xypoint_url':"<?php echo url('api/Machine/change'); ?>",
		'machine_url':"<?php echo url('api/Machine/getMacinesByCityId'); ?>",
	};
</script>
</body>
</html>
