<?php
namespace app\common\model;
use think\Model;
use think\Request;

class City extends Model{
	protected $autoWriteTimestamp = true;

	public function getNormalCitiesByParentId($parent_id=0){
		$data = [
			'parent_id' => $parent_id,
			'status' => 1,
		];
		$order = [
			'id' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

	public function ins(){

		$this->saveAll([
			['name' => '泉州',
			'uname' => 'quanzhou'],
			['name' => '福州',
			'uname' => 'fuzhou'],
			['name' => '丰泽区',
			'uname' => 'fengzequ'],
			['name' => '洛江区',
			'uname' => 'luojiangqu'],
			['name' => '鲤城区',
			'uname' => 'lichengqu'],
			['name' => '鼓楼区',
			'uname' => 'gulouqu'],
			['name' => '马尾区',
			'uname' => 'maweiqu'],
		]);
	}


}