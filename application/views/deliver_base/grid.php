<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">快递管理<small> 快递公司</small></h3>
            <?php echo breadcrumb(array('快递管理', '快递公司')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-search"></i>搜索</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal form-search" action="<?php echo base_url('deliver_base/grid') ?>" method="get">
                        <div class="row-fluid">
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">快递名称</label>
                                    <div class="controls">
                                        <input type="text" name="deliver_name" value="<?php echo $this->input->get('deliver_name')?>" class="m-wrap medium" placeholder="搜索快递名称">
                                    </div>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="control-group">
                                    <label class="control-label">公司编码</label>
                                    <div class="controls">
                                        <input type="text" name="deliver_flag" value="<?php echo $this->input->get('deliver_flag')?>" class="m-wrap medium" placeholder="搜索公司编码">
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
                            <a href="<?php echo base_url('deliver_base/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>编号</th>
                                        <th>快递名称</th>
                                        <th>公司编码</th>
                                        <th>添加时间</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="checkboxes" value="1" ></td>
                                        <td><?php echo $item->deliver_id;?></td>
                                        <td><?php echo $item->deliver_name;?></td>
                                        <td><?php echo $item->deliver_flag;?></td>
                                        <td><?php echo $item->created_at;?></td>
                                        <td width="145">
                                            <a href="<?php echo base_url('deliver_base/edit/'.$item->deliver_id) ?>" class="btn mini green"><i class="icon-edit"></i> 编辑</a>
                                            <a href="<?php echo base_url('deliver_base/delete/'.$item->deliver_id) ?>" class="btn mini green" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a><p></p>
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