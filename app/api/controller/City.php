<?php
namespace app\api\controller;
use think\Controller;

class City extends Controller{

	private $obj;

	public function _initialize(){
		$this->obj = model('City');
	}
	public function getCitiesByParentId($id){
		$parent_id = input('post.id');
		if(!$parent_id){
			$this->error('id不存在');
		}
		$cities = $this->obj->getNormalCitiesByParentId($parent_id);
		if($cities){
		return show(1,'success',$cities);			
		}
		return show(0,'error');
	}

}
