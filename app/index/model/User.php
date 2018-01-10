<?php
namespace app\index\model;
use think\Model;

class User extends Model{
	protected $autoWriteTimestamp = true;
	protected $createTime = "create_in";
	protected $updateTime = "update_in";
}