<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Machine extends Controller
{
    private $machine_obj;
	private $city_obj;

	public function _initialize(){
        $this->machine_obj = model('Machine');
		$this->city_obj = model('City');
	}
    public function index($parent_id=0){
    	// return 'hello monika';
        $data = input('get.');
        $sdata = [];
        $machines = [];
        $cities = $this->city_obj->getNormalCitiesByParentId();



        if(!empty($data['se_city_id'])){
            $sdata['se_city_id'] = $data['se_city_id'];
        }

        if(!empty($data['city_id'])){
            $sdata['city_id'] = $data['city_id'];
        }
        if(!empty($data['status'])){
            if($data['status']==2){
                $sdata['status'] = ['in','0,1'];
            }
            else{
                $sdata['status'] = $data['status'];
            }
            
        }

        if(!empty($data['name'])){
            $sdata['name'] = ['like','%'.$data['name'].'%'];

        }

        if(!empty($sdata)){

            $machines = model('machine')->getMachinesByConditions($sdata);
        }
        else{
            $machines = model('machine')->getMachines($sdata);
        }


        return $this->fetch('',[
            'cities'=>$cities,
            'se_cities'=>empty($se_cities)?'':$data['se_cities'],
            'machines'=>$machines,
            'se_city_id' => empty($data['se_city_id'])?'':$data['se_city_id'],
            'status'=> empty($data['status'])?'':$data['status'],
            'city_id' => empty($data['city_id'])?'':$data['city_id'],
            'name' => empty($data['name'])?'':$data['name'],

        ]);

    }

    public function add(){
    	$cities = $this->city_obj->getNormalCitiesByParentId();
        return $this->fetch('',[
        	'cities' => $cities,
        ]);
    }

    // public function edit($id){
    // 	if(intval($id) < 1){
    // 		$this->error('参数不合法');
    // 	}
    // 	$machine = $this->obj->get($id);
    // 	$machines = $this->obj->getNormalFirstmachines();
    //     return $this->fetch('',[
    //     	'machine' => $machine,
    //     	'machines' => $machines,
    //     ]);
    // }

    public function save(Request $request){
        // print_r(request()->post());
        $data = request()->post();
        $validate = validate('machine');
        if(!$validate->scene('add_machine')->check($data)){
            $this->error($validate->getError());
        }
        unset($data['se_city_id_add']);
        unset($data['cityId_add']);


        $res = $this->machine_obj->add($data);
        
        if($res){
            $this->success('添加成功');
        }
        else{
            $this->error('添加失败');
        }
    }

    public function change(Request $request){
        // print_r(request()->post());
        $data = request()->post();

        $validate = validate('machine');
        if(!$validate->scene('change')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->update($data,['id' => $data['id']]);
        
        if($res){
            $this->success('更新分类成功');
        }
        else{
            $this->error('更新分类失败');
        }
    }

    public function status(){
    	$data = input('get.');
    	$validate = validate('machine');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->machine_obj->update($data,['id' => $data['id']]);
        if($res){
            $this->success('更新状态成功');
        }
        else{
            $this->error('更新状态失败');
        }
    }
}
