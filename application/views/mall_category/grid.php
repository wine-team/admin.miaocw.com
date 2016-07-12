<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理<small> 类别管理</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_category/grid'=>'类别管理'));?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span2">
            <?php $this->load->view('mall_category/leftCategory');?>
        </div>
        <div class="span10 add-edit-category">
            <?php $this->load->view('mall_category/rightCategory');?>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
