<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">优惠劵设置<small> 优惠劵设置</small></h3>
            <?php echo breadcrumb(array('优惠劵设置', '优惠劵设置', '优惠劵设置添加')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>添加</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('user_coupon_set/addPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>优惠劵名称</label>
                            <div class="controls">
                                <input type="text" name="coupon_name" class="m-wrap span8 required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>优惠劵类型</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="scope" value="1" checked="checked"> 自营劵
                                </label>
                                <label class="radio">
                                    <input type="radio" name="scope" value="2"> 店铺劵
                                </label>
                            </div>
                        </div>
                        <div class="control-group add-pop-up-html">
                            <label class="control-label"><em>* </em>关联编号</label>
                            <div class="controls">
                                <input type="text" name="related_id" class="m-wrap span8 required" placeholder="自营劵为商品属性ID，默认0,支持所有自营商品；店铺劵为供应商编号">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>开始使用时间</label>
                            <div class="controls">
                                <div class="input-append date form_datetime">
                                    <input type="text" name="start_time" size="16" class="m-wrap m-ctrl-medium required">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>结束使用时间</label>
                            <div class="controls">
                                <div class="input-append date form_datetime">
                                    <input type="text" name="end_time" size="16" class="m-wrap m-ctrl-medium required">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>优惠劵金额</label>
                            <div class="controls">
                                <input type="text" name="amount" class="m-wrap span8 required" placeholder="请输入可以使用的金额">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>优惠劵数量</label>
                            <div class="controls">
                                <input type="text" name="number" class="m-wrap span8 required" placeholder="请输入发布的优惠劵数量">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">满减条件</label>
                            <div class="controls">
                                <input type="text" name="condition" class="m-wrap span8 number required" placeholder="请输入优惠劵使用条件，请填写金额，默认为零不限制">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">使用说明</label>
                            <div class="controls">
                                <textarea name="note" class="m-wrap span8"  placeholder="请输入优惠劵使用说明"></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn green"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('user_coupon_set/grid') ?>">
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
<?php $this->load->view('supplier/ajaxSupplier/ajaxGet');?>
<?php $this->load->view('mall_attribute_set/ajaxAttributeSet/ajaxGet');?>
<script type="text/javascript">
    $(document).ready(function () {
        function autoSelectClass()
        {
            if ($('input[name=scope]:checked').val() == 1) {//自营劵
                $('.add-pop-up-html input[name=related_id]').removeClass('supplieruid').addClass('attributeSet');
            } else {
                $('.add-pop-up-html input[name=related_id]').removeClass('attributeSet').addClass('supplieruid');
            }
        }
        autoSelectClass();
        $('input[name=scope]').click(function () {
            autoSelectClass();
        });
    });
</script>
