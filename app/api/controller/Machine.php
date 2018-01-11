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

    public function add(Request $request){
        // print_r(request()->post());
      
        $data = request()->post();

        $validate = validate('City');
        if(!$validate->scene('add_machine')->check($data)){
            $this->error($validate->getError());
        }
        $city_path = $data['city_id'].'_'.$data['se_city_id'];
        $res = $this->machine_obj->where('city_path' => $city_path)
                                ->max('number');
        $number = empty($res)?1:($res+1);
        $machine_name = $city_path.'_'.$number;
        if($machine_name){
        return show(1,'success',$machine_name);            
        }
        return show(0,'error');
    }



}
