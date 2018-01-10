<?php
namespace app\common\model;
use think\Model;
use think\Request;

class Bis extends BaseModel{
	public function getBises(){
		$data = [
			// 'parent_id' => 0,
			// 'status' => 1,
		];
		$order = [
			'create_time' => 'desc',
		];
		return $this->where($data)
					->order($order)
					->paginate(5);

	}
}