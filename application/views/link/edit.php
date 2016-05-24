<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">友情链接管理<small> 后台友情链接管理</small></h3>
            <?php echo breadcrumb(array('权限菜单管理', 'link/grid'=>'友情链接管理', '编辑友情链接')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加友情链接</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('link/editPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>名称</label>
                            <div class="controls">
                                <input type="hidden" name="id" value="<?php echo $link->id ?>">
                                <input type="text" name="name" value="<?php echo $link->name ?>" class="m-wrap large required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>url地址</label>
                            <div class="controls">
                                <input type="text" name="url" value="<?php echo $link->url ?>" class="m-wrap large url required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="text" name="sort" value="<?php echo $link->sort;?>" class="m-wrap large">
                                <span class="help-inline">越大越前</span>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('link/grid') ?>">
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