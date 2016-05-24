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
                                <input type="text" name="brand_name" class="m-wrap large required"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">网址</label>
                            <div class="controls">
                                <input type="text" name="site_url" class="m-wrap large url"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">品牌logo</label>
                            <div class="controls">
                                <input type="file" name="brand_logo" class="m-wrap large"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">品牌简介</label>
                            <div class="controls">
                                <textarea class="textarea-multipart-edit" name="brand_desc"></textarea>
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
                                	<input type="radio" class="required" name="is_show" value="1"  checked="checked"/> 是
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="is_show" value="2" /> 否（当品牌下还没有商品的时候，首页及分类页的品牌区将不会显示该品牌）
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