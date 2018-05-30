<?php
namespace app\common\model;
use think\Model;


class User extends Model{
	protected $autoWriteTimestamp = true;

	public function add($data=[]){
		$data['status'] = 0;
		$id = $this->save($data);
		return $id;
	}

	public function test(){
		return 'yes';
	}

	public function getEmailInfo($openid){
		$data = [

			'openid' => $openid,
		];
		$order = [
			'id' => 'asc',
		];
		return $this->where($data)
					->order($order)
					->find();
	}
}