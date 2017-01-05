<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">促销管理
                <small> 促销管理</small>
            </h3>
            <?php echo breadcrumb(array('salestopic/index' => '促销管理', 'salestopic/images' => '图片管理')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-reorder"></i>图片管理</div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                        <a href="javascript:;" class="remove"></a>
                    </div>
                </div>
                <div class="portlet-body" style="display: block;">
                    <div class="row-fluid">
                        <div class="span1"></div>
                        <div class="span11">
                            <form class="line-form" action="<?php echo base_url('salestopic/saveImages'); ?>" method="post" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label"><em>* </em>链接地址</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap large required url" name="url"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">描述</label>
                                    <div class="controls">
                                        <input type="text" class="m-wrap large" name="desc"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><em>* </em>图片</label>
                                    <div class="controls">
                                        <input type="hidden" name="sales_id" value="<?php echo $salestopic->sales_id ?>"/>
                                        <input type="hidden" name="pics" value='<?php echo $salestopic->image ?>'/>
                                        <input type="file" name="images" class="checkPicture required">
                                    <div>
                                </div>
                                <button class="btn green" type="submit"><i class="icon-plus"></i> 上传</button>
                            </form>
                        </div>
                    </div>
                    <hr class="clearfix"/>
                    <?php if (count(json_decode($images)) > 0) : $i = 1 ?>
                        <?php foreach (json_decode($images) as $key=>$val) : ?>
                            <?php if (($i - 1) % 4 == 0) : ?><div class="row-fluid"><?php endif; ?>
                            <div class="span3">
                                <div class="item" style="height:240px">
                                    <a target="_blank" href="<?php echo $this->config->show_image_url('mall', $val->image); ?>">
                                        <div class="zoom">
                                            <img src="<?php echo $this->config->show_image_url('mall', $val->image); ?>" width="373" height="240">
                                        </div>
                                    </a>
                                    <div class="details">
                                        <a href="<?php echo base_url('salestopic/deleteImage/'.$salestopic->sales_id.'?image_name='.$val->image.'&key='.$key) ?>" class="icon" onclick="return confirm('确定要删除？')">删除</a>
                                    </div>
                                </div>
                                <p style="word-break: break-all;"><?php echo $val->url;?></p>
                                <p style="word-break: break-all;"><?php echo isset($val->desc) ? $val->desc : '';?></p>
                            </div>
                            <?php if ($i % 4 == 0 || $i == count(json_decode($images))) : ?></div><?php endif; ?>
                        <?php $i++;endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer'); ?>