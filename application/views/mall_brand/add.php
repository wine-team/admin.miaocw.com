<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>品牌管理</small></h3>
            <?php echo breadcrumb(array('商品管理', 'mall_brand/grid'=>'品牌管理', '添加品牌')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加品牌</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_brand/addPost') ?>" method="post" enctype ="multipart/form-data" >
                        <div class="control-group">
                            <label class="control-label"><em>* </em>品牌名称</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large required" name="brand_name" value=""/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">品牌logo</label>
                            <div class="controls">
                                <input type="file" class="m-wrap large" name="brand_logo" /> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">品牌简介</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit " name="brand_desc"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">站点</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large " name="site_url" value=""/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="number" class="m-wrap large required" name="sort_order" value="50"/> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>是否显示</label>
                            <div class="controls">
                                <label class="radio">
                                	<input type="radio" class="required" name="is_show" value="1"  checked="checked"/> 显示
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="is_show" value="2" /> 不显示
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