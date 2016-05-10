
<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">员工管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', 'adminrole/grid'=>'角色管理', '权限菜单')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>角色名称 - <?php echo $role->name;?></div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="dataTables_wrapper form-inline">
                        <form id="sample_1" class="line-form" action="<?php echo base_url('adminrole/leftmenuPost') ?>" method="post" enctype="multipart/form-data">
                            <div class="controls">
                                <label class="checkbox">
                                    <input type="hidden" name="role_id" value="<?php echo $role->id;?>">
                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"> <strong>全选</strong>
                                </label>
                            </div>
                            <div class="controls">
                                <?php foreach(adminleftmenu() as $key => $value): ?>
                                    <label class="checkbox">
                                        <input type="checkbox" name="action_menu[]" value="<?php echo $key ?>" <?php if ($role->menu_id&$key):?>checked="checked"<?php endif;?> class="checkboxes" />
                                        <span style="font-size: 12px;"><?php echo $value; ?></span>
                                    </label>
                                <?php endforeach;?>
                            </div>
                            <div class="form-actions">
                                <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                                <a href="<?php echo base_url('adminrole/grid') ?>">
                                    <button class="btn" type="button">返回</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>