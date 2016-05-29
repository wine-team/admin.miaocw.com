<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>属性管理</small></h3>
            <?php echo breadcrumb(array('mall_attribute_set/grid'=>'商品类型','mall_attribute_value/grid/'.$attr_set_id => '属性管理')); ?>
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
                            <a href="<?php echo base_url('mall_attribute_value/add/'.$attr_set_id) ?>" class="add-button-link">
                                <div class="btn-group">
                                    <button class="btn green"><i class="icon-plus"></i> 添加</button>
                                </div>
                            </a>
                        </div>
                        <?php if ($res->num_rows() > 0) :?>
                        <table class="table table-striped table-bordered table-hover" id="sample_1">
                            <thead class="flip-content">
                                <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></th>
                                    <th>编号</th>
                                    <th>商品类型ID</th>
                                    <th>商品属性组编号</th>
                                    <th>商品属性名称</th>
                                    <th>属性类型</th>
                                    <th>可选值</th>
                                    <th>检索</th>
                                    <th>关联</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($res->result() as $r) : ?>
                                <tr>
                                    <td width="15"><input type="checkbox" class="checkboxes" value="1" ></td>
                                    <td><?php echo $r->attr_value_id;?></td>
                                    <td><?php echo $r->attr_set_id;?></td>
                                    <td><?php echo $r->group_id;?></td>
                                    <td><?php echo $r->attr_name;?></td>
                                    <td><?php switch ($r->attr_type){
                                        case 1 : echo '唯一属性';break;
                                        case 2 : echo '单选属性';break;
                                        case 3 : echo '复选属性';break;
                                    }?></td>
                                    <td><?php echo $r->attr_values;?></td>
                                    <td><?php echo ($r->attr_index == 2) ?  '关键字检索' : '不需要检索'; ?></td>
                                    <td><?php echo $r->is_linked;?></td>
                                    <td><?php echo $r->sort_order;?></td>
                                    <td width="145">
                                        <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/edit/'.$r->attr_value_id.'?attr_set_id='.$attr_set_id); ?>"><i class="icon-edit"></i> 编辑</a>
                                        <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/delete/'.$r->attr_value_id.'?attr_set_id='.$attr_set_id); ?>" onclick="return confirm('确定要删除？')"><i class="icon-trash"></i> 删除</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
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