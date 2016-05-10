<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置 <small>所有网站设置</small></h3>
            <?php echo breadcrumb(array('网站设置', 'advert/grid'=>'广告管理', '编辑广告')); ?>
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
                    <form class="form-horizontal line-form" action="<?php echo base_url('Chelp_center/editPost') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $res->id;?>" >
                        <div class="control-group">
                            <label class="control-label"><em>* </em>类型</label>
                            <div class="controls">
                                <select name="title" class="m-wrap large required">
                                    <option value="">请选择</option>
                                    <option value="新手上路" <?php if($res->title=='新手上路') echo 'selected="selected"';?>>新手上路</option>
                                    <option value="支付方式" <?php if($res->title=='支付方式') echo 'selected="selected"';?>>支付方式</option>
                                    <option value="订购方式" <?php if($res->title=='订购方式') echo 'selected="selected"';?>>订购方式</option>
                                    <option value="配送与售后" <?php if($res->title=='配送与售后') echo 'selected="selected"';?>>配送与售后</option>
                                    <option value="帮助中心" <?php if($res->title=='帮助中心') echo 'selected="selected"';?>>帮助中心</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>标题</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="sub_title" value="<?php echo $res->sub_title; ?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">作者</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large" name="author" value="<?php echo $res->author; ?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>内容</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit required" name="help_info"><?php echo $res->help_info; ?></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('Chelp_center/grid') ?>">
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