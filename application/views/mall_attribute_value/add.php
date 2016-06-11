<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>商品类型</small></h3>
             <?php echo breadcrumb(array('商品类型','mall_attribute_set/grid/'.$attr_set_id=>'商品类型','添加属性')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加属性</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_attribute_value/addPost') ?>" method="post" enctype ="multipart/form-data" >
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>所属商品类型</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" readonly  value="<?php echo $attr_set->attr_set_name;?>"/> 
                                <input type="hidden" name="attr_set_id" value="<?php echo $attr_set->attr_set_id;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>所属商品属性分组</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" readonly  value="<?php echo $attr_group->group_name;?>"/> 
                                <input type="hidden" name="group_id" value="<?php echo $attr_group->group_id;?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>属性名称</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="attr_name" value=""/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>属性类型</label>
                            <div class="controls">
                            	<select class="m-wrap large required" name="attr_type">
                            	     <option value="">请选择</option>
                            	     <option value="text">text:输入框</option>
                            	     <option value="textarea">textarea：文本框</option>
                            	     <option value="boolean">boolean：yes/no</option>
                            	     <option value="select"> select：下拉框</option>
                            	     <option value="multiselect">multiselect：多选select框</option>
                            	     <option value="date">date:日历框</option>
                            	</select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">可选值</label>
                            <div class="controls">
                                <textarea class="m-wrap large" name="attr_values"></textarea>
                                <span class="help-block">请用英文逗号隔开</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>添加产品时是否必填</label>
                            <div class="controls">
                            	<label class="radio">
                                	<input type="radio" class="required" name="values_required" value="1" checked="checked"/>必填
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="values_required" value="2"/>不必填
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>检索</label>
                            <div class="controls">
                                <label class="radio">
                                	<input type="radio" class="required" name="attr_index" value="1"  checked="checked"/>不需要检索
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="attr_index" value="2" />关键字检索
                            	</label>
                            </div>
                        </div>
                        <div class="control-group" style="display:none;">
                            <label class="control-label"><em>* </em>属性类别</label>
                            <div class="controls">
                            	<label class="radio">
                                	<input type="radio" class="required" name="attr_spec" value="1"  checked="checked"/>常规属性
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="attr_spec" value="2" />规格属性（与价格相关）
                            	</label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否关联相同属性值的商品</label>
                            <div class="controls">
                            	<label class="radio">
                                	<input type="radio" class="required" name="is_linked" value="1"  checked="checked"/>关联
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="is_linked" value="2" />不关联
                            	</label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="number" class="m-wrap large required" name="sort_order" value="50"/> 
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_attribute_group/grid/?attr_set_id='.$attr_set_id) ?>">
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
<script type="text/javascript">
    $(function(){
        $('select[name="attr_type"]').change(function(){
            var parent_div = $('textarea[name="attr_values"]').parents('.control-group');
            if ($(this).val()=='select' || $(this).val()=='multiselect') {
                parent_div.find('label').prepend('<em>* </em>');
                parent_div.find('textarea').addClass('required');
                $('input[name="attr_spec"]').parents('.control-group').show();
            } else {
                parent_div.find('em').remove();
                parent_div.find('textarea').removeClass('required');
                $('input[name="attr_spec"]').val('1').parents('.control-group').hide();
            }
        });
    });
</script>