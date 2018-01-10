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

//商户入驻申请
function bisRegister($status){
	if($status == 1){
		$str = "入驻成功";
	}
	else if($status == 0){
		$str = "待审核，审核后平台会发送邮件通知！";
	}
	else if($status == -1){
		$str = "非常抱歉，您提交的材料不符合条件，请重新提交";
	}
	else{
		$str = "抱歉，该申请不存在";
	}
	return $str;
}

function pagination($obj){
	if(!$obj){
		return '';
	}
	return '<div class="cl pd-5 bg-1 bk-gray mt-20 tp5-o2o">'.$obj->render().'</div>';
}