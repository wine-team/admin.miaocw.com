 <?php $this->load->view('layout/header');?>
 <div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置<small>区块广告设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'cmsblock/grid'=>'区块广告设置', 'cmsblock/add'=>'添加广告')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>区块广告设置添加</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('cmsblock/addPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>名称</label>
                            <div class="controls">
                                <input type="text" name="name" class="m-wrap large required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>区块id</label>
                            <div class="controls">
                                <input type="text" name="block_id" class="m-wrap large required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>描述</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit required" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('cmsblock/grid') ?>">
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