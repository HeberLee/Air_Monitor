<?php
namespace app\common\model;
use think\Model;
use think\Request;

class Machine extends Model{
	protected $autoWriteTimestamp = true;

	public function add($data){
		$data['status'] = 1;
		return $this->save($data);
	}

	public function ins(){

		$this->saveAll([
			['city_path' => '泉州_丰泽区',
			'number' => '1'],
			['city_path' => '泉州_丰泽区',
			'number' => '2'],		
			['city_path' => '泉州_鲤城区',
			'number' => '1'],		
			['city_path' => '泉州_洛江区',
			'number' => '1'],		
			['city_path' => '泉州_洛江区',
			'number' => '2'],					
		]);
	}

	public function getMachines(){
		$data = [
			'status' => ['neq','-1'],
		];
		$order = [
			'id' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}

	public function getMachinesByConditions($data){
		// $data[] = [
		// 	'status' => ['eq','1'],
		// ];
		$order = [
			'id' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}
//根据一级城市获取对应机器
	public function getMacinesByCityId($city_id){
		$data = [
			'city_id' => ['eq',$city_id],
			'status' => ['neq','-1'],
		];
		$order = [
			'id' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->select();
	}


	// public function getMachinesByParentId($parent_id){
	// 	$data = [
	// 		'parent_id' => $parent_id,
	// 		'status' => ['neq','-1'],
	// 	];
	// 	$order = [
	// 		'listorder' => 'asc',
	// 	];
	// 	return $this->where($data)
	// 				->order($order)
	// 				->paginate(5);
	// }

	// public function getMachinesByParentIdNoPages($parent_id){
	// 	$data = [
	// 		'parent_id' => $parent_id,
	// 		'status' => ['neq','-1'],
	// 	];
	// 	$order = [
	// 		'listorder' => 'asc',
	// 	];
	// 	return $this->where($data)
	// 				->order($order)
	// 				->select();
	// }
}