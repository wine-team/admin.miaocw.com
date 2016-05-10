<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">角色管理<small> 后台权限菜单管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', '角色管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
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
                        <div class="clearfix">
                            <a href="<?php echo base_url('adminrole/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th width="25"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th width="30">编号</th>
                                    <th>角色名称</th>
                                    <th width="600">权限方法</th>
                                    <td>菜单</td>
                                    <th>创建时间</th>
                                    <th>修改时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($page_list->result() as $item) : ?>
                                <tr>
                                    <td width="25"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td width="30"><?php echo $item->id;?></td>
                                    <td><?php echo $item->name;?></td>
                                    <td style="word-break:break-all;word-wrap:break-word;width:600px;"><?php echo $item->action_list;?></td>
                                    <td><?php echo $item->menu_id;?></td>
                                    <td><?php echo $item->created_at ?></td>
                                    <td><?php echo $item->updated_at;?></td>
                                    <td>
                                        <a class="btn mini green" href="<?php echo base_url('adminrole/leftmenu/'.$item->id) ?>"> 查看权限菜单</a>
                                        <a class="btn mini green" href="<?php echo base_url('adminrole/edit/'.$item->id) ?>"><i class="icon-edit"></i> 编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('adminrole/delete/'.$item->id) ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_info">
                                    <span>当前第</span><span style="color: red"><?php echo $pg_now?></span>页 
                                    <span>共</span><span style="color: red"><?php echo $all_rows?></span>条数据
                                    <span>每页显示20条 </span>
                                    <?php echo $pg_link ?>
                                </div>
                            </div>
                        </div>
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