<?php
namespace app\common\model;
use think\Model;
use think\Request;

class DataQuanzhou extends Model{
	protected $autoWriteTimestamp = true;

	public function add($data){
		$data['status'] = 1;
		return $this->save($data);
	}

	public function ins(){
		$machine_name = ['泉州_丰泽区_1','泉州_丰泽区_3','泉州_丰泽区_2','泉州_鲤城区_1','泉州_鲤城区_2','泉州_洛江区_1','泉州_洛江区_2'];
		$se_city_id = ['1','3','2','1','2','1','2'];
		$machine_id = ['1','7','2','3','11','4','5'];
		for($i = 0;$i<2000;$i++){
			$x = rand(0,6);
			// $data['machine_name'] = $machine_name[$x];
			// $data['se_city_id'] = $se_city_id[$x];
			// $data['data'] = rand(0,100);
			// $data['time'] = rand(1510845983,1520945983);
			// $data['status'] = '1';
			$data[] = [
				'machine_name' => $machine_name[$x],
				'machine_id' => $machine_id[$x],
				'se_city_id' =>  $se_city_id[$x],
				'data' => rand(0,100),
				'time' => 1520045983+5*60*$i,
				'status' => '1',
				'create_time' => time(),
				'update_time' => time(),
			];
			$this->insertAll($data);
			unset($data);

		}
		
	}

	public function getDataByConditions($conditions){
		// $data[] = [
		// 	'status' => ['eq','1'],
		// ];
		$order = [
			'time' => 'asc',
		];
		return $this->where($conditions)
					->order($order)
					->column('time,data','id');
	}


}