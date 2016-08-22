<div class="control-group">
    <label class="control-label"><em>* </em>市场价格</label>
    <div class="controls">
        <input type="text" name="market_price" value="<?php echo $mallGoodsBase->market_price ?>" class="m-wrap span12 required number">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>销售价</label>
    <div class="controls">
        <input type="text" name="shop_price" value="<?php echo $mallGoodsBase->shop_price ?>" class="m-wrap span12 required number">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>供应价</label>
    <div class="controls">
        <input type="text" name="provide_price" value="<?php echo $mallGoodsBase->provide_price ?>" class="m-wrap span12 required number">
    </div>
</div>
<div class="control-group ">
    <label class="control-label">赠送积分</label>
    <div class="controls">
        <input type="text" name="integral" value="<?php echo $mallGoodsBase->integral ?>" class="m-wrap span12 required number" placeholder="100积分抵1块钱，0代表不抵，不使用">
    </div>
</div>
<div class="control-group ">
    <label class="control-label">浏览量</label>
    <div class="controls">
        <input type="text" name="tour_count" value="<?php echo $mallGoodsBase->tour_count ?>" class="m-wrap span12 number">
    </div>
</div>
<div class="control-group">
    <label class="control-label">已售数量</label>
    <div class="controls">
        <input type="text" name="sale_count" value="<?php echo $mallGoodsBase->sale_count ?>" class="m-wrap span12 number">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>库存</label>
    <div class="controls">
        <input type="text" name="in_stock" value="<?php echo $mallGoodsBase->in_stock ?>" class="m-wrap span12 required number">
    </div>
</div>
<div class="control-group ">
    <label class="control-label">排序</label>
    <div class="controls">
        <input type="text" name="sort_order" value="<?php echo $mallGoodsBase->sort_order ?>" class="m-wrap span12 number">
    </div>
</div>