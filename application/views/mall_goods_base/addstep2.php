<?php $this->load->view('layout/header'); ?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">妙网商城 <small> 商品添加</small></h3>
            <?php echo breadcrumb(array('mall_goods_base/grid' => '妙网产品', "mall_goods_base/addstep1" => '商品添加第2步')); ?>
        </div>
    </div>
    <div class="alert alert-error" style="display:none;">
        <button data-dismiss="alert" class="close"></button>
        <a href="javascript:;" class="glyphicons no-js remove_2"><i></i><p></p></a>
    </div>
    <div class="row-fluid">
        <div class="span12">
           <div class="tabbable tabbable-custom tabbable-full-width">
               <form class="form-horizontal mall-goods-form" enctype="multipart/form-data">
                   <ul class="nav nav-tabs">
                       <li class="active"><a href="#tab_1" data-toggle="tab">基本信息</a></li>
                       <li><a href="#tab_2" data-toggle="tab">销售信息</a></li>
                       <li><a href="#tab_3" data-toggle="tab">促销信息</a></li>
                       <li><a href="#tab_4" data-toggle="tab">属性信息</a></li>
                       <li><a href="#tab_5" data-toggle="tab">运费信息</a></li>
                       <li><a href="#tab_6" data-toggle="tab">所属分类</a></li>
                       <li><a href="#tab_7" data-toggle="tab">商品关联</a></li>
                    </ul>
				    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <?php $this->load->view('mall_goods_base/add/basic'); ?>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <?php $this->load->view('mall_goods_base/add/sales'); ?>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <?php $this->load->view('mall_goods_base/add/promote'); ?>
                        </div>
                        <div class="tab-pane" id="tab_4">
                            <?php $this->load->view('mall_goods_base/add/spec'); ?>
                        </div>
                        <div class="tab-pane" id="tab_5">
                            <?php $this->load->view('mall_goods_base/add/freight') ;?>
                        </div>
                        <div class="tab-pane" id="tab_6">
                            <?php echo getCategoryCheckbox($categorys); ?>
                        </div>
                        <div class="tab-pane data-ajax-url" id="tab_7" data-ajax-url="<?php echo base_url('mall_goods_related/ajaxGet');?>">
                            <?php $this->load->view('mall_goods_related/ajaxGoodsRelated/ajaxGet');?>
                        </div>
				    </div>
                    <div class="form-actions">
                       <button class="btn green step4" type="submit"><i class="icon-ok"></i> 保存</button>
                       <a class="btn step3" href="<?php echo base_url('mall_goods_base/addstep1')?>">返回上一步</a>
                    </div>
			    </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<?php $this->load->view('supplier/ajaxSupplier/ajaxGet');?>
<script type="text/javascript">
$(document).ready(function(){
    $('.mall-goods-form').on("click", "input[name='transport_type']", function () {
        var obj = $(this).parents('label').next();
        var uid = $('input[name=supplier_id]').val();
        var key = $(this).attr('data-key');
        if (uid == '') {
           return alert('请先填写供应商');
        } else {
            if (obj[0].tagName == 'SELECT') {
                $('#freight_cost').removeClass('required').hide();
                $('#freight_id').addClass('required');
            } else {
                $('#freight_id').removeClass('required').hide();
                $('#freight_cost').addClass('required');
            }
            obj.show();
            $.ajax({
                type: 'post',
                async: true,
                dataType: 'json',
                url: hostUrl() + '/mall_freight/ajaxGetTransport',
                data: {uid: uid},
                success: function (data) {
                    if (data) {
                        var transportObj = document.getElementById('freight_id');
                        var len = data.length;
                        transportObj.options.length = 0;
                        for (var i = 0; i < data.length; i++) {
                            transportObj.options[i] = new Option(data[i].name, data[i].freight_id);
                            if (key == data[i].freight_id) {
                                transportObj.selectedIndex = key;
                            }
                        }
                    }
                }
            });
        }
    });

    // 提交验证
    $('form.mall-goods-form').submit(function () {
        return false;
    }).validate({
    	ignore: "",
        submitHandler: function (f) {
            $.ajax({
                type: 'post',
                async: true,
                dataType: 'json',
                url: hostUrl() + '/mall_goods_base/ajaxValidate',
                data: $('form.mall-goods-form').serialize(),
                success: function (data) {
                    if (data.status) {
                        $('.alert-error').hide();
                        window.location.href = data.messages;
                    } else {
                        $('.alert-error').show();
                        $('.alert-error .remove_2 p').html(data.messages);
                        var body = (window.opera) ? (document.compatMode == 'CSS1Compat' ? $('html') : $('body')) : $('html,body');
                        body.animate({scrollTop: $('.page-container').offset().top}, 1000);
                    }
                }
            });
        }
    });
});
</script>