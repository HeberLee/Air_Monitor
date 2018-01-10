<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\File;

class Image extends Controller{
//$_SERVER['SCRIPT_NAME'].'/../'.$info->getPathname()
	public function upload(Request $request){
		$file = $request->file('file');
		//指定上传文件存放路径
		$info = $file->move('upload');
		if($info && $info->getPathname()){
			//更换环境时，第三个参数返回的路径可能有问题，需注意
			return show(1,'success',$_SERVER['SCRIPT_NAME'].'/../'.$info->getPathname());
		}
		else{
			return show(0,'upload error!');
		}
	}

}