<?php if (!empty($attrValues)) : ?>
    <?php foreach ($attrValues as $group) : ?>
        <div class="alert alert-success"><?php echo $group['group_name'];?></div>
        <?php foreach ($group['attr_value'] as $key=>$attrValue) : ?>
            <?php if ($attrValue->attr_type == 'text') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <input type="text" name="attr_value[<?php echo $group['group_name'];?>][<?php echo $key;?>]" class="m-wrap span12<?php if($attrValue->values_required==1):?> required<?php endif;?>">
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'textarea') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <textarea name="attr_value[<?php echo $group['group_name'];?>][<?php echo $key;?>]" rows="2" class="m-wrap span12<?php if($attrValue->values_required==1):?> required<?php endif;?>"></textarea>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'boolean') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <?php $attrValues = explode(',', $attrValue->attr_values); ?>
                        <?php foreach ($attrValues as $k=>$v) :?>
                            <label class="radio">
                                <input type="radio" name="attr_value[<?php echo $group['group_name'];?>][<?php echo $key;?>]" value="<?php echo $v;?>" <?php if($k == 0):?>checked="checked"<?php endif;?> class="m-wrap"/><?php echo $v;?>
                            </label>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'date') : ?>
                <div class="control-group">
                    <label class="control-label"><?php if($attrValue->values_required==1):?><em>* </em><?php endif;?><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
                            <input type="text" name="attr_value[<?php echo $group['group_name'];?>][<?php echo $key;?>]" size="16" class="m-wrap date-picker"><span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'multiselect') : ?>
                <div class="control-group">
                    <label class="control-label"><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <?php $attrValues = explode(',', $attrValue->attr_values); ?>
                        <?php foreach ($attrValues as $key=>$value) :?>
                            <label class="checkbox">
                                <input type="checkbox" name="attr_spec[]" class="m-wrap" value="<?php echo $value;?>"/><?php echo $value;?>
                            </label>
                        <?php endforeach;?>
                    </div>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endforeach; ?>
<?php endif; ?>