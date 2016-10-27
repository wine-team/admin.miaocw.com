<?php $this->load->view('layout/header'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="page-title">新闻管理
                    <small> 新闻管理</small>
                </h3>
                <?php echo breadcrumb(array('新闻管理', 'newscontent/grid' => '贝竹公告列表')); ?>
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
                            <div class="span3"></div>
                            <div class="span9">
                                <form class="line-form" action="<?php echo base_url('newscontent/saveImages'); ?>" method="post" enctype="multipart/form-data">
                                    <div class="pull-left">
                                        <input type="hidden" name="id" value="<?php echo $news_content->id ?>"/>
                                        <input type="hidden" name="image" value="<?php echo $news_content->image ?>"/>
                                        <input type="file" name="images" class="checkPicture required">
                                        <button class="btn green" type="submit"><i class="icon-plus"></i> 上传</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr class="clearfix"/>
                        <?php if (count($images) > 0) : $i = 1 ?>
                            <?php foreach ($images as $val) : ?>
                                <?php if (($i - 1) % 4 == 0) : ?><div class="row-fluid"><?php endif; ?>
                                <div class="span3">
                                    <div class="item" style="height:240px">
                                        <a target="_blank" href="<?php echo $this->config->show_image_url('infor', $val); ?>">
                                            <div class="zoom">
                                                <img src="<?php echo $this->config->show_image_url('infor', $val); ?>" width="373" height="240">
                                            </div>
                                        </a>
                                        <div class="details">
                                            <a href="<?php echo base_url('newscontent/deleteImage/'.$news_content->id.'?image_name='.$val) ?>" class="icon" onclick="return confirm('确定要删除？')">删除</a>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($i % 4 == 0 || $i == count($images)) : ?></div><?php endif; ?>
                                <?php $i++;endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('layout/footer'); ?>