<?php
namespace app\common\validate;
use think\Validate;

class User extends Validate{
	protected $rule = [
		['username','require|min:4|max:25','用户名不能为空|用户名长度不能少于6个字符|用户名长度不能超过20个字符'],
		['email','require|email','邮箱不能为空|邮箱格式错误'],
		['emailCode','require','邮箱验证码不能为空'],
		['verifycode','require','邮箱验证码不能为空'],
		['password','require|min:4|max:25','密码不能为空|密码长度不能少于6个字符|密码长度不能超过20个字符'],
		['repassword','require|min:4|max:25','密码不能为空|密码长度不能少于6个字符|密码长度不能超过20个字符'],
	];
	/**场景设置**/
	protected $scene = [
		'login' => ['username','verifycode','password'],
		'register' => ['username','email','emailCode','password','repassword']
	];
}