<?php
    $oldAttrSpec  = json_decode($mallGoodsBase->attr_spec, TRUE);
    $oldAttrValue = json_decode($mallGoodsBase->attr_value, TRUE);
?>
<?php if (!empty($attrValues)) : ?>
    <?php foreach ($attrValues as $group) : ?>
        <div class="alert alert-success">
            <?php echo $group['group_name'];?>
            <input type="hidden" name="attr_value[<?php echo $group['group_id'];?>][group_name]" value="<?php echo $group['group_name'];?>">
        </div>
        <?php foreach ($group['attr_value'] as $key=>$attrValue) : ?>
            <?php if ($attrValue->attr_type == 'text') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <input type="text" name="attr_value[<?php echo $group['group_id'];?>][group_value][<?php echo $key ?>]" value="<?php echo isset($oldAttrValue[$group['group_id']]['group_value'][$key]) ? $oldAttrValue[$group['group_id']]['group_value'][$key] : '' ?>" class="m-wrap span12<?php if($attrValue->values_required==1):?> required<?php endif;?>">
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'textarea') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <textarea name="attr_value[<?php echo $group['group_id'];?>][group_value][<?php echo $key ?>]" rows="2" class="m-wrap span12<?php if($attrValue->values_required==1):?> required<?php endif;?>">
                            <?php echo isset($oldAttrValue[$group['group_id']]['group_value'][$key]) ? $oldAttrValue[$group['group_id']]['group_value'][$key] : '' ?>
                        </textarea>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'boolean') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <?php $attrValues = explode(',', $attrValue->attr_values); ?>
                        <?php foreach ($attrValues as $k=>$v) :?>
                            <label class="radio">
                                <input type="radio" name="attr_value[<?php echo $group['group_id'];?>][group_value][<?php echo $key ?>]" value="<?php echo $v;?>" <?php if($k == 0):?>checked="checked"<?php endif;?> class="m-wrap"/><?php echo $v;?>
                            </label>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'date') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
                            <input type="text" name="attr_value[<?php echo $group['group_id'];?>][group_value][<?php echo $key ?>]" value="<?php echo isset($oldAttrValue[$group['group_id']]['group_value'][$key]) ? $oldAttrValue[$group['group_id']]['group_value'][$key] : '' ?>" size="16" class="m-wrap date-picker"><span class="add-on"><i class="icon-calendar"></i></span>
                        </div><?php echo $v;?>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'select') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <?php $attrValues = explode(',', $attrValue->attr_values); ?>
                        <select name="attr_value[<?php echo $group['group_id'];?>][group_value][<?php echo $key ?>]" class="m-wrap span12 <?php if($attrValue->values_required==1):?> required<?php endif;?>">
                            <option>请选择</option>
                            <?php foreach ($attrValues as $v) :?>
                                <option value="<?php echo $v;?>" <?php if (isset($oldAttrValue[$group['group_id']]['group_value'][$key]) && $oldAttrValue[$group['group_id']]['group_value'][$key] = $v) : ?> selected="selected"<?php endif ?>><?php echo $v;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'multiselect') : ?>
                <div class="control-group">
                    <label class="control-label">
                        <?php echo $attrValue->attr_name ?>
                        <input type="hidden" name="attr_spec[<?php echo $attrValue->attr_value_id;?>][spec_name]" value="<?php echo $attrValue->attr_name ?>">
                    </label>
                    <div class="controls">
                        <?php $attrValues = explode(',', $attrValue->attr_values); ?>
                        <?php foreach ($attrValues as $k=>$v) :?>
                            <label class="checkbox">
                                <input type="checkbox" name="attr_spec[<?php echo $attrValue->attr_value_id;?>][spec_value][<?php echo $k;?>]" value="<?php echo $v;?>" <?php if (isset($oldAttrSpec[$attrValue->attr_value_id]['spec_value'][$k]) && $oldAttrSpec[$attrValue->attr_value_id]['spec_value'][$k] == $v) :?> checked="checked"<?php endif; ?>class="m-wrap"/><?php echo $v;?>
                            </label>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endforeach; ?>
<?php endif; ?>