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
/**
 * [新增监测点展示及搜索功能实现]
 * @Author   HeberLee
 * @DateTime 2018-03-11T11:32:53+0800
 * @param    integer                  $parent_id [description]
 * @return   [type]                              [description]
 */
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
        if(isset($data['status'])){
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
/**
 * 添加监测点省市联动的实现
 * @Author   HeberLee
 * @DateTime 2018-03-11T11:36:28+0800
 */
    public function add(){
    	$cities = $this->city_obj->getNormalCitiesByParentId();
        return $this->fetch('',[
        	'cities' => $cities,
        ]);
    }
/**
 * 添加监测点页面的保存功能
 * @Author   HeberLee
 * @DateTime 2018-03-11T11:42:10+0800
 * @param    Request                  $request [description]
 * @return   [type]                            [description]
 */
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
/**
 * 在监测点展示页面修改仪器开关状态
 * @Author   HeberLee
 * @DateTime 2018-03-11T11:42:48+0800
 * @return   [type]                   [description]
 */
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
