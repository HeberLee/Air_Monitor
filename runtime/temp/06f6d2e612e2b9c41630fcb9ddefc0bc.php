<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\Software\phpstudy\WWW\study\Air_Monitor\public/../app/admin\view\user\login.html";i:1527409864;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>登录</title>
    <link rel="stylesheet" href="__STATIC__/index/css/base.css" />
    <link rel="stylesheet" href="__STATIC__/index/css/login.css" />
    <script type="text/javascript" src="__STATIC__/index/js/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/respond.min.js"></script>
    <script type="text/javascript" src="__STATIC__/index/js/jquery-1.11.3.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="head">
            <div class="login-link">
                <span>还没帐号</span>
                <a href="register.html">注册</a>
            </div>
        </div>

        <div class="content">
            <div class="wrap">
                <div class="login-logo"></div>
                <div class="login-area">
                    <div class="title">登录</div>
                    <div class="login">
                        <form action="<?php echo url('user/login'); ?>" method='post'>
                            <div class="ordinaryLogin">
                                
                                <p class="pass-form-item">
                                    <label class="pass-label">用户名</label>
                                    <input type="text" name="username" class="pass-text-input" placeholder="用户名">
                                </p>
                                <p class="pass-form-item">
                                    <label class="pass-label">密码</label>
                                    <input type="password" name="password" class="pass-text-input" placeholder="密码">
                                </p>
                                <p class="pass-form-item">
                                    <label class="pass-label">验证码</label>
                                    <input type="text" name="verifycode" class="pass-text-input " placeholder="请输入验证码">
                                <img id="verifycode_img" title="点击更换" src="<?php echo captcha_src(); ?>" onclick="this.src='<?php echo captcha_src(); ?>?seed='+Math.random()"> 
                                </p>
                                
                            </div>
                           
                            <div class="commonLogin">
                                <p class="pass-form-item">
                                    <input type="submit" value="登录" class="pass-button">
                                    
                                    
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <ul class="first">
               
            </ul>
            <ul class="second">
                
                
            </ul>
        </div>
    </div>
    <script>
        $(".pass-sms-btn").click(function(){
            $(".ordinaryLogin").css({display: "none"});
            $(".messageLogin,.question").css({display: "block"});
        });
        $(".pass-sms-link").click(function(){
            $(".messageLogin,.question").css({display: "none"});
            $(".ordinaryLogin").css({display: "block"});
        });
    </script>
</body>
</html>