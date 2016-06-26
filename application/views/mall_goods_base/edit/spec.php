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
                            <div class="controls <?php if($item->attr_type=='date')echo 'date';?>">

                                <?php if($item->attr_type=='text'):?>
                                    <?php foreach($attr_value as $goods_attr_val) :?>
                                        <?php if($item->attr_value_id==$goods_attr_val->attr_value_id) : ?>
                                            <input type="text" name="attr[1][<?php echo $goods_attr_val->goods_attr_id?>]" class="m-wrap span8 <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="<?php echo $item->attr_name;?>" value="<?php echo $goods_attr_val->attr_value;?>" attr_value_id="<?php echo $item->attr_value_id;?>">
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>

                                <?php if($item->attr_type=='textarea'):?>
                                    <?php foreach($attr_value as $goods_attr_val) :?>
                                        <?php if($item->attr_value_id==$goods_attr_val->attr_value_id) : ?>
                                            <textarea name="attr[1][<?php echo $goods_attr_val->goods_attr_id?>]" rows="3" class="m-wrap span8 <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="<?php echo $item->attr_name;?>"><?php if($item->attr_value_id==$goods_attr_val->attr_value_id)echo $goods_attr_val->attr_value;?></textarea>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>

                                <?php if($item->attr_type=='boolean'):?>
                                    <?php foreach($attr_value as $goods_attr_val) :?>
                                        <?php if($item->attr_value_id==$goods_attr_val->attr_value_id) : ?>
                                            <label class="radio">
                                                <input type="radio" class="m-wrap <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[1][<?php echo $goods_attr_val->goods_attr_id?>]" value="1" <?php if($goods_attr_val->attr_value==1)echo 'checked="checked"';?>/>是
                                            </label>
                                            <label class="radio">
                                                <input type="radio" class="m-wrap <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[1][<?php echo $goods_attr_val->goods_attr_id?>]" value="0" <?php if($goods_attr_val->attr_value==0)echo 'checked="checked"';?>/>否
                                            </label>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>

                                <?php if($item->attr_type=='date'):?>
                                    <?php foreach($attr_value as $goods_attr_val) :?>
                                        <?php if($item->attr_value_id==$goods_attr_val->attr_value_id) : ?>
                                            <input type="text" name="attr[1][<?php echo $goods_attr_val->goods_attr_id?>]" class="m-wrap span8 date-picker <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="<?php echo $item->attr_name;?>" value="<?php echo $goods_attr_val->attr_value;?>" attr_value_id="<?php echo $item->attr_value_id;?>">
                                        <?php endif;?>
                                    <?php endforeach;?>
                                <?php endif;?>

                                <?php if($item->attr_type=='select') :?>
                                    <?php if(!empty($item->attr_values)):?>
                                        <?php $selectValue = explode(',',$item->attr_values)?>
                                        <?php if($item->attr_spec==2):?>
                                            <?php foreach($attr_price as $goods_attr_price) :?>
                                                <?php if($goods_attr_price->attr_value_id ==$item->attr_value_id) :?>
                                                    <select class="m-wrap span2 <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[2][<?php echo $goods_attr_price->attr_price_id?>]" >
                                                        <option value="">请选择</option>
                                                        <?php foreach ($selectValue as $attr_values) :?>
                                                            <option <?php if($goods_attr_price->attr_value==$attr_values)echo 'selected="selected"'?> value="<?php echo $attr_values;?>"><?php echo $attr_values;?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <input type="text" name="price[2][<?php echo $goods_attr_price->attr_price_id?>]" class="m-wrap span2 number <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="价格" title="请输入价格" value="<?php echo $goods_attr_price->attr_price;?>" attr_value_id="<?php echo $item->attr_value_id;?>">
                                                    <input type="text" name="attrNum[2][<?php echo $goods_attr_price->attr_price_id?>]" class="m-wrap span2 number <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="属性数量" value="<?php echo $goods_attr_price->attr_num;?>" title="请输入属性数量" attr_value_id="<?php echo $item->attr_value_id;?>">
                                                    <input type="text" name="attrStock[2][<?php echo $goods_attr_price->attr_price_id?>]" class="m-wrap span2 number <?php if($item->values_required==1):?>required<?php endif;?>" placeholder="库存数量" value="<?php echo $goods_attr_price->attr_stock;?>" title="请输入库存数量" attr_value_id="<?php echo $item->attr_value_id;?>">
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        <?php else :?>
                                            <?php foreach($attr_value as $goods_attr_value) :?>
                                                <?php if($goods_attr_value->attr_value_id ==$item->attr_value_id) :?>
                                                    <select class="m-wrap span8 <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[1][<?php echo $goods_attr_val->goods_attr_id?>]">
                                                        <option value="">请选择</option>
                                                        <?php foreach ($selectValue as $attr_values) :?>
                                                            <option <?php if($goods_attr_value->attr_value==$attr_values)echo 'selected="selected"'?> value="<?php echo $attr_values;?>"><?php echo $attr_values;?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    <?php endif;?>
                                <?php endif;?>

                                <?php if($item->attr_type=='multiselect') : ?>
                                    <?php if(!empty($item->attr_values)):?>
                                        <?php $selectValue = explode(',',$item->attr_values)?>
                                        <?php if($item->attr_spec==2):?>
                                            <table class="table span8 table-striped table-bordered table-hover" style="margin-top: -30px;">
                                                <tr><td>属性值</td><td><span class="span4">价格</span><span class="span4">属性数量</span><span class="span4">库存数量</span></td></tr>
                                                <?php $j=0;?>
                                                <?php foreach ($selectValue as $attr_values):?>
                                                    <?php $attr_values_arr = array();?>
                                                    <?php foreach($attr_price as $goods_attr_price) :?>
                                                        <?php if($goods_attr_price->attr_value==$attr_values):?>
                                                            <tr>
                                                                <td  class="span6">
                                                                    <input type="text" value="<?php echo $goods_attr_price->attr_value;?>" name="attr[2][<?php echo $goods_attr_price->attr_price_id?>]" />
                                                                </td>
                                                                <td  class="span8">
                                                                    <input type="text" name="price[2][<?php echo $goods_attr_price->attr_price_id?>]" class="m-wrap span4 number " placeholder="价格" value="<?php echo $goods_attr_price->attr_price;?>" title="请输入价格" attr_value_id="<?php echo $item->attr_value_id;?>">
                                                                    <input type="text" name="attrNum[2][<?php echo $goods_attr_price->attr_price_id?>]" class="m-wrap span4 number " placeholder="属性数量" value="<?php echo $goods_attr_price->attr_num;?>" title="请输入属性数量" attr_value_id="<?php echo $item->attr_value_id;?>">
                                                                    <input type="text" name="attrStock[2][<?php echo $goods_attr_price->attr_price_id?>]" class="m-wrap span4 number " placeholder="库存数量" value="<?php echo $goods_attr_price->attr_stock;?>" title="请输入库存数量" attr_value_id="<?php echo $item->attr_value_id;?>">
                                                                </td>
                                                            </tr>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
                                                    <?php $j++;?>
                                                <?php endforeach;?>
                                            </table>
                                        <?php else :?>
                                            <?php foreach($attr_value as $goods_attr_value) {
                                                if ($item->attr_value_id == $goods_attr_value->attr_value_id) {
                                                    $checks = $goods_attr_value->attr_value;
                                                    $check_id = $goods_attr_value->goods_attr_id;
                                                }
                                            }
                                            $checks_arr = isset($checks) ? explode(',',$checks) : array();
                                            ?>
                                            <?php foreach ($selectValue as $attr_values):?>
                                                <label class="checkbox">
                                                    <input type="checkbox" class="<?php if($item->values_required==1):?>required<?php endif;?>" value="<?php echo $attr_values;?>" name="attr[1][<?php echo isset($check_id) ? $check_id : 0;?>][]" <?php if(in_array($attr_values,$checks_arr))echo 'checked="checked"';?>/><?php echo $attr_values;?>
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