<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理<small>商品类型</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_attribute_set/grid/'.$attr_set_id=>'商品类型', '编辑类型')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑类型</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form ">
                    <div class="row-fluid">
                        <div class="span4">
                            <form class="form-horizontal line-form" action="<?php echo base_url('mall_attribute_set/editPost') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="attr_set_id" value="<?php echo $res->attr_set_id;?>" >
                                <div class="control-group">
                                    <label class="control-label"><em>* </em>商品类型名称</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap large required" name="attr_set_name" value="<?php echo $res->attr_set_name;?>"/> 
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"><em>* </em>是否开启</label>
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" class="required" name="enabled" value="1" <?php if($res->enabled==1) echo 'checked="checked"';?> />开启
                                        </label>
                                        <label class="radio">
                                            <input type="radio" class="required" name="enabled" value="2" <?php if($res->enabled==2) echo 'checked="checked"';?> />关闭
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                                    <a href="<?php echo base_url('mall_attribute_set/grid/'.$attr_set_id) ?>">
                                        <button class="btn" type="button">返回</button>
                                    </a>
                                </div>
                            </form>
                        </div>
                        <div class="span8" style="border-left:1px solid #e5e5e5;">
                            <div class="control-group">
                                <div class="clearfix">
                                    <a href="<?php echo base_url('mall_attribute_set/addGroup/'.$attr_set_id) ?>" class="add-button-link">
                                        <div class="btn-group">
                                            <button class="btn green"><i class="icon-plus"></i>添加属性组</button>
                                        </div>
                                    </a>
                                </div>
                                <label class="control-label">商品类型属性组</label>
                                <table class="table table-striped table-bordered table-hover" id="sample_1">
                                    <thead class="flip-content">
                                        <tr>
                                            <th>组名</th>
                                            <th>属性名</th>
                                            <th>属性值</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($group as $g){?>
                                    <tr>
                                        <td><?php echo $g->group_name;?></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a class="btn mini green" href="<?php echo base_url('mall_attribute_set/deleteGroup/'.$g->group_id.'?attr_set_id='.$attr_set_id); ?>" onclick="return confirm('确定要删除属性组？')"><i class="icon-trash"></i>删除</a> 
                                            <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/add/'.$g->group_id.'?attr_set_id='.$attr_set_id); ?>"><i class="icon-plus"></i>新增属性</a>
                                        </td>
                                    </tr>
                                        <?php foreach($arribute as $a){if($a->group_id == $g->group_id){?>
                                        <tr>
                                            <td></td>
                                            <td><?php echo $a->attr_name;?></td>
                                            <td><?php echo $a->attr_values;?></td>
                                            <td>
                                                <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/delete/'.$a->attr_value_id.'?attr_set_id='.$attr_set_id); ?>" onclick="return confirm('确定要删除属性？')"><i class="icon-trash"></i>删除</a> 
                                                <a class="btn mini green" href="<?php echo base_url('mall_attribute_value/edit/'.$a->attr_value_id.'?attr_set_id='.$attr_set_id); ?>"><i class="icon-edit"></i>编辑属性</a>
                                            </td>
                                        </tr>
                                        <?php }}?>
                                    <?php }?>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>