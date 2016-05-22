<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'advert/grid'=>'广告管理', '编辑广告')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加广告</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_category/editPost') ?>" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="cat_id" value="<?php echo $res->cat_id;?>" >
                        <div class="control-group">
                            <label class="control-label"><em>* </em>分类名称</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="cat_name" maxlength=20 value="<?php echo $res->cat_name;?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否显示</label>
                            <div class="controls">
                                <label class="radio">
                                	<input type="radio" class=" required" name="is_show" value="1" <?php if($res->is_show==1) echo 'checked="checked"';?>/> 显示
                                </label>
                                <label class="radio">
                                	<input type="radio" class=" required" name="is_show" value="2" <?php if($res->is_show==2) echo 'checked="checked"';?>/> 不显示
                                </label>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="number" class="m-wrap required" name="sort_order" maxlength=2 value="<?php echo $res->sort_order;?>"/>  
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">商品属性id</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large" name="filter_attr" value="<?php echo $res->filter_attr;?>"/>
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
<?php $this->load->view('layout/footer');?>