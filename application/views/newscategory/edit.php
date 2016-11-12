<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">新闻管理 <small>新闻管理 </small></h3>
            <?php echo breadcrumb(array('新闻管理', 'newsclass/grid'=>'新闻分类', '编辑妙处网公告分类')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑贝竹公告分类</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('newscategory/editPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>贝竹公告分类</label>
                            <div class="controls">
                                <input type="hidden" name="class_id" value="<?php echo $newsclass->class_id;?>">
                                <input type="text" name="class_name" value="<?php echo $newsclass->class_name;?>" class="m-wrap large required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>分类是否上架</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" <?php if ($newsclass->status == 1):?>checked="checked"<?php endif;?> name="status" value="1">是
                                </label>
                                <label class="radio">
                                    <input type="radio" <?php if ($newsclass->status == 0):?>checked="checked"<?php endif;?> name="status" value="0">否
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="text" name="sort" class="m-wrap large required" value="<?php echo $newsclass->sort;?>">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('news_class/grid') ?>">
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