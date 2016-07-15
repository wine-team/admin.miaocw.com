<form class="form-horizontal line-form" action="<?php echo base_url('mall_category/savePost'); ?>" method="post" enctype="multipart/form-data">
    <div class="inbox-header clearfix">
        <?php if (isset($mallCategory)) :?>
            <h3 class="pull-left"><span><?php echo $mallCategory->cat_name.'(ID：'.$mallCategory->cat_id.'）'; ?></span></h3>
            <h3 class="pull-right">
                <a class="btn green" href="<?php echo base_url('mall_category/delete/'.$mallCategory->cat_id); ?>" onclick="return confirm('删除分类将会删除分类下的所有产品，确定要删除？')"><i class="halflings-icon remove white"></i>删除分类</a>
                <button type="submit" class="btn green">保存 <i class="m-icon-swapright m-icon-white"></i></button>
            </h3>
        <?php else : ?>
            <h3 class="pull-left"><span>添加新分类</span></h3>
        <?php endif; ?>
    </div>
    <div class="tabbable tabbable-custom tabbable-custom-profile">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1_1" data-toggle="tab">基本信息</a></li>
            <li><a href="#tab_1_2" data-toggle="tab">分类产品</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane row-fluid active" id="tab_1_1">
                <div class="control-group">
                    <label class="control-label">分类名称：</label>
                    <div class="controls">
                        <input type="text" name="" class="m-wrap span8 required">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">激活状态：</label>
                    <div class="controls">
                        <select name="is_show" class="m-wrap medium">
                            <option value="1">是</option>
                            <option value="2">否</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">关键词：</label>
                    <div class="controls">
                        <input type="text" name="keyword" class="m-wrap span8">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">类名全名：</label>
                    <div class="controls">
                        <input type="text" name="full_name" class="m-wrap span8">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">CMS BLOCK</label>
                    <div class="controls">
                        <select name="attr_set_id" class="medium m-wrap chosen" data-placeholder="请选择">
                            <option value=""></option>
                            <?php foreach ($cmsBlock->result() as $key=>$value) : ?>
                                <option value="<?php echo $value->block_id;?>"><?php echo $value->name;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">分类描述</label>
                    <div class="controls">
                        <textarea class="span8 m-wrap" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="tab-pane row-fluid" id="tab_1_2">

            </div>
        </div>
    </div>
</form>