<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">添加分类 </h3>
            <?php echo breadcrumb(array('salestopic/index'=>'促销管理', 'salestopiccategory/index?sales_id='.$this->input->get('sales_id')=>'促销分类管理', '添加分类')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加分类</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form add-hotelfacilitie-html" action="<?php echo base_url('salestopiccategory/addPost') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="sales_id" value="<?php echo $this->input->get('sales_id'); ?>" >
                        <div class="control-group">
                            <label class="control-label"><em>* </em>标题</label>
                            <div class="controls">
                                <input type="text" class="m-wrap medium required" name="title">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>标题备注</label>
                            <div class="controls">
                                <input type="text" class="m-wrap medium required" name="note">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>分类链接</label>
                            <div class="controls">
                                <input type="text" class="m-wrap span6 url" name="link_url"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>产品类型</label>
                            <div class="controls">
                                <select class="medium m-wrap required" name="type">
                                    <?php foreach ($types as $key=>$value) :?>
                                        <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>排序</label>
                            <div class="controls">
                                <input type="text" class="m-wrap medium required digits" name="topic_sort" value="127">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>上下架</label>
                            <div class="controls">
                                <select class="medium m-wrap required" name="status">
                                    <?php foreach ($status as $key=>$value) :?>
                                        <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 下一步</button>
                            <a href="<?php echo base_url('salestopiccategory/index?sales_id='.$this->input->get('sales_id')) ?>">
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