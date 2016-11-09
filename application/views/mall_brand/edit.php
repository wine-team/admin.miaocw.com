<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>品牌管理</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_brand/grid'=>'品牌管理', '编辑品牌')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑品牌</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_brand/editPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品类别</label>
                            <div class="controls">
                                <select name="cat_id" class="m-wrap large required">
                                    <?php foreach ($catLevel1 as $cat_id=>$cat_name) :?>
                                        <option value="<?php echo $cat_id;?>" <?php if ($cat_id == $res->cat_id):?> selected="selected"<?php endif;?>><?php echo $cat_name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>商品类型</label>
                            <div class="controls">
                                <select name="attr_set_id" class="m-wrap large required">
                                    <?php foreach ($attributeSet as $attr_set_id=>$value) :?>
                                        <option value="<?php echo $attr_set_id;?>" <?php if ($attr_set_id == $res->attr_set_id):?> selected="selected"<?php endif;?>><?php echo $value['attr_set_name'];?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>品牌名称</label>
                            <div class="controls">
                                <input type="hidden" name="brand_id" value="<?php echo $res->brand_id;?>" >
                                <input type="text" name="brand_name" value="<?php echo $res->brand_name;?>" class="m-wrap large required"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">网址</label>
                            <div class="controls">
                                <input type="text" name="site_url" value="<?php echo $res->site_url;?>" class="m-wrap large"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>品牌logo</label>
                            <div class="controls">
                                <?php if (is_file($this->config->upload_image_path('brand', $res->brand_logo))) :?>
                                    <a href="<?php echo $this->config->show_image_url('brand', $res->brand_logo)?>" target="_blank">
                                        <img src="<?php echo $this->config->show_image_url('brand', $res->brand_logo)?>" width=150 height="100">
                                    </a>
                                    <input type="hidden" name="old_brand_logo" value="<?php echo $res->brand_logo ?>"/>
                                    <input type="file" name="brand_logo"/>
                                <?php else : ?>
                                    <input type="file" name="brand_logo"/>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>品牌授权</label>
                            <div class="controls">
                                <?php if (is_file($this->config->upload_image_path('brand', $res->brand_author))) :?>
                                    <a href="<?php echo $this->config->show_image_url('brand', $res->brand_author)?>" target="_blank">
                                        <img src="<?php echo $this->config->show_image_url('brand', $res->brand_author)?>" width=150 height="100">
                                    </a>
                                    <input type="hidden" name="old_brand_author" value="<?php echo $res->brand_author ?>"/>
                                    <input type="file" name="brand_author"/>
                                <?php else : ?>
                                    <input type="file" name="brand_author"/>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">品牌简介</label>
                            <div class="controls">
                                <textarea name="brand_desc" class="textarea-multipart-edit"><?php echo $res->brand_desc;?></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="number" class="m-wrap large required" name="sort_order" value="<?php echo $res->sort_order;?>"/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否显示</label>
                            <div class="controls">
                                <label class="radio">
                                	<input type="radio" class="required" name="is_show" value="1" <?php if($res->is_show==1):?>checked="checked"<?php endif;?>/> 是
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="is_show" value="2" <?php if($res->is_show==2):?>checked="checked"<?php endif;?>/> 否（当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌）
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_brand/grid') ?>">
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