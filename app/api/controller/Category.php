<?php
namespace app\api\controller;
use think\Controller;

class Category extends Controller{

	private $obj;

	public function _initialize(){
		$this->obj = model('Category');
	}
	public function getCategorysByParentId($id){
		$parent_id = input('post.id',0,'intval');
		if(!$parent_id){
			$this->error('id不存在');
		}
		$categorys = $this->obj->getCategorysByParentIdNoPages($parent_id);
		if($categorys){
		return show(1,'success',$categorys);			
		}
		return show(0,'error');
	}

}
