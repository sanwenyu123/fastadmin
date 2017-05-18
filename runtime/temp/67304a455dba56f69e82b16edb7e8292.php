<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"E:\pp\php\fastadmin\public/../application/index\view\user\login.html";i:1495003774;s:74:"E:\pp\php\fastadmin\public/../application/index\view\layout\bootstrap.html";i:1495003774;}*/ ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>FastAdmin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="基于ThinkPHP5和Bootstrap的极速后台开发框架">
        <link rel="shortcut icon" href="__CDN__/assets/img/favicon.ico" />
        <!-- Loading Bootstrap -->
        <link href="__CDN__/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
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
        <style>
            html{height:100%;overflow:auto;-webkit-overflow-scrolling: touch;}
            body{padding:70px 0;}
        </style>

        <script>
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
        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header pull-left">
                    <a href="<?php echo url('/'); ?>" class="navbar-brand">FastAdmin</a>
                </div>
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">更多示例 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a id="userindex" href="<?php echo url('user/index'); ?>">会员中心</a></li>
                            <li><a id="thirdlogin" href="<?php echo url('user/login'); ?>">第三方登录</a></li>
                            <li><a id="qrcode" href="<?php echo url('demo/qrcode'); ?>">二维码生成</a></li>
                            <li><a id="bootstrap" href="<?php echo url('demo/bootstrap'); ?>">Bootstrap组件</a></li>
                            <li><a id="admin" href="<?php echo url('admin/index/index'); ?>"><span class="text text-danger">后台演示</span></a></li>
                            <li><a id="home" href="http://www.fastadmin.net?ref=demo"><span class="text text-info">返回官网</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>


        <div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="page-header" style="margin-top:10px;">
                <h4>登录</h4>
            </div>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="well">
                        <form id="loginForm" method="POST" action="#">
                            <div class="form-group">
                                <label for="account" class="control-label">账号</label>
                                <input type="text" class="form-control" id="account" name="account" value="" required="" placeholder="用户名、手机或邮箱">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">密码</label>
                                <input type="password" class="form-control" id="password" name="password" value="" required="" />
                                <span class="help-block"></span>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" id="remember"> 记住我
                                </label>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">提 交</button>
                            <a href="<?php echo url('user/register'); ?>" class="btn btn-default btn-block">注册一个新账号</a>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <p class="lead">会员权益</p>
                    <ul class="list-unstyled" style="line-height: 2">
                        <li><span class="fa fa-check text-success"></span> 最新代码推送</li>
                        <li><span class="fa fa-check text-success"></span> 发布评论</li>
                        <li><span class="fa fa-check text-success"></span> 个性化头像</li>
                        <li><span class="fa fa-check text-success"></span> 定制专属页面</li>
                        <li><span class="fa fa-check text-success"></span> 发现更多</li>
                    </ul>
                    <a href="<?php echo url('user/third?action=redirect&platform=weibo'); ?>" class="btn btn-danger btn-block"><i class="fa fa-weibo"></i> 微博登录</a>
                    <a href="<?php echo url('user/third?action=redirect&platform=wechat'); ?>" class="btn btn-success btn-block"><i class="fa fa-wechat"></i> 微信登录</a>
                    <a href="<?php echo url('user/third?action=redirect&platform=qq'); ?>" class="btn btn-info btn-block"><i class="fa fa-qq"></i> QQ登录</a>
                </div>
            </div>
        </div>
    </div>
</div>

        <script src="__CDN__/assets/js/require.js" data-main="__CDN__/assets/js/require-frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>