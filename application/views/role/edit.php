<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">员工管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', 'role/grid'=>'角色管理', '编辑角色')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑角色</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="dataTables_wrapper form-inline">
                        <form class="line-form" action="<?php echo base_url('role/editPost') ?>" method="post" enctype="multipart/form-data">
                            <input name="id" type="hidden" value="<?php echo $editing['id']?>" />
                            <div class="form-horizontal control-group">
                                <label class="control-label" style="width:auto;"><em>* </em>角色名称</label>
                                <div class="controls" style="margin-left: 75px;">
                                    <input type="text" name="name" value="<?php echo $editing['name']?>" class="m-wrap large required"/>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                                <a href="<?php echo base_url('role/grid') ?>">
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