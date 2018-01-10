<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Bis extends Controller
{
    private $obj;

    public function _initialize(){
        $this->obj = model('Bis');
    }

	public function apply(){
        $bises = $this->obj->getBises();
        return $this->fetch('',['bises'=>$bises]);
    }

    public function status(){
        $data = input('get.');
        $validate = validate('Category');
        if(!$validate->scene('status')->check($data)){
            $this->error($validate->getError());
        }
        $res = $this->obj->update($data,['id'=>$data['id']]);
        if($res){
            $this->success('更新状态成功！');
        }
        else{
            $this->error('更新状态失败！');
        }
    }

    public function detail(){
        return $this->fetch();
    }
}
