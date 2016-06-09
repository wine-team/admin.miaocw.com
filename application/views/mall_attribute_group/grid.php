<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small> 属性组管理</small></h3>
            <?php echo breadcrumb(array('mall_attribute_set/grid'=>'商品类型', 'mall_attribute_group/grid?attr_set_id='.$attr_set_id=>'属性组管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid inbox">
        <div class="span2">
            <ul class="inbox-nav margin-bottom-10">
                <li class="compose-btn">
                    <a class="btn green" data-title="Compose" href="<?php echo base_url('mall_attribute_group/add/'.$attr_set_id);?>">
                        <i class="icon-plus"></i>添加属性组
                    </a>
                </li>
                <li class="inbox <?php if ($group_id == 0) :?>active<?php endif;?>">
                    <a class="btn" href="<?php echo base_url('mall_attribute_group/grid?attr_set_id='.$attr_set_id);?>">所有属性组 (<?php echo count($attributeGroup);?>)</a>
                    <b></b>
                </li>
                <?php foreach($attributeGroup as $g) :?>
                    <li <?php if ($group_id == $g->group_id):?>class="active"<?php endif;?>>
                        <a href="<?php echo base_url('mall_attribute_group/grid/'.$g->group_id.'?attr_set_id='.$attr_set_id);?>" class="btn"><?php echo $g->group_name?></a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="span10">
            <div class="inbox-header">
                <?php $i=0;$j=0;foreach ($attributeGroup as $group) :?>
                    <h3 class="pull-left">
                        <?php if ($group_id==$group->group_id) : ?>
                            <?php $i++; echo $group->group_name.'（ID：'.$group->group_id.'）' ?>
                        <?php else : ?>
                            <?php if ($j == 0) : ?>
                                <span>所有属性组</span>
                            <?php $j++;endif; ?>
                        <?php endif; ?>
                    </h3>
                    <h3 class="pull-right">
                        <?php if ($i != 0) :?>
                            <a class="btn mini green" href="<?php echo base_url('mall_attribute_group/delete/'.$group->group_id.'?attr_set_id='.$attr_set_id); ?>" onclick="return confirm('删除属性组将会删除属性组下的所有属性值，确定要删除？')">删除属性组</a>
                        <?php endif; ?>
                        <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/add/'.$group->group_id.'?attr_set_id='.$attr_set_id); ?>" >新增属性值</a>
                    </h3>
                <?php endforeach;?>
            </div>
            <div class="inbox-content">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                         <tr>
                            <th>编号</th>
                            <th>类型编号</th>
                            <th>属性名称</th>
                            <th>输入类型</th>
                            <th>可选值</th>
                            <th>是否必须</th>
                            <th>关键字检索</th>
                            <th>是否关联</th>
                            <th>属性类别</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($attributeValue as $v) :?>
                        <tr>
                            <td><?php echo $v->attr_value_id ?></td>
                            <td><?php echo $v->attr_set_id ?></td>
                            <td><?php echo $v->attr_name ?></td>
                            <td><?php echo $v->attr_type ?></td>
                            <td><?php echo $v->attr_values ?></td>
                            <td><?php echo ($v->values_required==1) ? '是' : '否';?></td>
                            <td><?php echo ($v->attr_index==2)  ? '是' : '否';?></td>
                            <td><?php echo ($v->is_linked==1) ? '是' : '否'?></td>
                            <td><?php echo ($v->attr_spec==1) ? '常规属性' : '规格属性'?></td>
                            <td><?php echo $v->sort_order?></td>
                            <td>
                                <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/edit/'.$v->attr_value_id.'?attr_set_id='.$attr_set_id); ?>">编辑</a>
                                <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/delete/'.$v->attr_value_id.'?attr_set_id='.$attr_set_id); ?>" onclick="return confirm('确定要删除属性？')">删除</a>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>