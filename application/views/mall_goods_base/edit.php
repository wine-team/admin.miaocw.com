<?php $this->load->view('layout/header'); ?>
<div class="container-fluid mall-goods-add-step2">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">趣网商城 <small> 商品编辑</small></h3>
            <?php echo breadcrumb(array('mall_goods_base/grid' => '趣网产品', "mall_goods_base/edit/".$mallgoods->goods_id.'?attr_set_id='.$mallgoods->attr_set_id => '商品编辑')); ?>
        </div>
    </div>
    <div class="alert alert-error" style="display:none;">
        <button data-dismiss="alert" class="close"></button>
        <a href="javascript:;" class="glyphicons no-js remove_2"><i></i><p></p></a>
    </div>
    <div class="row-fluid">
        <div class="span12">
           <div class="tabbable tabbable-custom boxless">
               <form class="form-horizontal form-row-seperated mall-goods-form" enctype="multipart/form-data">
				   <input type="hidden" name="goods_id" value="<?php echo $mallgoods->goods_id;?>" />
				   <ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">基本信息</a></li>
						<li><a href="#tab_2" data-toggle="tab">销售信息</a></li>
						<li><a href="#tab_3" data-toggle="tab">属性信息</a></li>
						<li><a href="#tab_4" data-toggle="tab">运费信息</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<?php $this->load->view('mall_goods_base/edit/basic') ?>;
						</div>
						<div class="tab-pane" id="tab_2">
							<?php $this->load->view('mall_goods_base/edit/sales') ?>;
						 </div>
						 <div class="tab-pane" id="tab_3">
							 <?php $this->load->view('mall_goods_base/edit/spec') ?>;
						 </div>
						 <div class="tab-pane" id="tab_4">
							 <?php $this->load->view('mall_goods_base/edit/freight') ?>;
						 </div>
					 </div>
			  </form>
           </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer');?>
<?php $this->load->view('supplier/ajaxSupplier/ajaxGet');?>
<?php $this->load->view('mall_goods_base/ajaxGoodsBase/ajaxGet');?>
<script type="text/javascript">
$(document).ready(function(){
	$('.mall-goods-add-step2 .table input[type="checkbox"]').click(function(){
		if($(this).is(':checked')==false){
			$(this).parents('tr').find('input[type="text"]').each(function(){
				$(this).val('');
			});
		}
	});

    $('.mall-goods-add-step2').on("click", "input[name='transport_type']", function () {

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