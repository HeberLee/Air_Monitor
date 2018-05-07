<?php
namespace app\admin\controller;
use think\Controller;

class Chart extends Controller
{
	private $machine_obj;
	private $city_obj;
	private $data_quanzhou_obj;

	public function _initialize(){
        $this->machine_obj = model('Machine');
		$this->city_obj = model('City');
		$this->data_quanzhou_obj = model('DataQuanzhou');
	}

    public function index(){

    	$machines = $this->machine_obj->getMachines();
        return $this->fetch('',[
        	'machines'=>$machines,
        ]);
    }

/**
 * 用于生成网页端echart图表所需的数据
 * @Author   HeberLee
 * @DateTime 2018-04-08T16:56:45+0800
 * @param    integer                  $machine_id [description]
 * @param    string                   $start_time [description]
 * @param    string                   $end_time   [description]
 * @return   [type]                               [description]
 */
    public function chart($machine_id=1,$start_time='2012-1-1',$end_time='2030-1-1'){
    	if(empty($start_time)){
    		$start_time='2012-1-1';
    	}

    	if(empty($end_time)){
    		$end_time='2030-1-1';
    	}
    	$chart_data = [];
    	$start_time = strtotime($start_time);
    	$end_time = strtotime($end_time);
    	$conditions = [
    		'machine_id' => $machine_id,
    		'time' => ['between',"$start_time,$end_time"]
    	];
    	$data = $this->data_quanzhou_obj->getDataByConditions($conditions);

    	foreach ($data as $key => $value) {
    		$chart_data[] = [date("Y-m-d H:i",$value['time']),$value['data']];
    	}

    	// $chart_data = json_encode($chart_data);

    	// dump($chart_data);
    	
    	 if($chart_data){
        return show(1,'success',$chart_data);            
        }
        return show(0,'error');
    }


}


