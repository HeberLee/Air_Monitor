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

}
