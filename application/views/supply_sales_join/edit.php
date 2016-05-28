<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">商品管理 <small>品牌管理</small></h3>
            <?php echo breadcrumb(array('商品管理', 'supply_sales_join/grid'=>'品牌管理', '编辑品牌')); ?>
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
                    <form class="form-horizontal line-form" action="<?php echo base_url('supply_sales_join/editPost') ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $res->id;?>" >
                        <div class="control-group">
                            <label class="control-label">用户名</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $res->user_name;?>" readonly class="m-wrap large"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">公司名称</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $res->company;?>" readonly class="m-wrap large"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">地址</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $res->address;?>" readonly class="m-wrap large"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">电话</label>
                            <div class="controls">
                                <input type="text" value="<?php echo $res->phone;?>" readonly class="m-wrap large"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">申请类型</label>
                            <div class="controls">
                                <input type="text" value="<?php if($res->type==1)echo '分销申请'; else echo '供应申请';?>" readonly class="m-wrap large"/>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><em>* </em>状态</label>
                            <div class="controls">
                                <label class="radio">
                                	<input type="radio" class="required" name="flag" value="1" <?php if($res->flag==1) echo 'checked="checked"';?> /> 刚申请
                                </label>
                                <label class="radio">
                                	<input type="radio" class="required" name="flag" value="2" <?php if($res->flag==2) echo 'checked="checked"';?>/> 已处理 （处理申请后更改为‘已处理’）
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('supply_sales_join/grid') ?>">
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