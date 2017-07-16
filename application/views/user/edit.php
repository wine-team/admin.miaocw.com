<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">用户管理<small> 编辑用户</small></h3>
            <?php echo breadcrumb(array('用户管理', 'user/grid'=>'用户列表', '编辑用户')); ?>
        </div>
    </div>
    <div class="alert alert-error" style="display: none;">
        <button data-dismiss="alert" class="close"></button>
        <a href="javascript:;" class="glyphicons no-js remove_2"><i></i><p></p></a>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑用户</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal user-form" action="<?php echo base_url('user/editPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>账户类型</label>
                            <div class="controls">
                                <input type="hidden" name='uid' value="<?php echo $row->uid;?>">
                                <?php foreach ($user_type->result() as $type) :?>
                                    <label class="checkbox">
                                        <input type="checkbox" name="userType[]" value="<?php echo $type->type_id;?>" <?php if (intval($row->user_type)&$type->type_id) : ?> checked="checked"<?php endif;?>> <?php echo $type->type_name;?>
                                    </label>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">用户昵称</label>
                            <div class="controls">
                                <input type="text" name="alias_name" class="m-wrap large" value="<?php echo $row->alias_name;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>手机号码</label>
                            <div class="controls">
                                <input type="text" name="phone" value="<?php echo $row->phone;?>" maxlength="11" class="m-wrap large number required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">邮箱地址</label>
                            <div class="controls">
                                <input type="text" name="email" value="<?php echo $row->email;?>" class="m-wrap large chkemail">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">可用资金</label>
                            <div class="controls">
                                <input type="text" name="user_money" value="<?php echo $row->user_money;?>" class="m-wrap large">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">冻结资金</label>
                            <div class="controls">
                                <input type="text" name="frozen_money" value="<?php echo $row->frozen_money;?>" class="m-wrap large">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">消费积分</label>
                            <div class="controls">
                                <input type="text" name="pay_points" value="<?php echo $row->pay_points;?>" class="m-wrap large">
                            </div>
                        </div>
                        <div class="control-group add-pop-up-html">
                            <label class="control-label"><em>* </em>父级序号</label>
                            <div class="controls">
                                 <input type="text" name="parent_id" value="<?php echo $row->parent_id;?>" class="m-wrap medium useruid tooltips number" data-original-title="双击可弹框选择用户" data-trigger="hover">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">用户密码</label>
                            <div class="controls">
                                <input type="text" name="pw" class="m-wrap large">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">性别</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="sex" value="0" <?php if ($row->sex == 0) : ?> checked="checked"<?php endif;?>> 保密
                                </label>
                                <label class="radio">
                                    <input type="radio" name="sex" value="1" <?php if ($row->sex == 1) : ?> checked="checked"<?php endif;?>> 男
                                </label>
                                <label class="radio">
                                    <input type="radio" name="sex" value="2" <?php if ($row->sex == 2) : ?> checked="checked"<?php endif;?>> 女
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">出生日期</label>
                            <div class="controls">
                                <div class="input-append date date-picker" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                    <input type="text" name="birthday" value="<?php echo ($row->birthday != '0000-00-00') ? $row->birthday : '';?>" class="m-wrap medium date-picker" placeholder="出生日期">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">是否发送短信</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="sms" value="1" <?php if ($row->sms == 1) : ?> checked="checked"<?php endif;?>> 是
                                </label>
                                <label class="radio">
                                    <input type="radio" name="sms" value="2" <?php if ($row->sms == 2) : ?> checked="checked"<?php endif;?>> 否
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">帐号状态</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="flag" value="1" <?php if ($row->flag == 1) : ?> checked="checked"<?php endif;?>> 正常
                                </label>
                                <label class="radio">
                                    <input type="radio" name="flag" value="2" <?php if ($row->flag == 2) : ?> checked="checked"<?php endif;?>> 冻结
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('user/grid') ?>">
                                <button class="btn" type="button">返回</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<?php $this->load->view('user/ajaxUser/ajaxGet');?>
<script type="text/javascript" >
$('form.user-form').submit(function(){
    return false;
}).validate({
    rules: {
        phone: {
            required: true,
            remote: {
                url:hostUrl()+'/user/validatePhone',
                type: 'post',
                dataType: 'json',
                data: {
                    phone:function(json) {
                        return $('input[name=phone]').val();
                    },
                    uid:function(json) {
                        return $('input[name=uid]').val();
                    }
                }
            }
        },
        email: {
            email: true,
            remote: {
                url:hostUrl()+'/user/validateEmail',
                type: 'post',
                dataType: 'json',
                data: {
                    email:function(json) {
                        return $('input[name=email]').val();
                    },
                    uid:function(json) {
                        return $('input[name=uid]').val();
                    }
                }
            }
        }
    },
    messages: {
        phone: {
            required: '请输入您的手机号码',
            mobile: '手机格式错误',
            remote: '修改的手机号已注册'
        },
        email: {
            email : '请输入正确的邮箱',
            remote: '修改的邮箱已存在'
        }
    },
    submitHandler: function(f) {
        $.ajax({
            type: 'post',
            async: true,
            dataType : 'json',
            url: hostUrl() + '/user/editPost',
            data: $('form.user-form').serialize(),
            success: function(data) {
                if (data.status) {
                    $('.alert-error').hide();
                    window.location.href = data.messages;
                } else {
                    $('.alert-error').show();
                    $('.remove_2 p').html(data.messages);
                    var body = (window.opera) ? (document.compatMode == 'CSS1Compat' ? $('html') : $('body')) : $('html,body');
                    body.animate({scrollTop: $('.page-container').offset().top}, 1000);
                }
            }
        });
    }
});
</script>
