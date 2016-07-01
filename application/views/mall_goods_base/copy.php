<?php $this->load->view('layout/header'); ?>
<div class="container-fluid mall-goods-add-step2">
    <div class="row-fluid">
        <div class="span12">
            <h3 class="page-title">趣网商城 <small> 商品编辑</small></h3>
            <?php echo breadcrumb(array('mall_goods_base/grid' => '趣网产品', "mall_goods_base/edit/".$mallgoods->goods_id.'?attr_set_id='.$mallgoods->attribute_set_id => '商品编辑')); ?>
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
               <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">基本信息</a></li>
                    <li><a href="#tab_2" data-toggle="tab">销售信息</a></li>
                    <li><a href="#tab_3" data-toggle="tab">属性信息</a></li>
                    <li><a href="#tab_4" data-toggle="tab">运费信息</a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active"  id="tab_1">
					    <div class="portlet box green">
							<div class="portlet-title">
								 <div class="caption"><i class="icon-reorder"></i>商品基本信息</div>
							     <div class="tools">
			                        <a class="collapse" href="javascript:;"></a>
			                        <a class="remove" href="javascript:;"></a>
			                     </div>
							 </div>
                             <div class="portlet-body form">
                                    <div class="control-group" >
			                            <label class="control-label">商品分类</label>
			                            <div class="controls">
			                                <select data-placeholder="输入商品分类"  name="category_id[]" class="chosen span12 m-wrap category-edit-select required" multiple="multiple" tabindex="6">
			                                    <?php foreach ($category as $key=>$item):?>
			                                    <optgroup label="<?php echo $item['cat_name'];?>">
			                                        <?php foreach ($item['childCat'] as $i=>$jitem):?>
			                                        <option value="<?php echo $jitem['cat_id']?>"><?php echo $jitem['cat_name']?></option>
			                                        <?php endforeach;?>
			                                    </optgroup>
			                                    <?php endforeach;?>
			                                </select>
			                            </div>
                                    </div>
                                    <div class="control-group">
										<label class="control-label"><em>* </em>商品属性</label>
			                            <div class="controls">
			                                <select name="attribute_set_id" class="span12 m-wrap valid" readonly="readonly">
			                                    <?php foreach ($attribute->result() as $key=>$value) : ?>
			                                        <option value="<?php echo $value->attr_set_id;?>" <?php if($value->attr_set_id==$mallgoods->attribute_set_id):?>selected="selected"<?php endif;?>><?php echo $value->attr_set_name;?></option>
			                                    <?php endforeach;?>
			                                </select>
			                            </div>
									</div>
									<div class="control-group">
										<label class="control-label"><em>* </em>商品类别</label>
			                            <div class="controls">
			                                <select name="extension_code" class="span12 m-wrap valid">
			                                    <?php foreach ($extension as $key=>$val) : ?>
			                                        <option value="<?php echo $key;?>" <?php if( $key==$mallgoods->extension_code ):?>selected="selected"<?php endif;?>><?php echo $val;?></option>
			                                    <?php endforeach;?>
			                                </select>
			                            </div>
									</div>
									<div class="control-group">
			                            <label class="control-label"><em>* </em>商品名称</label>
			                            <div class="controls">
			                                <input type="text" class="m-wrap span12 required" placeholder="商品名称" name="goods_name" value="<?php echo $mallgoods->goods_name;?>" />
			                            </div>
	                        		</div>
									<div class="control-group">
			                            <label class="control-label"><em>* </em>商品编号</label>
			                            <div class="controls">
			                                <input type="text" class="m-wrap span12 required" placeholder="商品编号" name="goods_sku" value="<?php echo $mallgoods->goods_sku;?>"/>
			                            </div>
				                    </div>
									<div class="control-group">
					                    <label class="control-label">商品品牌</label>
					                    <div class="controls">
			                                <select name="brand_id" class="m-wrap span12">
			                                    <option value="0">请选择</option>
			                                    <?php if ($brand->num_rows() > 0) : ?>
			                                        <?php foreach ($brand->result() as $item) : ?>
			                                            <option value="<?php echo $item->brand_id ?>" <?php if($item->brand_id==$mallgoods->brand_id):?>selected="selected"<?php endif;?>><?php echo $item->brand_name ?></option>
			                                        <?php endforeach; ?>
			                                    <?php endif; ?>
		                                    </select>
				                        </div>
				                    </div>
									<div class="control-group ">
			                            <label class="control-label"><em>* </em>净重（kg）</label>
			                            <div class="controls">
			                                <input type="text" name="goods_weight" class="m-wrap span12 required number" placeholder="重量(kg)" value="<?php echo $mallgoods->goods_weight;?>"/>
			                            </div>
			                        </div>
									<div class="control-group">
			                            <label class="control-label"><em>* </em>商品简介</label>
			                            <div class="controls">
			                                <textarea name="goods_brief" rows="4" class="m-wrap span12 required" placeholder="商品简介"><?php echo $mallgoods->goods_brief;?></textarea>
			                            </div>
			                        </div>
									<div class="control-group add-supplieruid-html">
			                            <label class="control-label"><em>* </em>供应商</label>
			                            <div class="controls">
			                                <input type="text" name="supplier_id" placeholder="供应商UID" class="m-wrap span12 supplieruid required tooltips" data-original-title="双击可弹框选择供应商；直接输入‘用户名称或编号’可提示" data-trigger="hover"  autocomplete="off" value="<?php echo $mallgoods->supplier_id;?>">
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>审核状态</label>
			                            <div class="controls">
			                                <select class="m-wrap span12 number required" name="is_check">
			                                    <option value="1" selected="selected">未审核</option>
			                                    <option value="2">审核通过</option>
			                                    <option value="3">审核拒绝</option>
			                                </select>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>上下架</label>
			                            <div class="controls">
			                                <select class="m-wrap span12 required" name="is_on_sale">
			                                    <option value="1">上架</option>
                                    			<option value="2"  selected="selected">下架</option>
			                                </select>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>pc商品详情</label>
			                            <div class="controls">
			                                <textarea name="goods_desc"  class="textarea-multipart-edit m-wrap span12 required" placeholder="pc商品详情"><?php echo $mallgoods->goods_desc;?></textarea>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>wap商品详情</label>
			                            <div class="controls">
			                                <textarea name="wap_goods_desc" class="textarea-multipart-edit m-wrap span12 required" placeholder="wap商品详情"><?php echo $mallgoods->wap_goods_desc;?></textarea>
			                            </div>
			                        </div>
									<div class="form-actions">
	                         			<button class="btn green step4" type="submit"><i class="icon-ok"></i> 保存</button>
	                         			<a class="btn step3" href="<?php echo base_url('mall_goods_base/addstep1')?>">返回上一步</a>
	                    			</div>
							 </div>
						</div>
					</div>
					<div class="tab-pane"  id="tab_2">
					    <div class="portlet box green">
							 <div class="portlet-title">
								 <div class="caption"><i class="icon-reorder"></i>商品销售信息</div>
							     <div class="tools">
			                        <a class="collapse" href="javascript:;"></a>
			                        <a class="remove" href="javascript:;"></a>
			                     </div>
							 </div>
							 <div class="portlet-body form">
						         <div class="control-group">
		                             <label class="control-label">市场价格</label>
		                             <div class="controls">
		                                 <input type="text" name="market_price" class="m-wrap span12 required number" placeholder="市场价格" value="<?php echo $mallgoods->market_price;?>" />
		                             </div>
		                         </div>
		                         <div class="control-group">
			                            <label class="control-label"><em>* </em>供应价</label>
			                            <div class="controls">
			                                <input type="text" name="shop_price" class="m-wrap span12 required number" placeholder="供应价" value="<?php echo $mallgoods->shop_price;?>">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>促销价</label>
			                            <div class="controls">
			                                <input type="text" name="promote_price" class="m-wrap span12 required number" placeholder="促销价" value="<?php echo $mallgoods->promote_price;?>">
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>购买频率限制</label>
			                            <div class="controls">
			                            	<label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="0" <?php if(0==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>不限
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="1" <?php if(1==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>天
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="2" <?php if(2==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>周
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="3" <?php if(3==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>月
			                                </label>	
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="booking_limit" value="4" <?php if(4==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>年
			                                </label>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>限制购买数量</label>
			                            <div class="controls">
			                                <input type="text" name="limit_num" class="m-wrap span12 required" placeholder="限制购买数量 ,0代表不限制" value="<?php echo $mallgoods->booking_limit;?>">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>促销开始时间</label>
			                            <div class="controls">
			                                <input type="text" name="promote_start_date" class="m-wrap span12 required date-picker date" placeholder="促销开始时间" value="<?php echo date('Y-m-d',strtotime($mallgoods->promote_start_date));?>">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>促销结束时间</label>
			                            <div class="controls">
			                                <input type="text" name="promote_end_date" class="m-wrap span12 required date-picker date" placeholder="促销结束时间" value="<?php echo date('Y-m-d',strtotime($mallgoods->promote_end_date));?>">
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>用户积分</label>
			                            <div class="controls">
			                                <input type="text" name="integral" class="m-wrap span12 required number" placeholder="100积分抵1块钱,0代表不抵，不使用"  value="<?php echo $mallgoods->integral;?>"/>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>减库存方式</label>
			                            <div class="controls">
			                            	<label class="radio">
			                                	<input type="radio" class="m-wrap required" name="minus_stock" value="1" <?php if(1==$mallgoods->minus_stock):?>checked="checked"<?php endif;?>/>拍下减库存
			                                </label>
			                                <label class="radio">
			                                	<input type="radio" class="m-wrap required" name="minus_stock" value="2" <?php if(2==$mallgoods->minus_stock):?>checked="checked"<?php endif;?>/>付款减库存
			                                </label>
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>浏览量</label>
			                            <div class="controls">
			                                <input type="text" name="tour_count" class="m-wrap span12 required number" placeholder="浏览量" value="<?php echo $mallgoods->tour_count;?>"/>
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>销售数量</label>
			                            <div class="controls">
			                                <input type="text" name="sale_count" class="m-wrap span12 required number" placeholder="销售数量" value="<?php echo $mallgoods->sale_count;?>" />
			                            </div>
			                        </div>
			                        <div class="control-group">
			                            <label class="control-label"><em>* </em>库存</label>
			                            <div class="controls">
			                                <input type="text" name="in_stock" class="m-wrap span12 required number" placeholder="库存" value="<?php echo $mallgoods->in_stock;?>"/>
			                            </div>
			                        </div>
			                        <div class="control-group ">
			                            <label class="control-label"><em>* </em>排序</label>
			                            <div class="controls">
			                                <input type="text" name="sort_order" class="m-wrap span12 required number" placeholder="排序" value="<?php echo $mallgoods->sort_order;?>" />
			                            </div>
			                        </div>
			                        			                        
			                        <div class="control-group add-goods-related-html">
			                            <label class="control-label">关联产品</label>
			                            <div class="controls">
			                                <input type="text" name="related_goods_id" class="m-wrap span12 tooltips related_goods_id" placeholder="关联产品Id" data-original-title="双击可弹框选择关联产品" data-trigger="hover"  autocomplete="off" value="<?php echo count($related_goods) > 0 ? implode(',',$related_goods):'';?>" />
			                            </div>
			                        </div>
			                        
		                            <div class="form-actions">
	                         			<button class="btn green step4" type="submit"><i class="icon-ok"></i> 保存</button>
	                         			<a class="btn step3" href="<?php echo base_url('mall_goods_base/addstep1')?>">返回上一步</a>
	                    			</div>
					          </div>
					    </div>
					 </div>
					 <div class="tab-pane"  id="tab_3">
					    <div class="portlet box green">
					          <div class="portlet-title">
								 <div class="caption"><i class="icon-reorder"></i>商品属性信息</div>
							     <div class="tools">
			                        <a class="collapse" href="javascript:;"></a>
			                        <a class="remove" href="javascript:;"></a>
			                     </div>
							  </div>
							  <div class="portlet-body form">
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
	                               <div class="form-actions">
	                         			<button class="btn green step4" type="submit"><i class="icon-ok"></i>保存</button>
	                         			<a class="btn step3" href="<?php echo base_url('mall_goods_base/addstep1')?>">返回上一步</a>
	                    		   </div>
							  </div>
					    </div>
					 </div>
					 <div class="tab-pane"  id="tab_4">
					    <div class="portlet box green">
					        <div class="portlet-title">
								 <div class="caption"><i class="icon-reorder"></i>商品运费信息</div>
							     <div class="tools">
			                        <a class="collapse" href="javascript:;"></a>
			                        <a class="remove" href="javascript:;"></a>
			                     </div>
							</div>
							<div class="portlet-body form">
							    <div class="control-group">
			                        <label class="control-label"><em>* </em>配送地址</label>
			                        <div class="controls">
			                            <?php $this->load->view('commonhtml/districtSelect'); ?>
			                        </div>
			                    </div>
			                    <div class="control-group ">
			                        <label class="control-label"> 详细地址</label>
			                        <div class="controls">
			                            <input type="text" class="m-wrap span8 required" placeholder="用于根据地址搜索您的产品" name="address" value="<?php echo trim(mb_strrchr($mallgoods->address, ' ')); ?>"/>
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
			                    <div class="control-group search-choice">
			                        <label class="control-label">运费</label>
			                        <div class="controls transport">
			                             <label class="checkbox">
			                                 <input type="radio" value="1" name="transport_type" class="<?php if($mallgoods->freight_id>0):?>required<?php endif;?>" <?php if($mallgoods->freight_id>0):?>checked="checked"<?php endif;?>/>
			                             </label>
			                             <select name="freight_id" id="freight_id" class="medium <?php if($mallgoods->freight_id>0):?>required<?php endif;?>" <?php if($mallgoods->freight_id==0):?>style="display:none;"<?php endif;?>>
			                                   <?php if($freight->num_rows()>0):?>
			                                   <?php foreach($freight->result() as $item):?>
			                                      <option value="<?php echo $item->freight_id;?>" <?php if($item->freight_id==$mallgoods->freight_id):?>selected="selected"<?php endif;?>><?php echo $item->name;?></option>  
			                                   <?php endforeach;?>
			                                   <?php endif;?>
			                             </select>
			                             <label class="checkbox">使用运费模板</label>
			                        </div>
			                    </div>
			                    <div class="control-group">
			                         <label class="control-label"></label>
			                         <div class="controls transport">
			                             <label class="checkbox">
			                                 <input type="radio" value="2" name="transport_type" class="<?php if($mallgoods->freight_id==0):?>required<?php endif;?>"    <?php if($mallgoods->freight_id==0):?>checked="checked"<?php endif;?> />
			                             </label>
			                             <input type="text" name="freight_cost" id="freight_cost" class="<?php if($mallgoods->freight_id==0):?>required<?php endif;?>" <?php if($mallgoods->freight_id>0):?>style="display:none;"<?php endif;?>  value="<?php echo $mallgoods->freight_cost;?>"/>
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
				 </div>
			  </form>  
           </div>
        </div>
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