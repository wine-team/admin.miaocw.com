<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'advert/grid'=>'广告管理', '添加广告')); ?>
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
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_attribute/addPost') ?>" method="post" enctype ="multipart/form-data" >
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>属性名称</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="attr_name" value=""/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品类型ID</label>
                            <div class="controls">
                                <input type="number" class="m-wrap large required" name="type_id" /> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>属性类型</label>
                            <div class="controls">
                                <input type="radio" class="required" name="attr_type" value="1"  />唯一属性
                                <input type="radio" class="required" name="attr_type" value="2" /> 单选属性
                                <input type="radio" class="required" name="attr_type" value="2" /> 复选属性
                                <span class="help-block">1唯一属性 2单选属性 3复选属性 （选择"单选/复选属性"时，可以对商品该属性设置多个值，同时还能对不同属性值指定不同的价格加价，用户购买商品时需要选定具体的属性值。选择"唯一属性"时，商品的该属性值只能设置一个值，用户只能查看该值。）</span>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>可选值</label>
                            <div class="controls">
                                <textarea class="m-wrap large required" name="attr_values"></textarea>
                                <span class="help-block">请用英文逗号隔开</span>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>检索</label>
                            <div class="controls">
                                <input type="radio" class="required" name="attr_index" value="1"  />不需要检索
                                <input type="radio" class="required" name="attr_index" value="2" />关键字检索
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否关联相同属性值的商品</label>
                            <div class="controls">
                                <input type="radio" class="required" name="is_linked" value="1"  />关联
                                <input type="radio" class="required" name="is_linked" value="2" />不关联
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
                            <a href="<?php echo base_url('mall_brand/grid') ?>">
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