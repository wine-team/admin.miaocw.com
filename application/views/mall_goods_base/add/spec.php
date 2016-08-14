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
                <div class="control-group">
                    <label class="control-label">Default Dropdown(Multiple)</label>
                    <div class="controls">
                        <select class="span6 m-wrap" multiple="multiple" data-placeholder="Choose a Category" tabindex="1">
                            <option value="Category 1">Category 1</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 5</option>
                            <option value="Category 4">Category 4</option>
                            <option value="Category 3">Category 6</option>
                            <option value="Category 4">Category 7</option>
                            <option value="Category 3">Category 8</option>
                            <option value="Category 4">Category 9</option>
                        </select>
                    </div>
                </div>
            <?php elseif ($attrValue->attr_type == 'date') : ?>
                <div class="control-group">
                    <label class="control-label"><?php echo $attrValue->attr_name ?></label>
                    <div class="controls">
                        <div class="input-append date date-picker" data-date-format="yyyy-mm-dd">
                            <input type="text" size="16" value="" class="m-wrap date-picker"><span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </div>
                </div>
            <?php endif;?>
        <?php endforeach;?>
    <?php endforeach; ?>
<?php endif; ?>