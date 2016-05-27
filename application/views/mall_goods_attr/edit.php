<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>商品属性</small></h3>
            <?php echo breadcrumb(array('商品管理 ', 'supplier/grid'=>'商品属性', '编辑属性')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑属性</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form supplier-form" action="<?php echo base_url('mall_goods_attr/editPost') ?>" method="post" enctype ="multipart/form-data" >
                        <input type="hidden" name="goods_id" value="<?php echo $res->goods_id;?>">
                        <input type="hidden" name="goods_attr_id" value="<?php echo $res->goods_attr_id;?>">
                        <div class="control-group add-supplieruid-html">
                            <label class="control-label"><em>* </em>属性id</label>
                            <div class="controls">
                                <input type="text" name="attr_id" value="<?php echo $res->attr_id;?>" class="m-wrap medium supplieruid tooltips number" data-original-title="双击可弹框选择属性；直接输入‘用户属性或编号’可提示" data-trigger="hover">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>属性值</label>
                            <div class="controls">
                                <select name="attr_value" class="large required">
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>价格</label>
                            <div class="controls">
                                <input type="number" name="attr_price" value="<?php echo $res->attr_price;?>" class="large required"/>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_goods_attr/grid/'.$res->goods_id) ?>">
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
<?php $this->load->view('mall_goods_attr/addGoodsAttr/ajaxGetAttr');?>
<script type="text/javascript" >
$('form.supplier-form').validate({
    rules: {
    	attr_price: {
            required: true,
            number:true,
            min:0.01
        },
    },
    messages: {
    	min: {
    		required:'请输入价格',
    		min: '不能小于0.01'
        },
    },
});
</script>