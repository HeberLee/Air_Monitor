<?php
namespace app\admin\controller;
use think\Controller;


class User extends Controller{
    // public function index(){
    //     return $this->fetch();
    // }

    public function login(){
        if(request()->isPost()){
            $data = input('post.');
            //校验数据
            $validate = validate('User');
            if(!$validate->scene('login')->check($data)){
                $this->error($validate->getError());
            }  
            if(!captcha_check($data['verifycode'])){
                $this->error('验证码错误');
            }
            $userData = model('User')->get(['username'=>$data['username']]);
            if(empty($userData)){
                $this->error('该用户不存在');
            }
            if($userData['password'] != md5($data['password'].$userData['code'])){
                $this->error('密码错误');
            }
            if($userData['status'] != 2){
                $this->error('用户权限不足');
            }
            
            session('user',$userData,'AM');
            $this->success('登录成功','admin/index/index');

        }
    	return $this->fetch();
    	
    }
    public function register(){
    	if(request()->isPost()){
    		$data = input('post.');
    		// if(!captcha_check($data['verifycode'])){
    		// 	$this->error('验证码错误');
    		// }
             //校验数据
            $validate = validate('User');
            if(!$validate->scene('register')->check($data)){
                $this->error($validate->getError());
            }  
    		$judge = model('User')->get(['username'=>$data['username']]);
    		if(!empty($judge)){
    			$this->error('用户名已存在');
    		}
            $judge = model('User')->get(['email'=>$data['email']]);
            if(!empty($judge)){
                $this->error('邮箱已被使用');
            }
            $emailCode = session('emailCode','','AM');
            if(strtoupper($data['emailCode']) !== $emailCode){
                $this->error('邮箱验证码错误');
            }
    		if($data['password'] != $data['repassword']){
    			$this->error('前后密码不一致');
    		}
    		$data['code'] = mt_rand(100,10000);
    		$userData = [
    			'username' => $data['username'],
    			'password' => md5($data['password'].$data['code']),
    			'code' => $data['code'],
    			'email' => $data['email'],
    		];

    		$id = model('User')->add($userData);
    		if(!empty($id)){
                session('emailCode',null,'AM');
    			$this->success('注册成功','user/login');
    		}
            else{
                $this->error('注册失败');
            }

    	}
    	else{
    		return $this->fetch();
    	}
    }

    public function apply(){
        if(request()->isPost()){
            $data = input('post.');
            $stime = strtotime($data['start_time']);
            $etime = strtotime($data['end_time']);
            $order['create_time'] = 'desc';
            $map = [];
            if($stime && $etime){
                $map['create_time'] = ['between',[$stime,$etime]];
            }
            if($stime && !$etime){
                $map['create_time'] = ['gt',$stime];    
            }
            if(!$stime && $etime){
                $map['create_time'] = ['lt',$etime];
            }
            $status = $data['status'];
            if($status){
                $map['status'] = $status;
            }else{
                $map['status'] = ['in',['-1','0']];
            }
            $name = $data['name'];
            if($name){
                $map['username'] = ['like',"%".$name."%"];
            }
            $userinfo = model('user')->where($map)->order($order)->select();
             return $this->fetch('',[
            'status'=>$status,
            'start_time'=>$data['start_time'],
            'end_time'=>$data['end_time'],
            'name' => $name,
            'userinfo' => $userinfo
             ]);

        }
        else{
            $map['status'] = ['in',['0','-1']];
            $order['create_time'] = 'desc';
            $userinfo = model('user')->where($map)->order($order)->select();
            return $this->fetch('',[
                'status'=>'',
                'start_time'=>'',
                'end_time'=>'',
                'name' =>'',
                'userinfo' => $userinfo

            ]);
        }
    }


