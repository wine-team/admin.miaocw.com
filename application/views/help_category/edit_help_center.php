<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'help_category/grid'=>'帮助中心','添加栏目')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加帮助</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('help_category/editHelpPost') ?>" method="post" >
                        <input type="hidden" name="category_id" value="<?php echo $help->help_category_id;?>" />
                        <input type="hidden" name="id" value="<?php echo $help->id;?>" />
                        <div class="control-group">
                            <label class="control-label"><em>* </em>标题</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="sub_title" value="<?php echo  $help->sub_title;?>" placeholder="标题"/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>作者</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="author" value="<?php echo  $help->author;?>" placeholder="作者"/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="sort" value="<?php echo  $help->sort;?>" placeholder="越大越前"/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>上下架</label>
                            <div class="controls">
                                <select name="flag" class="medium m-wrap valid">
                                       <option value="1" <?php if($help->flag==1):?>selected="selected"<?php endif;?>>上架</option>
                                       <option value="2" <?php if($help->flag==2):?>selected="selected"<?php endif;?>>下架</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">说明</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit required" name="help_info"><?php echo  $help->help_info;?></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('help_category/help_center?category_id='.$help->help_category_id) ?>">
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