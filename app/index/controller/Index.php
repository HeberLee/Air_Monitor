<?php
namespace app\index\controller;
use think\Controller;


class Index extends Controller{
    public function index(){
    	return $this->fetch();
    }

    public function test(){
    	return \Map::getLngLat('泉州华侨大学');
    }

    public function map(){
    	return \Map::getStaticImage('泉州华侨大学');
    }

}
