<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:80:"E:\pp\php\fastadmin\public/../application/admin\view\general\database\index.html";i:1495003774;s:72:"E:\pp\php\fastadmin\public/../application/admin\view\layout\default.html";i:1495003774;s:69:"E:\pp\php\fastadmin\public/../application/admin\view\common\meta.html";i:1495003774;s:71:"E:\pp\php\fastadmin\public/../application/admin\view\common\script.html";i:1495003774;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
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
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <li><?php echo (isset($title) && ($title !== '')?$title:''); ?></li>
                                </ol>
                                <div class="shortcut pull-right">
                                    <a href="javascript:;" id="search" onclick="$('.search input').focus();"><i class="fa fa-search"></i> <span class="hidden-mobile"><?php echo __('Search'); ?></span></a>
                                    <a href="javascript:;" id="refresh" onclick="location.reload();"><i class="fa fa-refresh"></i> <span class="hidden-mobile"><?php echo __('Refresh'); ?></span></a>
                                </div>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <style type="text/css">
    #searchfloat {position:absolute;top:40px;right:20px;background:#F7F0A0;padding:10px;}
    #saved {position: relative;}
    #saved_sql {position:absolute;bottom:0;height:300px;background:#F7F0A0;width:100%;overflow:auto;display:none;}
    #saved_sql li {display:block;clear:both;width:100%;float:left;line-height:18px;padding:1px 0}
    #saved_sql li a{float:left;text-decoration: none;display:block;padding:0 5px;}
    #saved_sql li i{display:none;float:left;color:#06f;font-size: 14px;font-style: normal;margin-left:2px;line-height:18px;}
    #saved_sql li:hover{background:#fff;}
    #saved_sql li:hover i{display:block;cursor:pointer;}
    #database #tablename {height:205px;width:100%;padding:5px;}
    #database #tablename option{height:18px;}
    #database #subaction {height:210px;width:100%;}
    #database .select-striped > option:nth-of-type(odd) {background-color: #f9f9f9;}
    #database .dropdown-menu ul {margin:-3px 0;}
    #database .dropdown-menu ul li{margin:3px 0;}
    #database .dropdown-menu.row .col-xs-6{padding:0 5px;}
    #sqlquery {font-size:12px;color:#444;}
    #resultparent {padding:5px;}
</style>
<div class="panel panel-default panel-intro">
    <?php echo build_heading(); ?>

    <div class="panel-body">
        <div id="database" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">

                    <div class="row">
                        <div class="col-xs-4">
                            <h4><?php echo __('SQL Result'); ?>:</h4>
                        </div>
                        <div class="col-xs-8 text-right">
                            <form action="<?php echo url('general.database/query'); ?>" method="post" name="infoform" target="resultframe">
                                <input type="hidden" name="do_action" id="topaction" />

                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-embossed dropdown-toggle" type="button"><?php echo __('Basic query'); ?> <span class="caret"></span></button>
                                    <div class="row dropdown-menu pull-right" style="width:300px;">
                                        <div class="col-xs-6">
                                            <select class="form-control select-striped" id="tablename" name="tablename[]" multiple="multiple">
                                                <?php foreach($tables as $table): ?>
                                                <option value="<?php echo $table['name']; ?>" title=""><?php echo $table['name']; ?><!--(<?php echo $table['rows']; ?>)--></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-6">
                                            <ul id="subaction" class="list-unstyled">
                                                <li><input type="submit" name="submit1" value="<?php echo __('View structure'); ?>" rel="viewinfo" class="btn btn-primary btn-embossed btn-sm btn-block"/></li>
                                                <li><input type="submit" name="submit2" value="<?php echo __('View data'); ?>" rel="viewdata" class="btn btn-primary btn-embossed btn-sm btn-block"/></li>
                                                <li><input type="submit" name="submit3" value="<?php echo __('Optimize'); ?>" rel="optimize" class="btn btn-primary btn-embossed btn-sm btn-block" /></li>
                                                <li><input type="submit" name="submit4" value="<?php echo __('Repair'); ?>" rel="repair" class="btn btn-primary btn-embossed btn-sm btn-block"/></li>
                                                <li><input type="submit" name="submit5" value="<?php echo __('Optimize all'); ?>" rel="optimizeall" class="btn btn-primary btn-embossed btn-sm btn-block" /></li>
                                                <li><input type="submit" name="submit6" value="<?php echo __('Repair all'); ?>" rel="repairall" class="btn btn-primary btn-embossed btn-sm btn-block" /></li>
                                            </ul>
                                        </div>
                                        <div class="clear"></div>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="well" id="resultparent">
                        <iframe name="resultframe" frameborder="0" id="resultframe" style="height:100%;" width="100%" height="100%"></iframe>
                    </div>
                    <form action="<?php echo url('general.database/query'); ?>" method="post" id="sqlexecute" name="form1" target="resultframe">
                        <input type="hidden" name="do_action" value="doquery" />
                        <div class="form-group">
                            <textarea name="sqlquery" placeholder="<?php echo __('Executes one or multiple queries which are concatenated by a semicolon'); ?>" cols="60" rows="5" class="form-control" id="sqlquery"></textarea>
                        </div>

                        <input type="submit" class="btn btn-success btn-embossed" value="<?php echo __('Execute'); ?>" />
                        <input type="reset" class="btn btn-default btn-embossed" value="<?php echo __('Reset'); ?>" />
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="__CDN__/assets/js/require.js" data-main="__CDN__/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>