<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>后台登录管理系统</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <base href="<?php echo base_url()?>"/>
        <link type="image/x-icon"  rel="shortcut icon" href="skins/common/images/star/logo.png" />

        <!-- stylesheets -->
        <?php css('admin', 'bootstrap.min');?>
        <?php css('admin', 'font-awesome.min');?>
        <?php css('admin', 'style-metro');?>
        <?php css('admin', 'style');?>
        <?php css('admin', 'login');?>
        <?php css('admin', 'glyphicons');?>
        
        <!-- scripts (jquery) -->
        <?php js('common', 'jquery-1.10.2');?>
        <?php js('common', 'jquery.validate.min');?>
        <?php js('common', 'jquery.validate.messages_zh');?>
        <?php js('admin', 'bootstrap.min');?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('.login-form').validate();
                jQuery('input[name=username]').focus();
            });
        </script>
    </head>
    <body class="login">
        <div class="logo">
            <img src="skins/admin/images/mcw-logo.png" alt="小医仙网络科技有限公司">
        </div>
        <div class="content">
            <form class="form-vertical login-form" action="<?php echo site_url('account/loginPost');?>" method="post">
                <h3 class="form-title">登录</h3>
                <?php echo execute_alert_message();?>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input type="hidden" name="backurl" value="<?php echo $backurl;?>"/>
                            <input type="text" name="username" class="m-wrap placeholder-no-fix required" placeholder="您的用户名" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-lock"></i>
                            <input type="password" name="password" class="m-wrap placeholder-no-fix required" minlength="6" placeholder="您的密码"/>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green pull-right">登录<i class="m-icon-swapright m-icon-white"></i></button>
                </div>
            </form>
        </div>
        <div class="copyright">Copyright © 2016 http://www.miaocw.com 版本：1.0beta </div>
    </body>
</html>