<?php
namespace app\admin\controller;
use think\Controller;

class Index extends Controller
{
    public function index()
    {

        return $this->fetch();
    }
     public function test(){
    	echo "hello heber";
    }
    public function welcome(){
      //  \phpmailer\Email::send('907008122@qq.com','heelo','monika');
    	echo "surprise!";
    }
}
