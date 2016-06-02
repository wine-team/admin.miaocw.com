<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">菜单管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', '菜单管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <?php if (isset($parent_id) && $parent_id == 0) :?>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-search"></i>搜索</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal form-search" action="<?php echo base_url('adminaction/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">名称</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap medium" placeholder="搜索权限字段、权限名" name="actionname" value="<?php echo $this->input->get('actionname')?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit">搜索</button>
                            <button class="btn reset_button_search" type="button">重置条件</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php endif;?>
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>列表</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <div class="dataTables_wrapper form-inline">
                        <?php if (isset($parent_id) && $parent_id == 0) :?>
                            <div class="clearfix">
                                <a href="<?php echo base_url('adminaction/add') ?>" class="add-button-link">
                                    <div class="btn-group">
                                        <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                    </div>
                                </a>
                            </div>
                        <?php endif;?>
                        <?php if ($all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="25"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>编号</th>
                                        <th>权限字段</th>
                                        <th>权限名</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td width="25"><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td width="50"><?php echo $item->id;?></td>
                                        <td><?php echo $item->action_code;?></td>
                                        <td><?php echo $item->cn_name;?></td>
                                        <td width="145">
                                            <a class="btn mini green" href="<?php echo base_url('adminaction/edit/'.$item->id) ?>"><i class="icon-edit"></i> 编辑</a>
                                            <a class="btn mini green" href="<?php echo base_url('adminaction/delete/'.$item->id) ?>" onclick="return confirm('将会删除所有下属数据，将无法恢复，确定要删除？')"><i class="icon-trash"></i> 删除</a><p></p>
                                            <?php if (isset($parent_id) && $parent_id == 0) :?>
                                            <a class="btn mini green" href="<?php echo base_url('adminaction/child').'?parent_id='.$item->id ?>"> 查看下级</a>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <?php $this->load->view('layout/pagination');?>
                        <?php else: ?>
                            <div class="alert"><p>未找到数据。<p></div>
                        <?php endif ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>