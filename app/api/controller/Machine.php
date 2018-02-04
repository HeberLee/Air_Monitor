<?php
namespace app\api\controller;
use think\Controller;
use think\Request;

class Machine extends Controller{

    private $machine_obj;
	private $city_obj;

	public function _initialize(){
        $this->machine_obj = model('Machine');
		$this->city_obj = model('City');
	}

    //修改经纬度
    public function change(Request $request){
        // print_r(request()->post());
      
        $data = request()->post();

        $validate = validate('Machine');
        if(!$validate->scene('change')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->machine_obj->update($data,['id' => $data['id']]);
        
    	if($res){
    		$this->result($_SERVER['HTTP_REFERER'],1,'success');
    	}
    	else{
    		$this->result($_SERVER['HTTP_REFERER'],0,'fail');

    	}
	}

    //根据一级城市的id从数据库取出对应的机器数据
    public function getMacinesByCityId(Request $request){
        // print_r(request()->post());
      
        $data = request()->post();

        $validate = validate('Machine');
        if(!$validate->scene('get_machine_1')->check($data)){
            $this->error($validate->getError());
        }
        $machines = $this->machine_obj->getMacinesByCityId($data['id']);
        
        if($machines){
        return show(1,'success',$machines);            
        }
        return show(0,'error');
    }

//当接收到发来的一级和二级城市名时，拼接成机器名并返回
    public function add(Request $request){
        // print_r(request()->post());
      
        $data = request()->post();
        // return print_r($data);
        $validate = validate('City');
        if(!$validate->scene('add_machine')->check($data)){
            $this->error($validate->getError());
        }
        $city = $this->city_obj->where("id","=",$data['city_id'])
                                ->value("name");
        $se_city = $this->city_obj->where("id","=",$data['se_city_id'])
                                    ->value("name");
        $city_path = $city.'_'.$se_city;
        $res = $this->machine_obj->where('city_path',"=",$city_path)
                                ->max('number');
        $number = empty($res)?1:($res+1);
        $machine_name = $city_path.'_'.$number;

        $allData['city_path'] = $city_path;
        $allData['number'] = $number;
        $allData['city_id'] = $data['city_id'];
        $allData['se_city_id'] = $data['se_city_id'];
        $allData['name'] = $machine_name;

        if($machine_name){
        return show(1,'success',$allData);            
        }
        return show(0,'error');
        
    }



}
