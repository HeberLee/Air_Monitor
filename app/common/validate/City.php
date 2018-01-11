<?php
namespace app\common\validate;
use think\Validate;

class City extends Validate{
	protected $rule = [
		['city_id','number'],
		['se_city_id','number'],
	];
	/**场景设置**/
	protected $scene = [
		'add_machine' => ['city_id','se_city_id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}