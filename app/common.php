<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function status($status){
	if($status == 1){
		$str = "<span class='label label-success radius'>正常</span>";
	}
	else if($status == 0){
		$str = "<span class='label label-danger radius'>关闭</span>";
	}
	else if($status == -1){
		$str = "<span class='label label-danger radius'>删除</span>";
	}
	return $str;
}

/**
 * 用户审核-待审核和不通过的状态修饰
 * @Author   HeberLee
 * @DateTime 2018-05-27T15:00:28+0800
 * @param    [type]                   $status [description]
 * @return   [type]                           [description]
 */
function applystatus($status){
	if($status == 0){
		$str = "<span class='label label-warning radius'>待审核</span>";
	}
	else if($status == -1){
		$str = "<span class='label label-danger radius'>不通过</span>";
	}
	return $str;
}

/**
 * 用户列表-普通用户和管理员的状态修饰
 * @Author   HeberLee
 * @DateTime 2018-05-27T15:00:28+0800
 * @param    [type]                   $status [description]
 * @return   [type]                           [description]
 */
function liststatus($status){
	if($status == 1){
		$str = "<span class='label label-success radius'>普通用户</span>";
	}
	else if($status == 2){
		$str = "<span class='label label-primary radius'>管理员</span>";
	}
	return $str;
}

function doCurl($url,$type=0,$data=[]){
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);

	if($type == 1){
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	}

	$output = curl_exec($ch);
	//释放句柄
	curl_close($ch);
	return $output;
}



function pagination($obj){
	if(!$obj){
		return '';
	}
	return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->render().'</div>';
}