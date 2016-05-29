<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">旅游产品<small> 商品添加</small></h3>
            <?php echo breadcrumb(array('tourismgoods/grid' => '旅游产品', "tourismgoods/add" => '商品添加')); ?>
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
                    <form class="form-horizontal line-form tourism-goods-add-step1" action="<?php echo base_url('tourismgoods/addstep2') ?>" method="get" enctype="multipart/form-data">
                        <div class="alert alert-success">商品类别</div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品类别</label>
                            <div class="controls">
                                <?php $this->load->view('commonhtml/categorySelect');?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit">下一步 <i class="m-icon-swapright m-icon-white"></i></button>
                            <a class="btn" href="<?php echo base_url('tourismgoods/grid');?>">返回列表</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer'); ?>