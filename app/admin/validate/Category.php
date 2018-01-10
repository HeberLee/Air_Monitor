<?php
namespace app\admin\validate;
use think\Validate;

class Category extends Validate{
	protected $rule = [
		['name','require|max:25','分类不能为空|分类长度不能超过20个字符'],
		['parent_id','number'],
		['id','number'],
		['status','number|in:-1,0,1','状态必须为数字|状态值不合法'],
		['listorder','number'],
	];
	/**场景设置**/
	protected $scene = [
		'add' => ['name','parent_id'],
		'listorder' => ['id','listorder'],
		'status' => ['id','status'],
	];
}