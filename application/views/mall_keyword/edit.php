<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">热门搜索<small>搜索列表</small></h3>
            <?php echo breadcrumb(array('热门搜索', 'mall_keyword/grid'=>'搜索列表', '编辑热门排序')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑热门排序</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('mall_keyword/editPost') ?>" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="id" value="<?php echo $res->id;?>">
                        
                        <div class="control-group">
                            <label class="control-label">关键字</label>
                            <div class="controls">
                                <input type="text" class="m-wrap large" readonly value="<?php echo $res->key_word;?>"/> 
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label">搜索次数</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $res->number;?>" class="m-wrap large" readonly="readonly"/>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="number" name="sort" value="<?php echo $res->sort;?>" maxlength=3 class="m-wrap large required"/>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('mall_keyword/grid') ?>">
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