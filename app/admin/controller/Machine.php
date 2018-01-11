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
    	$machines = $this->machine_obj->getMachines();
        $cities = $this->city_obj->getNormalCitiesByParentId();
        return $this->fetch('',[
            'machines' => $machines,
        	'cities' => $cities,
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
        if(!$validate->scene('add')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->add($data);
        
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
