<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">员工管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', 'adminuser/grid'=>'员工管理', '添加员工')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加员工</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('adminuser/addPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>用户名</label>
                            <div class="controls">
                                <input type="text" name="name" class="m-wrap large required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">真实姓名</label>
                            <div class="controls">
                                <input type="text" name="realname" class="m-wrap large">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>邮箱地址</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required email" name="email" /> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>密码</label>
                            <div class="controls">
                                <input type="password" id="password" class="m-wrap large required" name="password" minlength="6" /> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>确认密码</label>
                            <div class="controls">
                                <input type="password" class="m-wrap large required" name="confirm_password" minlength="6" equalTo="#password" /> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>角色</label>
                            <div class="controls">
                                <select class="medium m-wrap required" name="role_id">
                                    <option value="">请选择...</option>
                                    <?php foreach ($roles->result() as $role) : ?>
                                        <option value="<?php echo $role->id ?>"><?php echo $role->name ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('adminuser/grid') ?>">
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