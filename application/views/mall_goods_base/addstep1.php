<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">妙网商城<small> 商品添加</small></h3>
            <?php echo breadcrumb(array('mall_goods_base/grid' => '妙网商城', "mall_goods_base/addstep1" => '商品添加')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加商品-Step1</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_goods_base/addstep2') ?>" method="get" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品类别</label>
                            <div class="controls">
                                <select name="extension_code" class="medium m-wrap required">
                                    <?php foreach ($extension as $key=>$value) : ?>
                                        <option value="<?php echo $key;?>"><?php echo $value; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品属性</label>
                            <div class="controls">
                                <select name="attr_set_id" class="medium m-wrap chosen required" data-placeholder="请选择商品属性">
                                    <option value=""></option>
                                    <?php foreach ($attributeSet->result() as $key=>$value) : ?>
                                        <option value="<?php echo $value->attr_set_id;?>"><?php echo $value->attr_set_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品来源</label>
                            <div class="controls">
                                <select name="from_id" class="medium m-wrap chosen required" data-placeholder="请选择商品属性">
                                    <option value="0">妙处网自采</option>
                                    <?php foreach ($mallGoodsFrom->result() as $key => $val) : ?>
                                        <option value="<?php echo $val->from_id?>"><?php echo $val->from_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit">下一步 <i class="m-icon-swapright m-icon-white"></i></button>
                            <a class="btn" href="<?php echo base_url('mall_goods_base/grid');?>">返回列表</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer'); ?>