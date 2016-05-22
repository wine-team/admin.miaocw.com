<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>类别管理</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_category/grid'=>'类别管理', '添加类别')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加类别</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_category/addPost') ?>" method="post" >
                        <div class="control-group">
                            <label class="control-label">一级</label>
                            <div class="controls">
                                <select name="one_p_id" class="m-wrap large">
                                    <option value="">请选择</option>
                                    <?php foreach ($one_res as $o) :?>
                                    <option value="<?php echo $o->cat_id;?>" ><?php echo $o->cat_name;?></option>
                                    <?php endforeach;?>
                                </select>
                                <span class="help-block">如果不选择一级，则添加为一级；如果只选择一级，则添加的为二级，</span> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">二级</label>
                            <div class="controls">
                                <select name="two_p_id" class="m-wrap large">
                                    <option value="">请选择</option>
                                    <?php foreach ($two_res as $t) :?>
                                    <option value="<?php echo $t->cat_id;?>" data-p_id="<?php echo $t->parent_id;?>" style="display:none;"><?php echo $t->cat_name;?></option>
                                    <?php endforeach;?>
                                </select>
                                <span class="help-block">如果只选择二级，则添加的为三级，</span> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>分类名称</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="cat_name" maxlength=20 value=""/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否显示</label>
                            <div class="controls">
                            	<label class="radio">
                                	<input type="radio" class="m-wrap required" name="is_show" value="1" checked="checked"/> 显示
                                </label>
                                <label class="radio">
                                	<input type="radio" class="m-wrap required" name="is_show" value="2"/> 不显示
                                </label>	
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="number" class="m-wrap required" name="sort_order" maxlength=2 value="50"/>  
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">商品属性id</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large" name="filter_attr" value=""/>
                                <span class="help-block">请用英文逗号隔开</span> 
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_category/grid') ?>">
                                <button class="btn" type="button">返回</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('select[name="one_p_id"]').change(function(){
   var one_p_id = $(this).val();
   $('select[name="two_p_id"]').val('');
   $('select[name="two_p_id"]').find('option').hide();
   $('select[name="two_p_id"]').find('option').each(function(){
      if(one_p_id == $(this).data('p_id')) $(this).show();
   });
});
</script>   
<?php $this->load->view('layout/footer');?>