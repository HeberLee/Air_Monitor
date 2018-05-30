<?php
namespace app\api\controller;
use think\Controller;
use think\Request;

class Weixin extends Controller{

    private $machine_obj;
	private $city_obj;

	public function _initialize(){
        $this->machine_obj = model('Machine');
		$this->city_obj = model('City');
	}




    public function login(Request $request){
        // print_r(request()->post());
        $data = request()->post();
        // $data = [
        // 	'username'=>'heber',
        // 	'password'=>'2333',
        // 	'code'=>'003VlZrF0u16tj2JatvF0iy5sF0VlZrU',
        // ];
        $secret = 'a4921e1e8f0119c6e0db31b15ae97565';
        $appid = 'wx34a963764c39699c';
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&grant_type=authorization_code&js_code='.$data['code'];
        $res = file_get_contents($url);
    	$wxres = json_decode($res,true);
    	$wxres['openid'] = md5($wxres['openid']);

		$userData = model('User')->get(['username'=>$data['username']]);
        if(empty($userData)){
            return 0;
        }
        if($userData['password'] != md5($data['password'].$userData['code'])){
            return 1;
        }
        $res = model('User')->where('username','=',$userData['username'])
        					->update([
        						'openid' => $wxres['openid']
        					]);

      	return $wxres['openid'];

    }

/**
 * 为小程序的用户注册提供的接口，将用户的信息填入到数据库
 * @Author   HeberLee
 * @DateTime 2018-04-20T18:26:51+0800
 * @return   [type]                   [description]
 */
    public function register(){
    	if(request()->isPost()){
    		$data = input('post.');

    		// $data = [
    		// 	'username' => 'heber3',
    		// 	'password' => '2333',
    		// 	'email' => '920',
    		// ];
    		$data['code'] = mt_rand(100,10000);
    		$userData = [
    			'username' => $data['username'],
    			'password' => md5($data['password'].$data['code']),
    			'code' => $data['code'],
    			'email' => $data['email'],
    		];

 
    		$id = model('User')->add($userData);

    		if(!empty($id)){
    			return 1;
    		}
            else{
                return 0;
            }

    	}
    	else{
    		return 'error';
    	}
    }

    /**
 * 用于为微信小程序提供图表数据
 * @Author   HeberLee
 * @DateTime 2018-04-14T13:34:44+0800
 * @param    integer                  $machine_id [description]
 * @param    string                   $date       [description]
 * @return   [type]                               [description]
 */
    public function chart($name="泉州_鲤城区_1",$date="2018-3-4"){
        $chart_data = [];
        $start_time = strtotime($date);
        $end_time = $start_time+24*60*60;
        $conditions = [
            'machine_name' => $name,
            'time' => ['between',"$start_time,$end_time"]
        ];
        $data = model('data_quanzhou')->getDataByConditions($conditions);

        foreach ($data as $key => $value) {
            $chart_data[] = [date("H:i",$value['time']),$value['data']];
        }

        // $chart_data = json_encode($chart_data);

         if($chart_data){
         return($chart_data);            
        }
        return 'error';
      // dump($chart_data);
    }
/**
 * 为微信选择栏提供城市名
 * @Author   HeberLee
 * @DateTime 2018-05-06T20:46:32+0800
 * @return   [type]                   [description]
 */
    public function machine_names(){
        $data = model('machine')->getMachines();
        foreach($data as $key=>$value){
            $names[] = $value['name']; 
        }
        if($names){
            return $names;
        }
    }

/**
 * 用于微信小程序生成地图
 * @Author   HeberLee
 * @DateTime 2018-05-09T21:57:22+0800
 * @return   [type]                   [description]
 */
    public function map(){
        $map_data = [];

        $conditions = [
            'status' => 1,
        ];
        $data = model('machine')->getMachinesByConditions($conditions);

        foreach ($data as $key => $value) {
            $chart_data[] = [$value['id'],$value['name'],$value['xpoint'],$value['ypoint']];
        }

        // $chart_data = json_encode($chart_data);

 
        
         if($chart_data){
        return $chart_data;            
        }
        return 'error';

    }

/**
 * 获取对应的email信息
 * @Author   HeberLee
 * @DateTime 2018-05-23T21:23:05+0800
 * @param    [type]                   $openid [description]
 * @return   [type]                           [description]
 */
    public function emailInfo($openid){
        
        $data = model('User')->getEmailInfo($openid);
        $emailInfo = [
            'email' => $data['email'],
            'emailStatus' => $data['emailStatus'],
        ];
        return $emailInfo;

    }

    public function switchEmail($openid,$emailStatus){
        $res = model('User')->update(['emailStatus'=>$emailStatus],['openid'=>$openid]);
        return 'success';

    }

    public function resetEmail($openid,$email){
        $res = model('User')->update(['email'=>$email],['openid'=>$openid]);
        return 'success';

    }

    public function sendEmail(){
        if(request()->isPost()){
            $data = input('post.');
            $title = "监测系统";
            $code = $this->randCode(6,3);
        // $content = "您的验证码是".$code."请妥善保管！";
        $content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

    <html xmlns="http://www.w3.org/1999/xhtml">

    　<head>

    　　<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    　　<title>邮箱验证</title>

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

            return $code;
        }
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

    public function test(){
        // return show(1,"success",'hello');
        $cc = [["2018-03-04 00:24",35],["2018-03-04 01:19",84],["2018-03-04 01:34",87],["2018-03-04 03:19",95],["2018-03-04 04:29",5],["2018-03-04 04:34",39],["2018-03-04 04:44",99],["2018-03-04 06:09",20],["2018-03-04 06:29",16],["2018-03-04 06:34",32],["2018-03-04 07:14",1],["2018-03-04 08:44",8],["2018-03-04 09:34",36],["2018-03-04 09:39",11],["2018-03-04 10:04",14],["2018-03-04 10:19",58],["2018-03-04 11:09",75],["2018-03-04 11:59",7],["2018-03-04 13:49",82],["2018-03-04 14:19",2],["2018-03-04 14:39",32],["2018-03-04 15:04",99],["2018-03-04 15:24",18],["2018-03-04 15:34",24],["2018-03-04 16:09",20],["2018-03-04 16:19",56],["2018-03-04 16:59",92],["2018-03-04 17:14",92],["2018-03-04 17:24",61],["2018-03-04 17:39",23],["2018-03-04 17:59",99],["2018-03-04 18:09",21],["2018-03-04 19:44",33],["2018-03-04 20:19",15],["2018-03-04 21:39",81],["2018-03-04 21:54",5],["2018-03-04 22:29",9],["2018-03-04 23:04",70],["2018-03-04 23:49",35]];
        $cc = json_encode($cc);
        return $cc;
    }

}
