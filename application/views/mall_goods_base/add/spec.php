<?php if($attributeGroup->num_rows()>0):?>
    <?php foreach ($attributeGroup->result() as $val):?>
        <?php $attribute_value = $this->mall_attribute_value->getAttrbuteValue($val->group_id,$val->attr_set_id);?>
        <?php if($attribute_value->num_rows()>0):?>
            <div class="alert alert-success"><?php echo $val->group_name;?></div>
            <?php foreach ($attribute_value->result() as $item):?>
                <div class="control-group <?php if($item->attr_spec==2) echo 'attrSpec2';?>">
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
                                <select class="m-wrap span8 <?php if($item->values_required==1):?>required<?php endif;?>" name="attr[1][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>]">
                                    <?php foreach ($selectValue as $attr_values) :?>
                                        <option value="<?php echo $attr_values;?>"><?php echo $attr_values;?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif;?>
                        <?php endif;?>

                        <?php if($item->attr_type=='multiselect') : ?>
                            <?php if(!empty($item->attr_values)):?>
                                <?php $selectValue = explode(',',$item->attr_values)?>
                                <?php if($item->attr_spec==2):?>
                                    <?php foreach ($selectValue as $attr_values):?>
                                        <label class="checkbox">
                                            <input type="checkbox" class="required" value="<?php echo $attr_values;?>" name="attr[2][<?php echo $item->group_id?>][<?php echo $item->attr_value_id;?>][]" checked="checked"/><?php echo $attr_values;?>
                                        </label>
                                    <?php endforeach;?>
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