    public function userList(){
        if(request()->isPost()){
            $data = input('post.');
            $stime = strtotime($data['start_time']);
            $etime = strtotime($data['end_time']);
            $map=[];
            $order['create_time'] = 'desc';
            if($stime && $etime){
                $map['create_time'] = ['between',[$stime,$etime]];
            }
            if($stime && !$etime){
                $map['create_time'] = ['gt',$stime];    
            }
            if(!$stime && $etime){
                $map['create_time'] = ['lt',$etime];
            }
            $status = $data['status'];
            if($status){
                $map['status'] = $status;
            }else{
                $map['status'] = ['in',['1','2']];
            }
            $name = $data['name'];
            if($name){
                $map['username'] = ['like',"%".$name."%"];
            }
            $userinfo = model('user')->where($map)->order($order)->select();
             return $this->fetch('',[
            'status'=>$status,
            'start_time'=>$data['start_time'],
            'end_time'=>$data['end_time'],
            'name' => $name,
            'userinfo' => $userinfo
             ]);

        }
        else{
            $map['status'] = ['in',['1','2']];
            $order['create_time'] = 'desc';
            $userinfo = model('user')->where($map)->order($order)->select();
            return $this->fetch('',[
                'status'=>'',
                'start_time'=>'',
                'end_time'=>'',
                'name' =>'',
                'userinfo' => $userinfo

            ]);
        }
    }
/**
 * 在用户申请页面修改用户状态
 * @Author   HeberLee
 * @DateTime 2018-03-11T11:42:48+0800
 * @return   [type]                   [description]
 */
    public function status(){
        $data = input('get.');
        $res = model('user')->update($data,['id' => $data['id']]);
        if($res){
            $this->success('更新状态成功');
        }
        else{
            $this->error('更新状态失败');
        }
    }

    public function sendEmail(){
        if(request()->isPost()){
            $data = input('post.');
            $title = "监测系统";
            $code = $this->randCode(6,3);
            session('emailCode',$code,'AM');
        // $content = "您的验证码是".$code."请妥善保管！";
        $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">

    　<head>

    　　<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    　　<title>HTML Email编写指南</title>

    　　<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    　</head>


    <body style="margin: 0; padding: 0;">

    　<table style="width: 538px; background-color: #393836;" cellpadding="0" cellspacing="0" align="center">

    　　<tr>
    　　　<td bgcolor="#17212e"> 

    <table style="padding-left: 5px; padding-right: 5px; padding-bottom: 10px;" width="470" cellpadding="0" cellspacing="0" border="0" align="center">

    　<tr bgcolor="#17212e">
    　　<td style="padding-top: 32px"> 
        <span style="padding-top: 16px; padding-bottom: 16px; font-size: 24px; color: #66c0f4; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
                敬爱的用户:
            </span>
            <br>
         </td>
    　</tr>
        
    　<tr>
    　　<td style="padding-top: 12px">
            <span style="font-size: 17px; color: #c6d4df; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">
                <p>
                    以下是您注册账户所需的邮箱验证码：
                </p>
            </span>
    </td>
    　</tr>

    　<tr>
    　　<td>
            <div>
                <span style="font-size: 24px; color: #66c0f4; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">'.$code.'</span>
            </div>
        </td>
    　</tr>
    <tr bgcolor="#121a25">
        <td style="padding: 20px; font-size: 12px; line-height: 17px; color: #c6d4df; font-family: Arial, Helvetica, sans-serif;">
            <p>
                这封电子邮件生成是因为有人在注册设备监测账号时，输入了这个邮箱地址。如果不是您本人操作，请无视这封邮件。
            </p>
        </td>
    </tr>

    </table>
 </td>
    　　</tr>

    　</table>

    </body>

    </html>';
            $res = \Email::send($data['email'],$title,$content);
            if($res){
                session('emailCode',$code,'AM');
            }
            return $code;
        }
    }

    public function logout(){
        session(null,'AM');
        $this->redirect(url('user/login'));
    }

    public function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } elseif ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $string[rand(0, $count)];
    }
    return $code;
}


}
