<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $userInfo = session('user','','AM');
        return $this->fetch('',[
            'userInfo' => $userInfo,
        ]);
    }
     public function test(){
        //1520845983
    	model('DataQuanzhou')->ins();
    }
    public function welcome(){
      //  \phpmailer\Email::send('907008122@qq.com','heelo','monika');
    	echo "surprise!";
    }
}
