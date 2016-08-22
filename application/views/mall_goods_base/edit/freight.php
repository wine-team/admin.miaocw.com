<div class="control-group">
    <label class="control-label"><em>* </em>配送地址</label>
    <div class="controls">
        <?php $this->load->view('commonhtml/districtSelect'); ?>
    </div>
</div>
<div class="control-group ">
    <label class="control-label"> 详细地址</label>
    <div class="controls">
        <input type="text" name="address" value="<?php echo $mallGoodsBase->address ?>" class="m-wrap span8 required" placeholder="用于根据地址搜索您的产品" />
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