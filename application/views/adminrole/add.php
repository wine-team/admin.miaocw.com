<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">员工管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', 'adminrole/grid'=>'角色管理', '添加角色')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加角色</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="dataTables_wrapper form-inline">
                        <form class="line-form" action="<?php echo base_url('adminrole/addPost') ?>" method="post" enctype="multipart/form-data">
                            <div class="form-horizontal control-group">
                                <label class="control-label" style="width:auto;"><em>* </em>角色名称</label>
                                <div class="controls" style="margin-left: 75px;">
                                    <input type="text" name="name" class="m-wrap large required"/>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <tr>
                                    <th width="150">
                                        <div class="controls">
                                            <label class="checkbox">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"> <strong>全选</strong>
                                            </label>
                                        </div>
                                    </th>
                                    <th></th>
                                </tr>
                                <?php foreach ($priv_arr as $k => $priv) : ?>
                                <tr>
                                    <td width="150">
                                        <div class="controls">
                                            <label class="checkbox">
                                                <input type="checkbox" name="action_code[]" value="<?php echo $priv['action_code'];?>" class="checkboxes"> <strong><?php echo $priv['cn_name']; ?></strong>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="controls">
                                            <label class="checkbox">
                                                <input type="checkbox" data-set="#sample_1 .checkboxes<?php echo $k;?>" class="checkboxes group-checkable2">
                                                <span class="alert-info">全选</span>
                                            </label>
                                            <?php if (!isset($priv['priv'])) continue;?>
                                            <?php foreach($priv['priv'] as $key => $value): ?>
                                                <label class="checkbox">
                                                    <input type="checkbox" name="action_code[]" value="<?php echo $key ?>" class="checkboxes checkboxes<?php echo $k;?>" />
                                                    <span style="font-size: 12px;"><?php echo $value['cn_name']; ?></span>
                                                </label>
                                            <?php endforeach;?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </table>
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