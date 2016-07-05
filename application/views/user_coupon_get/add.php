<?php $this->load->view('layout/header');?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">用户优惠劵<small> 用户优惠劵</small></h3>
            <?php echo breadcrumb(array('用户优惠劵', '用户优惠劵', '用户优惠劵添加')); ?>
        </div>
    </div>
    <?php echo execute_alert_message() ?>
    <div class="row-fluid">
        <div class="span12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption"><i class="icon-plus-sign"></i>编辑</div>
                    <div class="tools">
                        <a class="collapse" href="javascript:;"></a>
                        <a class="remove" href="javascript:;"></a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form class="form-horizontal line-form" action="<?php echo base_url('user_coupon_get/addPost') ?>" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label class="control-label"><em>* </em>优惠劵名称</label>
                            <div class="controls">
                                <input type="hidden" name="coupon_set_id" value="<?php echo $this->input->get('coupon_set_id') ?>">
                                <input type="text" name="coupon_name" class="m-wrap span8 required">
                            </div>
                        </div>
                        <div class="control-group add-pop-up-html">
                            <label class="control-label"><em>* </em>用户编号</label>
                            <div class="controls">
                                <input type="text" name="uid" class="m-wrap span8 useruid required" placeholder="双击选择用户编号">
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
                            <label class="control-label">开始使用时间</label>
                            <div class="controls">
                                <div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" name="start_time" size="16" class="m-wrap date-picker" readonly="readonly">
                                    <span class="add-on"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">结束使用时间</label>
                            <div class="controls">
                                <div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" name="end_time" size="16" class="m-wrap date-picker" readonly="readonly">
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
                            <label class="control-label">满减条件</label>
                            <div class="controls">
                                <input type="text" name="condition" class="m-wrap span8 number required" placeholder="请输入优惠劵使用条件，请填写金额，默认为零不限制">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><em>* </em>使用状态</label>
                            <div class="controls">
                                <label class="radio">
                                    <input type="radio" name="status" value="1" checked="checked"> 未使用
                                </label>
                                <label class="radio">
                                    <input type="radio" name="status" value="2"> 已使用
                                </label>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">使用说明</label>
                            <div class="controls">
                                <textarea name="note" class="m-wrap span8"  placeholder="请输入优惠劵使用说明"></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn green" type="submit"><i class="icon-ok"></i> 保存</button>
                            <a href="<?php echo base_url('user_coupon_get/grid').'?coupon_set_id='.$this->input->get('coupon_set_id') ?>">
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
<?php $this->load->view('user/ajaxUser/ajaxGet');?>
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
