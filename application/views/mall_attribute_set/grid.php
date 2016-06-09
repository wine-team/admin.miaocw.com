<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>商品类型</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_attribute_set/grid'=>'商品类型')); ?>
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
                    <form class="form-horizontal form-search" action="<?php echo base_url('mall_attribute_set/grid');?>" method="get">
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="control-group">
                                    <label class="control-label">类型名称</label>
                                    <div class="controls">
                                        <input type="text" name="attr_set_name" value="<?php echo trim($this->input->get('attr_set_name'));?>" placeholder="类型名称" class="m-wrap medium">
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
                            <a href="<?php echo base_url('mall_attribute_set/add') ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($all_rows > 0) :?>
                            <table class="table table-striped table-bordered table-hover" id="sample_1">
                                <thead class="flip-content">
                                    <tr>
                                        <th width="15"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                        <th>编号</th>
                                        <th>类型名称</th>
                                        <th>是否开启</th>
                                        <th width="130">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($page_list->result() as $item) : ?>
                                    <tr>
                                        <td><input type="checkbox" value="<?php echo $item->attr_set_id;?>" class="checkboxes"></td>
                                        <td><?php echo $item->attr_set_id;?></td>
                                        <td><?php echo $item->attr_set_name;?></td>
                                        <td><?php if($item->enabled==1) echo '是';?></td>
                                        <td>
                                            <a class="btn mini green" href="<?php echo base_url('mall_attribute_group/grid?attr_set_id='.$item->attr_set_id); ?>" >查看属性</a>
                                            <a class="btn mini green" href="<?php echo base_url('mall_attribute_set/edit/'.$item->attr_set_id); ?>">编辑</a>
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
                                        <span>每页显示<?php echo $page_num;?>条 </span>
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