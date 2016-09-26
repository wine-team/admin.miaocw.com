<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>商品来源</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_goods_from/grid'=>'商品来源', '编辑商品来源')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑商品来源</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_goods_from/editPost') ?>" method="post" enctype ="multipart/form-data" >
                        <div class="control-group">
                            <label class="control-label"><em>* </em>来源</label>
                            <div class="controls">
                                <input type="hidden" name="from_id" value="<?php echo $res->from_id;?>" />
                                <input type="text" name="from_name" class="m-wrap large required" value="<?php echo $res->from_name;?>"/>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_goods_from/grid') ?>">
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