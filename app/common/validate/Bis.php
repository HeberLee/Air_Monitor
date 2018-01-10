<?php
namespace app\common\validate;
use think\Validate;

class Bis extends Validate{
	protected $rule = [
		'name' => 'require|max:25',
		'email' => 'email',
		'logo' => 'require',
		'licence_logo' => 'require',
		'city_id' => 'require',
		'bank_info' => 'require',
		'bank_name' => 'require',
		'bank_user' => 'require',
		'legal_person' => 'require',
		'legal_person_tel' => 'require',
		'tel' => 'require',
		'contact' => 'require',
		'category_id' => 'require',
		'address' => 'require',
		'open_time' => 'require',
		'username' => 'require|max:18',
		'password' => 'require|max:18',
	];
	/**场景设置**/
	protected $scene = [
		'add' => ['name','email','logo','city_id','bank_info','bank_name','bank_user','legal_person','legal_person_tel','tel','contact','category_id','address','open_time','username','password'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}