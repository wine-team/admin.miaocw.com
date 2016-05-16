<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">员工管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', 'adminaction/grid'=>'菜单管理', '编辑菜单')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑菜单</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('adminaction/editPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>权限字段</label>
                            <div class="controls">
                                <input type="hidden" name="id" value="<?php echo $adminaction->id ?>">
                                <input type="text" name="action_code" readonly="readonly" class="m-wrap large required" value="<?php echo $adminaction->action_code ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>权限名</label>
                            <div class="controls">
                                <input type="text" name="cn_name" class="m-wrap large required" value="<?php echo $adminaction->cn_name ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>所属</label>
                            <div class="controls">
                                <select class="medium m-wrap required" name="parent_id">
                                    <option value="0">请选择...</option>
                                    <?php foreach ($belongs->result() as $belong) : ?>
                                        <option value="<?php echo $belong->id ?>" <?php if ($adminaction->id == $belong->id) :?>selected="selected"<?php endif;?>><?php echo $belong->cn_name ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('adminaction/grid') ?>">
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