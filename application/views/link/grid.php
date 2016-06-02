<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">友情链接管理<small> 后台友情链接管理</small></h3>
            <?php echo breadcrumb(array('网站设置', 'link/grid'=>'友情链接管理')); ?>
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
                            <a href="<?php echo base_url('link/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="30"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th width="40">编号</th>
                                        <th>角色名称</th>
                                        <th>排序</th>
                                        <td>菜单</td>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->id;?></td>
                                        <td><?php echo $item->name;?></td>
                                        <td><?php echo $item->sort;?></td>
                                        <td><?php echo $item->url;?></td>
                                        <td>
                                            <a class="btn mini green" href="<?php echo base_url('link/edit/'.$item->id) ?>"><i class="icon-edit"></i> 编辑</a>
                                            <a class="btn mini green" href="<?php echo base_url('link/delete/'.$item->id) ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
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