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
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_address/editPost') ?>" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="uid" value="<?php echo $res->uid;?>">
                        <input type="hidden" name="address_id" value="<?php echo $res->address_id;?>">
                        
                        <div class="control-group">
                            <label class="control-label"><em>*</em>地区</label>
                            <div class="controls">
                                <?php $this->load->view('commonhtml/districtSelect2');?>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>详细地址</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="detailed" maxlength=100 value="<?php echo $res->detailed;?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>邮编</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required zipCode" name="code" maxlength=6 value="<?php echo $res->code;?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>收货人姓名</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="receiver_name" maxlength=20 value="<?php echo $res->receiver_name;?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>电话</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required mobile" name="tel" maxlength=11 value="<?php echo $res->tel;?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>设为默认</label>
                            <div class="controls">
                                <input type="radio" class="required" name="is_default" value="1" <?php if($res->is_default==1) echo 'checked="checked"';?>/>否
                                <input type="radio" class="required" name="is_default" value="2" <?php if($res->is_default==2) echo 'checked="checked"';?>/>是
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