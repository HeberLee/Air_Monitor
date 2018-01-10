<?php
namespace app\api\controller;
use think\Controller;
use think\Request;

class Machine extends Controller{

	private $obj;

	public function _initialize(){
		$this->obj = model('Machine');
	}
    public function change(Request $request){
        // print_r(request()->post());
      
        $data = request()->post();

        // $validate = validate('machine');
        // if(!$validate->scene('change')->check($data)){
        //     $this->error($validate->getError());
        // }
        $res = $this->obj->update($data,['id' => $data['id']]);
        
    	if($res){
    		$this->result($_SERVER['HTTP_REFERER'],1,'success');
    	}
    	else{
    		$this->result($_SERVER['HTTP_REFERER'],0,'fail');

    	}
	}

}
