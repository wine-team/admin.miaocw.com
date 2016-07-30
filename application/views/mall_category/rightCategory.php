<form class="form-horizontal line-form" action="<?php echo base_url('mall_category/savePost'); ?>" method="post" enctype="multipart/form-data">
    <div class="add-portfolio clearfix">
        <?php if (isset($mallCategory)) :?>
            <div class="pull-left"><?php echo $mallCategory->cat_name.'(ID：'.$mallCategory->cat_id.'）'; ?></div>
            <div class="pull-right">
                <a href="<?php echo base_url('mall_category/delete/'.$mallCategory->cat_id); ?>" class="btn green mini" onclick="return confirm('删除分类将会删除分类下的所有产品，确定要删除？')">删除分类</a>
                <button type="submit" class="btn green mini">保存</button>
            </div>
        <?php elseif ($this->input->get('parent_id')) : ?>
            <div class="pull-left">添加子分类</div>
            <div class="pull-right">
                <button type="submit" class="btn green mini">保存</button>
            </div>
        <?php else :?>
            <div class="pull-left">添加新分类</div>
            <div class="pull-right">
                <button type="submit" class="btn green mini">保存</button>
            </div>
        <?php endif; ?>
    </div>
    <div class="tabbable tabbable-custom tabbable-full-width">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1_1" data-toggle="tab">基本信息</a></li>
            <li><a href="#tab_1_2" data-toggle="tab">分类产品</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane row-fluid active" id="tab_1_1">
                <div class="control-group">
                    <label class="control-label"><em>* </em>分类名称</label>
                    <div class="controls">
                        <input type="hidden" name="cat_id" value="<?php echo isset($mallCategory->cat_id) ? $mallCategory->cat_id : $this->input->get('cat_id');?>">
                        <input type="hidden" name="parent_id" value="<?php echo $this->input->get('parent_id');?>">
                        <input type="text" name="cat_name" value="<?php echo isset($mallCategory->cat_name) ? $mallCategory->cat_name : '' ?>" class="m-wrap span8 required">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>激活状态</label>
                    <div class="controls">
                        <select name="is_show" class="m-wrap medium required">
                            <option value="1" <?php if (isset($mallCategory->is_show) && $mallCategory->is_show==1) :?>selected="selected"<?php endif;?>>是</option>
                            <option value="2" <?php if (isset($mallCategory->is_show) && $mallCategory->is_show==2) :?>selected="selected"<?php endif;?>>否</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>分类导航</label>
                    <div class="controls">
                        <input type="text" name="full_name" value="<?php echo isset($mallCategory->full_name) ? $mallCategory->full_name : '' ?>" class="m-wrap span8 required" placeholder="分类页面的位置导航">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">CMS BLOCK</label>
                    <div class="controls">
                        <select name="block_id" class="medium m-wrap chosen" data-placeholder="请选择">
                            <option value=""></option>
                            <?php foreach ($cmsBlock->result() as $key=>$value) : ?>
                                <option value="<?php echo $value->block_id;?>" <?php if (isset($mallCategory->block_id) && $mallCategory->block_id==2) :?>selected="selected"<?php endif;?>><?php echo $value->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">分类图片</label>
                    <div class="controls">
                        <?php if (isset($mallCategory->cat_img) && is_file($this->config->upload_image_path('mall', $mallCategory->cat_img))) :?>
                            <a href="<?php echo $this->config->show_image_url('mall', $mallCategory->cat_img)?>" target="_blank">
                                <img src="<?php echo $this->config->show_image_url('mall', $mallCategory->cat_img)?>" width=60 height="60">
                            </a>
                            <input type="hidden" name="oldfilename" value="<?php echo $mallCategory->cat_img ?>">
                            <input type="file" name="cat_img" class="checkPicture">
                        <?php else : ?>
                            <input type="file" name="cat_img" class="checkPicture">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">专区名称</label>
                    <div class="controls">
                        <input type="text" name="special_name" value="<?php echo isset($mallCategory->special_name) ? $mallCategory->special_name : '' ?>" class="m-wrap span8" placeholder="此字段设置产品位置的名称">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">页面标题</label>
                    <div class="controls">
                        <input type="text" name="page_title" value="<?php echo isset($mallCategory->page_title) ? $mallCategory->page_title : '' ?>" class="m-wrap span8">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">页面关键字</label>
                    <div class="controls">
                        <textarea name="meta_keywords" rows="3" class="span8 m-wrap"><?php echo isset($mallCategory->meta_keywords) ? $mallCategory->meta_keywords : '' ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">页面描述</label>
                    <div class="controls">
                        <textarea name="meta_description" rows="3" class="span8 m-wrap"><?php echo isset($mallCategory->meta_description) ? $mallCategory->meta_description : '' ?></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">排序</label>
                    <div class="controls">
                        <input type="text" name="sort_order" value="<?php echo isset($mallCategory->sort_order) ? $mallCategory->sort_order : '' ?>" class="m-wrap span8">
                    </div>
                </div>
            </div>
            <div class="tab-pane row-fluid" id="tab_1_2">
                <?php $this->load->view('mall_category_product/ajaxCategoryProduct/ajaxGet');?>
            </div>
        </div>
    </div>
</form>