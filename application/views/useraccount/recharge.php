<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">财务管理  <small>虚拟充值</small><small>充值</small></h3>
            <?php echo breadcrumb(array('财务管理 ', 'useraccount/index'=>'虚拟充值', 'useraccount/recharge'=>'充值')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>充值</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('useraccount/addRecharge') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>充值账户</label>
                            <div class="controls">
                                <input type="hidden" name="uid" value="<?php echo $userInfo->uid;?>" >
                                <div><span><?php echo $userInfo->user_name;?></span></div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>充值金额</label>
                            <div class="controls">
                                <input type="text" name="amount_carry" class="m-wrap large required number">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('useraccount/index') ?>">
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