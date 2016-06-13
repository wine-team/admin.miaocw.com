<?php $this->load->view('layout/header'); ?>
<div class="container-fluid mall-goods-add-step2">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">趣网商城 <small> 商品添加</small></h3>
            <?php echo breadcrumb(array('mall_goods_base/grid' => '趣网产品', "mall_goods_base/addstep1" => '商品添加第2步')); ?>
        </div>
    </div>
    <div class="alert alert-error" style="display:none;">
        <button data-dismiss="alert" class="close"></button>
        <a href="javascript:;" class="glyphicons no-js remove_2"><i></i><p></p></a>
    </div>
    <div class="row-fluid">
       <form class="mall-goods-form form-vertical" enctype="multipart/form-data">
            <div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#tab_1">商品基本信息</a></li>
					<li><a data-toggle="tab" href="#tab_2">商品销售信息</a></li>
					<li><a data-toggle="tab" href="#tab_3">商品属性信息</a></li>
					<li><a data-toggle="tab" href="#tab_4">商品运费信息</a></li>
				</ul>
	            <div class="tab-content">
					<div id="tab_1" class="tab-pane active">
	                     <div class="row-fluid">
	                          <div class="span10 booking-search">
								    <div class="control-group">
			                            <label class="control-label">商品分类</label>
			                            <div class="controls">
			                                 <?php $this->load->view('commonhtml/categorySelect');?>
			                            </div>
				                    </div>
				                    <div class="control-group">
			                            <label class="control-label"><em>* </em>商品类别</label>
			                            <input type="hidden" name="attribute_set_id" value="<?php echo $this->input->get('attr_set_id');?>" />
			                            <input type="hidden" name="extensionCode" value="<?php echo $this->input->get('extension_code');?>" />
			                            <div class="controls">
			                                <select name="extension_code" class="medium m-wrap valid" disabled="disabled">
		                                    <?php foreach ($extension as $key=>$value) : ?>
		                                        <option value="<?php echo $key;?>" <?php if($this->input->get('extension_code')==$key):?>selected="selected"<?php endif;?>><?php echo $value; ?></option>
		                                    <?php endforeach;?>
					                        </select>
	                            	    </div>
	                                </div>
	                                <div class="control-group">
			                            <label class="control-label"><em>* </em>商品名称</label>
			                            <div class="controls">
			                                <input type="text" class="m-wrap span8 required" placeholder="商品名称" name="goods_name">
			                            </div>
	                        		</div>
				                    <div class="control-group">
			                            <label class="control-label"><em>* </em>商品编号</label>
			                            <div class="controls">
			                                <input type="text" class="m-wrap span8 required" placeholder="商品编号" name="goods_sku">
			                            </div>
				                    </div>
					                <div class="control-group">
					                    <label class="control-label">商品品牌</label>
					                    <div class="controls">
			                                <select name="brand_id" class="m-wrap span8">
			                                    <option value="0">请选择</option>
			                                    <?php if ($brand->num_rows() > 0) : ?>
		                                        <?php foreach ($brand->result() as $item) : ?>
		                                            <option value="<?php echo $item->brand_id ?>"><?php echo $item->brand_name ?></option>
		                                        <?php endforeach; ?>
		                                        <?php endif; ?>
		                                    </select>
				                        </div>
				                    </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>净重（kg）</label>
			                            <div class="controls">
			                                <input type="text" name="goods_weight" class="m-wrap span8 required number" placeholder="重量(kg)">
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>商品简介</label>
			                            <div class="controls">
			                                <textarea name="goods_brief" rows="4" class="m-wrap span8 required" placeholder="商品简介"></textarea>
			                            </div>
			                        </div>
			                        <div class="control-group add-supplieruid-html">
			                            <label class="control-label"><em>* </em>供应商</label>
			                            <div class="controls">
			                                <input type="text" name="supplier_id" placeholder="供应商UID" class="m-wrap span8 supplieruid required tooltips" data-original-title="双击可弹框选择供应商；直接输入‘用户名称或编号’可提示" data-trigger="hover"  autocomplete="off">
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>审核状态</label>
			                            <div class="controls">
			                                <select class="m-wrap span8 number required" name="is_check">
			                                    <option value="1">未审核</option>
			                                    <option value="2">审核通过</option>
			                                    <option value="3">审核拒绝</option>
			                                </select>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>上下架</label>
			                            <div class="controls">
			                                <select class="m-wrap span8 required" name="is_on_sale">
			                                    <option value="1">上架</option>
			                                    <option value="2">下架</option>
			                                </select>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>pc商品详情</label>
			                            <div class="controls">
			                                <textarea name="goods_desc"  class="textarea-multipart-edit m-wrap span9 required" placeholder="pc商品详情"></textarea>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>wap商品详情</label>
			                            <div class="controls">
			                                <textarea name="wap_goods_desc" class="textarea-multipart-edit m-wrap span9 required" placeholder="wap商品详情"></textarea>
			                            </div>
			                        </div>
							   </div>
					      </div>
			         </div>
			         <div id="tab_2" class="tab-pane">
	                     <div class="row-fluid">
	                          <div class="span10 booking-search">
	                                <div class="control-group ">
			                            <label class="control-label">市场价格</label>
			                            <div class="controls">
			                                <input type="text" name="market_price" class="m-wrap span8 required number" placeholder="市场价格">
			                            </div>
	                                </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>供应价</label>
			                            <div class="controls">
			                                <input type="text" name="shop_price" class="m-wrap span8 required number" placeholder="供应价">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>促销价</label>
			                            <div class="controls">
			                                <input type="text" name="promote_price" class="m-wrap span8 required number" placeholder="促销价">
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>购买频率限制</label>
			                            <div class="controls">
			                            	<label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="0" checked="checked"/>不限
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="1"/>天
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="2"/>周
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="3"/>月
			                                </label>	
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="4"/>年
			                                </label>
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>限制购买数量</label>
			                            <div class="controls">
			                                <input type="text" name="limit_num" class="m-wrap span8 required" placeholder="限制购买数量 ,0代表不限制" value="0">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>促销开始时间</label>
			                            <div class="controls">
			                                <input type="text" name="promote_start_date" class="m-wrap span8 required date-picker date" placeholder="促销开始时间" value="<?php echo date('Y-m-d') ?>">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>促销结束时间</label>
			                            <div class="controls">
			                                <input type="text" name="promote_end_date" class="m-wrap span8 required date-picker date" placeholder="促销结束时间" value="<?php echo date('2016-12-31')?>">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>用户积分</label>
			                            <div class="controls">
			                                <input type="text" name="integral" class="m-wrap span8 required number" placeholder="100积分抵1块钱,0代表不抵，不使用"  value="0"/>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>减库存方式</label>
			                            <div class="controls">
			                            	<label class="radio">
			                                	<input type="radio" class="m-wrap required" name="minus_stock" value="1" checked="checked"/>拍下减库存
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="minus_stock" value="2"/>付款减库存
			                                </label>
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>浏览量</label>
			                            <div class="controls">
			                                <input type="text" name="tour_count" class="m-wrap span8 required number" placeholder="浏览量" value="0">
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>销售数量</label>
			                            <div class="controls">
			                                <input type="text" name="sale_count" class="m-wrap span8 required number" placeholder="销售数量" value="0">
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>库存</label>
			                            <div class="controls">
			                                <input type="text" name="in_stock" class="m-wrap span8 required number" placeholder="库存">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>排序</label>
			                            <div class="controls">
			                                <input type="text" name="sort_order" class="m-wrap span8 required number" placeholder="排序">
			                            </div>
			                        </div>
			                        <div class="control-group add-goods-related-html">
			                            <label class="control-label">关联产品</label>
			                            <div class="controls">
			                                <input type="text" name="related_goods_id" class="m-wrap span8 tooltips related_goods_id" placeholder="关联产品Id" data-original-title="双击可弹框选择关联产品" data-trigger="hover"  autocomplete="off" />
			                            </div>
			                        </div>
	                          </div>
	                     </div>
	                </div>
			        <div id="tab_3" class="tab-pane">
	                    <div class="row-fluid">
	                         <div class="span10 booking-search">
	                           <?php if($attribute_group->num_rows()>0):?>
	                           <?php foreach ($attribute_group->result() as $val):?>
	                           <?php $attribute_value = $this->mall_attribute_value->getAttrbuteValue($val->group_id,$val->attr_set_id);?>
	                           <?php if($attribute_value->num_rows()>0):?>
		                           <div class="alert alert-success"><?php echo $val->group_name;?></div>
		                           <?php foreach ($attribute_value->result() as $item):?>
			                           <div class="control-group ">
				                            <label class="control-label"><?php if($item->values_required==1):?><em>* </em><?php endif;?><?php echo $item->attr_name;?></label>
				                            <div class="controls <?php if($item->attr_type=='date'):?>date<?php endif;?>">
				                                <?php if($item->attr_type=='text'):?>
				                                <input type="text" name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" class="m-wrap span8 <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="<?php echo $item->attr_name;?>" attr_value_id="<?php echo $item->attr_value_id;?>">
				                                <?php endif;?>
				                                <?php if($item->attr_type=='textarea'):?>
				                                <textarea name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" rows="3" class="m-wrap span8 <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="<?php echo $item->attr_name;?>"></textarea>
				                                <?php endif;?>
				                                <?php if($item->attr_type=='boolean'):?>
				                                <label class="radio">
			                                	  	<input type="radio" class="m-wrap <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" value="1" checked="checked"/>是
			                                	</label>
				                                <label class="radio">
				                                	<input type="radio" class="m-wrap <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" value="0"/>否
				                                </label>
				                                <?php endif;?>
				                                <?php if($item->attr_type=='date'):?>
				                                <input type="text" name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" class="m-wrap span8 date-picker <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="<?php echo $item->attr_name;?>" attr_value_id="<?php echo $item->attr_value_id;?>"/>
				                                <?php endif;?>
				                                
				                                <?php if($item->attr_type=='select') :?>
				                                <?php if(!empty($item->attr_values)):?>
				                                <?php $selectValue = explode(',',$item->attr_values)?>
				                                <?php if($item->attr_spec==2):?>
				                                <select class="m-wrap span2 <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]">
				                                    <?php foreach ($selectValue as $attr_values) :?>
				                                    <option value="<?php echo $attr_values;?>"><?php echo $attr_values;?></option>
				                                    <?php endforeach;?>
				                                </select>
				                                <input type="text" name="price[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" class="m-wrap span2 number <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="价格" title="请输入价格" value="0" attr_value_id="<?php echo $item->attr_value_id;?>">
				                                <input type="text" name="attrNum[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" class="m-wrap span2 number <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="属性数量" value="1000" title="请输入属性数量" attr_value_id="<?php echo $item->attr_value_id;?>">
	                                            <input type="text" name="attrStock[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]" class="m-wrap span2 number <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="库存数量" value="1000" title="请输入库存数量" attr_value_id="<?php echo $item->attr_value_id;?>">
				                                <?php else :?>
				                                <select class="m-wrap span8 <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]">
				                                    <?php foreach ($selectValue as $attr_values) :?>
				                                    <option value="<?php echo $attr_values;?>"><?php echo $attr_values;?></option>
				                                    <?php endforeach;?>
				                                </select>
				                                <?php endif;?>
				                                <?php endif;?>
				                                <?php endif;?>
				                                
				                                <?php if($item->attr_type=='multiselect') : ?>
				                                <?php if(!empty($item->attr_values)):?>
				                                <?php $selectValue = explode(',',$item->attr_values)?>
				                                <?php if($item->attr_spec==2):?>
				                                <table class="table span8 table-striped table-bordered table-hover">
					                                <tr>
						                                <td>属性值</td>
						                                <td><span class="span4">价格</span><span class="span4">属性数量</span><span class="span4">库存数量</span></td>
					                                </tr>
					                                <?php $j=0;?>
					                                <?php foreach ($selectValue as $attr_values):?>
					                                <tr>
		    			                                <td  class="span6">
		                                                    <input type="checkbox" value="<?php echo $attr_values;?>" name="attr[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>][<?php echo $j;?>]" checked="checked"/><?php echo $attr_values;?>
		                                                </td>
		                                                <td  class="span8">
		                                                    <input type="text" name="price[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>][<?php echo $j;?>]" class="m-wrap span4 number " placeholder="价格" value="0" title="请输入价格" attr_value_id="<?php echo $item->attr_value_id;?>">
		                                                    <input type="text" name="attrNum[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>][<?php echo $j;?>]" class="m-wrap span4 number " placeholder="属性数量" value="1000" title="请输入属性数量" attr_value_id="<?php echo $item->attr_value_id;?>">
		                                                    <input type="text" name="attrStock[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>][<?php echo $j;?>]" class="m-wrap span4 number " placeholder="库存数量" value="1000" title="请输入库存数量" attr_value_id="<?php echo $item->attr_value_id;?>">
		                                                </td>
		                                            </tr>
		                                            <?php $j++;?>
					                                <?php endforeach;?>
				                                </table>
				                                <?php else :?>
				                                <?php foreach ($selectValue as $attr_values):?>
				                                <label class="checkbox">
	                                                <input type="checkbox" class="<?php if($item->values_required==1):?>required<?php endif;?>" value="<?php echo $attr_values;?>" name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>][]" checked="checked"/><?php echo $attr_values;?>
	                                            </label>
	                                            <?php endforeach;?>
				                                <?php endif;?>
				                                <?php endif;?>
				                                <?php endif;?>
				                            </div>
			                           </div>
		                           <?php endforeach;?>
	                           <?php endif;?>
	                           <?php endforeach;?>
	                           <?php endif;?>
			                 </div>
			            </div>
			        </div>
			        <div id="tab_4" class="tab-pane">
			        	<div class="control-group">
	                        <label class="control-label"><em>* </em>配送地址</label>
	                        <div class="controls">
	                            <?php $this->load->view('commonhtml/districtSelect'); ?>
	                        </div>
	                    </div>
	                    <div class="control-group ">
	                        <label class="control-label"> 详细地址</label>
	                        <div class="controls">
	                            <input type="text" class="m-wrap span8 required" placeholder="用于根据地址搜索您的产品" name="address" />
	                        </div>
	                    </div>
	                    <div class="control-group">
	                        <label class="control-label"><em>* </em>支付方式</label>
	                        <div class="controls">
	                            <label class="checkbox">
	                                 <input type="checkbox" class="required" value="1" name="payments[]" checked="checked"/>在线支付
	                            </label>
	                            <label class="checkbox">
	                                 <input type="checkbox" class="required" value="2" name='payments[]'/>货到付款
	                            </label>
	                        </div>
	                    </div>
	                    <div class="control-group">
	                        <label class="control-label">运费</label>
	                        <div class="controls transport">
	                             <label class="checkbox">
	                                 <input type="radio" value="1" name="transport_type"/>
	                             </label>
	                             <select name="freight_id" id="freight_id" class="medium" style="display:none;">
	                             </select>
	                             <label class="checkbox">使用运费模板</label>
	                        </div>
	                    </div>
	                    <div class="control-group">
	                         <label class="control-label"></label>
	                         <div class="controls transport">
	                             <label class="checkbox">
	                                 <input type="radio" value="2" name="transport_type"  checked="checked"/>
	                             </label>
	                             <input type="text" name="freight_cost" id="freight_cost" class="required" />
	                             <label class="checkbox">自定义运费价格</label>
	                         </div>
	                    </div>
	                    <div class="form-actions">
	                         <button class="btn green step4" type="submit"><i class="icon-ok"></i> 保存</button>
	                         <a class="btn step3" href="<?php echo base_url('mall_goods_base/addstep1')?>">返回上一步</a>
	                    </div>
			        </div>
			    </div>
		    </div>
		</form>
    </div>
</div>
 
<?php $this->load->view('layout/footer');?>
<?php $this->load->view('user/addSupplierUid/ajaxGetUser'); ?>
<?php $this->load->view('mall_goods_base/addGoodBase/ajaxGetGoods');?>
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