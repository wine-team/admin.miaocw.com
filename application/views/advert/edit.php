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
                    <form class="form-horizontal line-form" action="<?php echo base_url('advert/editPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>所属广告位</label>
                            <div class="controls">
                                <input type="hidden" name="advert_id" value="<?php echo $advert->advert_id; ?>">
                                <select name="source_state" class="medium m-wrap valid">
                                    <?php foreach ($advertArray as $key=>$value) : ?>
                                        <option value="<?php echo $key;?>" <?php if ($advert->source_state == $key):?>selected="selected"<?php endif ?>><?php echo $value; ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>标题</label>
                            <div class="controls">
                                <input type="text" name="title" class="m-wrap large required" value="<?php echo $advert->title; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>链接地址</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required url" name="url" value="<?php echo $advert->url; ?>"/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">图片</label>
                            <div class="controls">
                            <?php if (is_file($this->config->upload_image_path('advert', $advert->picture))) :?>
                                <a href="<?php echo $this->config->show_image_url('advert', $advert->picture)?>" target="__blank">
                                    <img src="<?php echo $this->config->show_image_url('advert', $advert->picture)?>" width=150 height="100">
                                </a>
                                <input type="hidden" name="oldfilename" value="<?php echo $advert->picture ?>"/>
                                <input type="file" name="picture"/>
                            <?php else : ?>
                                <input type="file" class="required" name="picture"/>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required number" name="sort" value="<?php echo $advert->sort; ?>" /> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">说明</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit" name="description"><?php echo $advert->description; ?>"</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('advert/grid') ?>">
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