<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>关联产品</small></h3>
             <?php echo breadcrumb(array('商品管理','mall_goods_related/grid'=>'关联产品','mall_goods_related/add'=>'添加关联产品')); ?>
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
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_goods_related/addPost') ?>" method="post" enctype ="multipart/form-data" >
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品ID</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="goods_id" placeholder="商品ID"/> 
                            </div>
                        </div>
                        <div class="control-group add-goods-related-html">
                            <label class="control-label"><em>* </em>关联产品</label>
                            <div class="controls">
                                <input type="text" name="related_goods_id" class="m-wrap span8 tooltips related_goods_id required" placeholder="关联产品Id" data-original-title="双击可弹框选择关联产品" data-trigger="hover"  autocomplete="off" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否双向关联</label>
                            <div class="controls">
                            	<label class="radio">
                                	<input type="radio" class="required" name="is_double" value="1"  checked="checked"/>是
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="is_double" value="2" />否
                            	</label>
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
<?php $this->load->view('mall_goods_base/addGoodBase/ajaxGetGoods');?>