<?php
namespace app\bis\controller;
use think\Controller;
use think\Request;

class Register extends Controller{

	private $city_obj;
	private $category_obj;

	public function _initialize(){
		$this->city_obj = model('City');
		$this->category_obj = model('Category');
	}
	public function index(){
		$cities = $this->city_obj->getNormalCitiesByParentId();
		$categorys = $this->category_obj->getNormalFirstCategorys();
 		return $this->fetch('',['cities'=>$cities,'categorys'=>$categorys]);
	}

	public function add(Request $request){
		if($request->isPost){
			$this->error('请求错误');
		}
		$data = input('post.');
		//校验数据
		$validate = validate('Bis');
		if(!$validate->scene('add')->check($data)){
			$this->error($validate->getError());
		}

		//获取经纬度
		$lnglat = \Map::getLngLat($data['address']);

		if(empty($lnglat) || $lnglat['status'] != 0){
			$this->error('无法获取经纬度');
		}

		//
		$check = model('BisAccount')->get(['username'=>$data['username']]);
		if($check){
			$this->error('该用户已存在');
		}
		//商户信息入库
		$bisData = [
			'name' => $data['name'],
			'email' => $data['email'],
			'logo' => $data['logo'],
			'licence_logo' => $data['licence_logo'],
			'description' => empty($data['description'])?'':$data['description'],
			'city_id' => $data['city_id'],
			'city_path' => empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
			'bank_info' => $data['bank_info'],
			'bank_name' => $data['bank_name'],
			'bank_user' => $data['bank_user'],
			'legal_person' => $data['legal_person'],
			'legal_person_tel' => $data['legal_person_tel'],
		];
		$bisId = model('Bis')->add($bisData);

		//总店信息入库
		// if(!empty($data['se_category_id'])){
		// 	//$data['cat'] = implode('|',$data['se_category_id']);

		// }
		$locationData = [
			'bis_id' => $bisId,
			'name' => $data['name'],
			'tel' => $data['tel'],
			'contact' => $data['contact'],
			'logo' => $data['logo'],
			'licence_logo' => $data['licence_logo'],
			'category_id' => $data['category_id'],
			'category_path' => empty($data['se_category_id'])?$data['category_id']:$data['category_id'].','.$data['se_category_id'],
			'city_id' => $data['city_id'],
			'city_path' => empty($data['se_city_id'])?$data['city_id']:$data['city_id'].','.$data['se_city_id'],
			'address' => $data['address'],
			'open_time' => $data['open_time'],
			'content' => empty($data['content'])?'':$data['content'],
			'is_main' => 1,//表示为总店
			'xpoint' => empty($lnglat['result']['location']['lng'])?'':$lnglat['result']['location']['lng'],
			'ypoint' => empty($lnglat['result']['location']['lat'])?'':$lnglat['result']['location']['lat'],
		];
		$locationId = model('BisLocation')->add($locationData);

		//自动生成密码的加盐字符串
		$data['code'] = mt_rand(100,10000);

		//商户账户信息入库
		$accountData = [
			'bis_id' => $bisId,
			'code' => $data['code'],
			'username' => $data['username'],
			'password' => md5($data['password'].$data['code']),
			'is_main' => 1,//表示为总店管理员
		];
		$accountId = model('BisAccount')->add($accountData);
		if(!$accountId){
			$this->error('申请失败');
		}

		//发送邮件
		$url = $request->domain().url('bis/register/waiting',['id'=>$bisId]);
		$title = "o2o入驻申请通知";
		$content = "您的入驻申请已提交，请耐心等待。您可以通过点击链接<a href='".$url."' target='_blank'>查看链接</a>查看审核状态";
		\phpmailer\Email::send($data['email'],$title,$content);
		$this->success('申请成功',url('register/waiting',['id'=>$bisId]));
	}

	public function waiting($id){
		if(empty($id)){
			$this->error('error');
		}
		$detail= model('Bis')->get($id);

		return $this->fetch('',[
			'detail' => $detail,
		]);
	}

}
