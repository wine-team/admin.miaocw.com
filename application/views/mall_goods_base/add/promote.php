<div class="control-group ">
    <label class="control-label">促销价</label>
    <div class="controls">
        <input type="text" name="promote_price" class="m-wrap span12 number">
    </div>
</div>
<div class="control-group ">
    <label class="control-label">促销开始时间</label>
    <div class="controls">
        <input type="text" name="promote_start_date" class="m-wrap span12 date-picker date">
    </div>
</div>
<div class="control-group ">
    <label class="control-label">促销结束时间</label>
    <div class="controls">
        <input type="text" name="promote_end_date" class="m-wrap span12 date-picker date">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>购买频率限制</label>
    <div class="controls">
        <label class="radio">
            <input type="radio" name="booking_limit" value="0" checked="checked" class="m-wrap"/>不限
        </label>
        <label class="radio">
            <input type="radio" name="booking_limit" value="1" class="m-wrap"/>天
        </label>
        <label class="radio">
            <input type="radio" name="booking_limit" value="2" class="m-wrap"/>周
        </label>
        <label class="radio">
            <input type="radio" name="booking_limit" value="3" class="m-wrap"/>月
        </label>
        <label class="radio">
            <input type="radio" name="booking_limit" value="4" class="m-wrap"/>年
        </label>
    </div>
</div>
<div class="control-group">
    <label class="control-label">限制购买数量</label>
    <div class="controls">
        <input type="text" name="limit_num" value="0" class="m-wrap span12" placeholder="限制同一个用户购买数量，0代表不限制">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>减库存方式</label>
    <div class="controls">
        <label class="radio">
            <input type="radio" name="minus_stock" value="1" checked="checked" class="m-wrap"/>拍下减库存
        </label>
        <label class="radio">
            <input type="radio" name="minus_stock" value="2" class="m-wrap"/>付款减库存
        </label>
    </div>
</div>