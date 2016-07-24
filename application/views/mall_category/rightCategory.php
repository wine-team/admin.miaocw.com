<form class="form-horizontal line-form" action="<?php echo base_url('mall_category/savePost'); ?>" method="post" enctype="multipart/form-data">
    <div class="add-portfolio clearfix">
        <?php if (isset($mallCategory)) :?>
            <div class="pull-left"><?php echo $mallCategory->cat_name.'(ID：'.$mallCategory->cat_id.'）'; ?></div>
            <div class="pull-right">
                <a href="<?php echo base_url('mall_category/delete/'.$mallCategory->cat_id); ?>" class="btn green mini" onclick="return confirm('删除分类将会删除分类下的所有产品，确定要删除？')">删除分类</a>
                <button type="submit" class="btn green mini">保存</button>
            </div>
        <?php else : ?>
            <div class="pull-left">添加新分类</div>
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
                        <input type="text" name="cat_name" class="m-wrap span8 required">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>激活状态</label>
                    <div class="controls">
                        <select name="is_show" class="m-wrap medium required">
                            <option value="1">是</option>
                            <option value="2">否</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><em>* </em>类名全名</label>
                    <div class="controls">
                        <input type="text" name="full_name" class="m-wrap span8 required" placeholder="分类页面的位置导航">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">CMS BLOCK</label>
                    <div class="controls">
                        <select name="block_id" class="medium m-wrap chosen" data-placeholder="请选择">
                            <option value=""></option>
                            <?php foreach ($cmsBlock->result() as $key=>$value) : ?>
                                <option value="<?php echo $value->block_id;?>"><?php echo $value->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">专区名称</label>
                    <div class="controls">
                        <input type="text" name="special_name" class="m-wrap span8" placeholder="此字段设置产品位置的名称">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">页面标题</label>
                    <div class="controls">
                        <input type="text" name="page_title" class="m-wrap span8">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">页面关键字</label>
                    <div class="controls">
                        <textarea name="meta_keywords" rows="3" class="span8 m-wrap"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">页面描述</label>
                    <div class="controls">
                        <textarea name="meta_description" rows="3" class="span8 m-wrap"></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">排序</label>
                    <div class="controls">
                        <input type="text" name="sort_order" value="50" class="m-wrap span8">
                    </div>
                </div>
            </div>
            <div class="tab-pane row-fluid" id="tab_1_2">
                <?php $this->load->view('mall_category/catProduct');?>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>