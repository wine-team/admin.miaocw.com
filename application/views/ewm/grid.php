<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">网站设置<small>二维码生成</small></h3>
            <?php echo breadcrumb(array('网站设置', '二维码生成')); ?>
        </div>
    </div>
    <?php echo execute_alert_message();?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>生成二维码</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('ewm/grid') ?>" method="get" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>链接地址</label>
                            <div class="controls">
                                <input type="text" name="url" class="m-wrap span6 required" value="<?php echo $url;?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否显示LoGo</label>
                            <div class="controls">
                                <label class="radio">
                                    <div class="radio">
                                       <span><input type="radio" value="0" name="state" <?php if($this->input->get('state')==0):?>checked="checked"<?php endif;?>></span>
                                    </div>
                                                                                           是
                                </label>
                                <label class="radio">
                                    <div class="radio">
                                       <span><input type="radio" value="1" name="state" <?php if($this->input->get('state')==1):?>checked="checked"<?php endif;?>></span>
                                    </div>
                                                                                          否
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>容错级别</label>
                            <div class="controls">
                                <select name="errorCorrectionLevel" class="medium m-wrap">
                                    <option value="L"  <?php if($errorCorrectionLevel=='L'):?>selected="selected"<?php endif;?> >L - smallest</option>
                                    <option value="M"  <?php if($errorCorrectionLevel=='M'):?>selected="selected"<?php endif;?>>M</option>
                                    <option value="Q"  <?php if($errorCorrectionLevel=='Q'):?>selected="selected"<?php endif;?>>Q</option>
                                    <option value="H"  <?php if($errorCorrectionLevel=='H'):?>selected="selected"<?php endif;?>>H - best</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>容错级别</label>
                            <div class="controls">
                                <select name="matrixPointSize" class="medium m-wrap">
                                    <?php for ($i = 1; $i <= 10; $i++):?>
		                                <option value="<?php echo $i;?>" <?php if($matrixPointSize == $i):?>selected="selected"<?php endif;?> > <?php echo $i; ?></option>
		                             <?php endfor;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>生成二维码图片</label>
                            <div class="controls">
                                  <?php if($this->input->get('state')==1):?>
                                   <img src="<?php echo $this->config->show_image_url('common/ewm','qrcode.png');?>" />
                                  <?php else:?>
                                   <img src="<?php echo $this->config->show_image_url('common/ewm','helloweba.png');?>" />
                                  <?php endif;?>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 生成</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>