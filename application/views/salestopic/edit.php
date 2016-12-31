<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">促销管理 </h3>
            <?php echo breadcrumb(array('salestopic/index'=>'促销管理', '促销管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑促销</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form add-hotelfacilitie-html" action="<?php echo base_url('salestopic/editPost') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="sales_id" value="<?php echo $detail->sales_id; ?>">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>促销名称</label>
                            <div class="controls">
                                <input type="text" class="m-wrap medium required" name="sales_name" value="<?php echo $detail->sales_name; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">活动关联编号</label>
                            <div class="controls">
                                <input type="text" class="m-wrap span6" name="union_id" value="<?php echo $detail->union_id; ?>">
                                <span>如果有多个编号，编号之间请用,隔开</span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>上下架</label>
                            <div class="controls">
                                <select class="medium m-wrap required" name="status">
                                    <?php foreach ($status as $key=>$value) :?>
                                        <option <?php echo $detail->status == $key ? 'selected="selected"' : ''; ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>类别</label>
                            <div class="controls">
                                <select class="medium m-wrap required" name="category">
                                    <?php foreach ($categories as $key=>$value) :?>
                                        <option <?php echo $detail->category == $key ? 'selected="selected"' : ''; ?> value="<?php echo $key;?>"><?php echo $value;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
<!--                        <div class="control-group">-->
<!--                            <label class="control-label">图片</label>-->
<!--                            <div class="controls">-->
<!--                                --><?php //if (is_file($this->config->upload_image_path('sales', $detail->image))) :?>
<!--                                    <a href="--><?php //echo $this->config->show_image_url('sales', $detail->image)?><!--" target="__blank">-->
<!--                                        <img src="--><?php //echo $this->config->show_image_url('sales', $detail->image)?><!--" width=150 height="100">-->
<!--                                    </a>-->
<!--                                    <input type="hidden" name="oldfilename" value="--><?php //echo $detail->image ?><!--"/>-->
<!--                                    <input type="file" name="image"/>-->
<!--                                --><?php //else : ?>
<!--                                    <input type="file" name="image"/>-->
<!--                                --><?php //endif; ?>
<!--                            </div>-->
<!--                        </div>-->
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('salestopic/index') ?>">
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
