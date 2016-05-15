<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'advert/grid'=>'广告管理', '添加广告')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加广告</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('help_center/addPost') ?>" method="post" >
                        <div class="control-group">
                            <label class="control-label">类型</label>
                            <div class="controls">
                                <select name="title" class="m-wrap large">
                                    <option value="">请选择</option>
                                    <option value="新手上路" >新手上路</option>
                                    <option value="支付方式" >支付方式</option>
                                    <option value="订购方式" >订购方式</option>
                                    <option value="配送与售后" >配送与售后</option>
                                    <option value="帮助中心" >帮助中心</option>
                                    <option value="趣网品质" >趣网品质</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>标题</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="sub_title" value=""/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">作者</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large" name="author" value="妙网"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>内容</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit required" name="help_info"></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('help_center/grid') ?>">
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