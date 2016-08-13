<?php if (!empty($attrValues)) : ?>
    <?php foreach ($attrValues as $group) : ?>
        <div class="alert alert-success"><?php echo $group['group_name'];?></div>
        <?php foreach ($group['attr_value'] as $attrValue) : ?>
            <?php if ($attrValue->attr_type == 'text') : ?>
                <div class="control-group">
                    <label class="control-label"><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <input type="text" name="attr_type" value="" class="m-wrap span12<?php if($attrValue->values_required==1):?> required<?php endif;?>">
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'textarea') : ?>
                <div class="control-group">
                    <label class="control-label"><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <textarea rows="2" class="m-wrap span12<?php if($attrValue->values_required==1):?> required<?php endif;?>"></textarea>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'boolean') : ?>
                <div class="control-group">
                    <label class="control-label"><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <label class="radio">
                            <input type="radio" class="m-wrap" name="attr[1]" value="1" checked="checked"/>是
                        </label>
                        <label class="radio">
                            <input type="radio" class="m-wrap" name="attr[1]" value="0"/>否
                        </label>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'multiselect') : ?>

            <?php elseif ($attrValue->attr_type == 'date') : ?>

            <?php endif;?>
        <?php endforeach;?>
    <?php endforeach; ?>
<?php endif; ?>