<div class="control-group">
    <label class="control-label"><em>* </em>配送地址</label>
    <div class="controls">
        <?php $this->load->view('commonhtml/districtSelect'); ?>
    </div>
</div>
<div class="control-group ">
    <label class="control-label"> 详细地址</label>
    <div class="controls">
        <input type="text" name="address" value="<?php echo trim(mb_strrchr($mallGoodsBase->address, ' ')) ? trim(mb_strrchr($mallGoodsBase->address, ' ')) : $mallGoodsBase->address; ?>" class="m-wrap span8 required" placeholder="用于根据地址搜索您的产品" />
    </div>
</div>
<div class="control-group">
    <label class="control-label">运费</label>
    <?php if ($freightTpl->num_rows() > 0): ?>
        <div class="controls transport">
            <label class="checkbox">
                <input type="radio" value="1" name="freight_type" <?php if ($mallGoodsBase->freight_id != 0): ?>checked="checked"<?php endif; ?> data-key="<?php echo $mallGoodsBase->freight_id ?>"/>
            </label>
            <select name="freight_id" id="freight_id" class="required" <?php if ($mallGoodsBase->freight_id == 0): ?>style="display: none"<?php endif; ?>>
                <?php foreach ($freightTpl->result() as $item): ?>
                    <option value="<?php echo $item->freight_id ?>" <?php if ($item->freight_id == $mallGoodsBase->freight_id): ?>selected="selected"<?php endif; ?> ><?php echo $item->name ?></option>
                <?php endforeach; ?>
            </select>
            <label class="checkbox">使用运费模板</label>
        </div>
    <?php endif; ?>
</div>
<div class="control-group">
    <label class="control-label"></label>
    <div class="controls transport">
        <label class="checkbox">
            <input type="radio" value="2" name="freight_type" <?php if ($mallGoodsBase->freight_id == 0): ?>checked="checked"<?php endif; ?>/>
        </label>
        <input type="text" name="freight_cost" value="<?php echo $mallGoodsBase->freight_cost ?>" id="freight_cost" class="required" <?php if ($mallGoodsBase->freight_id != 0): ?>style="display: none"<?php endif; ?>/>
        <label class="checkbox">自定义运费价格</label>
    </div>
</div>