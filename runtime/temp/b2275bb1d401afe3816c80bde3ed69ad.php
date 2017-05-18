<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"E:\pp\php\fastadmin\public/../application/admin\view\index\login.html";i:1495003774;s:69:"E:\pp\php\fastadmin\public/../application/admin\view\common\meta.html";i:1495003774;s:71:"E:\pp\php\fastadmin\public/../application/admin\view\common\script.html";i:1495003774;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="shortcut icon" href="__CDN__/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="__CDN__/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="__CDN__/assets/js/html5shiv.js"></script>
  <script src="__CDN__/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config: {
            'config': <?php echo json_encode($config); ?>
        }
    };
</script>

        <style type="text/css">
            body {
                color:#999;
            }
            .login-panel{margin-top:150px;}
            .login-screen {
                max-width:400px;
                padding:0;
                margin:100px auto 0 auto;

            }
            .login-screen .well {
                border-radius: 3px;
                -webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background: rgba(255,255,255, 0.2);
            }
            .login-screen .copyright {
                text-align: center;
            }
            @media(max-width:767px) {
                .login-screen {
                    padding:0 20px;
                }
            }
            .profile-img-card {
                width: 100px;
                height: 100px;
                margin: 10px auto;
                display: block;
                -moz-border-radius: 50%;
                -webkit-border-radius: 50%;
                border-radius: 50%;
            }
            .profile-name-card {
                text-align: center;
            }

            #login-form {
                margin-top:20px;
            }
            #login-form .input-group {
                margin-bottom:15px;
            }

        </style>
        <script>
            //此处为FastAdmin的统计代码,正式使用请移除
            var _hmt = _hmt || [];
            (function () {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?58347d769d009bcf6074e9a0ab7ba05e";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
    </head>
    <body>
        <div class="container">
            <div class="login-wrapper">
                <div class="login-screen">
                    <div class="well">
                        <div class="login-form">
                            <img id="profile-img" class="profile-img-card" src="__CDN__/assets/img/avatar.png" />
                            <p id="profile-name" class="profile-name-card"></p>
                            <form action="" method="post" id="login-form">
                                <?php echo token(); ?>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                                    <input type="text" class="form-control" id="pd-form-username" placeholder="" name="username" autocomplete="off" required="required" value="admin" />
                                </div>

                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></div>
                                    <input type="password" class="form-control" id="pd-form-password" placeholder="" name="password" autocomplete="off" required="required" value="123456" />
                                </div>

                                <div class="form-group">
                                    <label class="inline" for="keeplogin">
                                        <input type="checkbox" name="keeplogin" id="keeplogin" value="1" />
                                        <?php echo __('Keep login'); ?>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><?php echo __('Sign in'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <p class="copyright"><a href="http://www.fastadmin.net?ref=demo">Powered By FastAdmin</a></p>
                </div>
            </div>
        </div>
        <script src="__CDN__/assets/js/require.js" data-main="__CDN__/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>