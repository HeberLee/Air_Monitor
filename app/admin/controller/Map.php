<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Map extends Controller
{
    private $machine_obj;
	private $city_obj;

	public function _initialize(){
        $this->machine_obj = model('Machine');
		$this->city_obj = model('City');
	}
    public function index(){
    	// return 'hello monika';
    	// $machines = $this->machine_obj->getMachines();
     //    $cities = $this->city_obj->getNormalCitiesByParentId();
        return $this->fetch();
    }

    public function map_weixin(){
        $map_data = [];

        $conditions = [
            'status' => 1,
        ];
        $data = $this->machine_obj->getMachinesByConditions($conditions);

        foreach ($data as $key => $value) {
            $chart_data[] = [$value['id'],$value['name'],$value['xpoint'],$value['ypoint']];
        }

        $chart_data = json_encode($chart_data);

 
        
         if($chart_data){
        return $chart_data;            
        }
        return 'error';

    }
}
