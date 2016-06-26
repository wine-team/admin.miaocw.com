<div class="portlet box green">
    <div class="portlet-title">
        <div class="caption"><i class="icon-reorder"></i>商品销售信息</div>
        <div class="tools">
            <a class="collapse" href="javascript:;"></a>
            <a class="remove" href="javascript:;"></a>
        </div>
    </div>
    <div class="portlet-body form">
        <div class="control-group">
            <label class="control-label">市场价格</label>
            <div class="controls">
                <input type="text" name="market_price" class="m-wrap span12 required number" placeholder="市场价格" value="<?php echo $mallgoods->market_price;?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><em>* </em>供应价</label>
            <div class="controls">
                <input type="text" name="shop_price" class="m-wrap span12 required number" placeholder="供应价" value="<?php echo $mallgoods->shop_price;?>">
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label"><em>* </em>促销价</label>
            <div class="controls">
                <input type="text" name="promote_price" class="m-wrap span12 required number" placeholder="促销价" value="<?php echo $mallgoods->promote_price;?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><em>* </em>购买频率限制</label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" class="m-wrap required" name="booking_limit" value="0" <?php if(0==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>不限
                </label>
                <label class="radio">
                    <input type="radio" class="m-wrap required" name="booking_limit" value="1" <?php if(1==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>天
                </label>
                <label class="radio">
                    <input type="radio" class="m-wrap required" name="booking_limit" value="2" <?php if(2==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>周
                </label>
                <label class="radio">
                    <input type="radio" class="m-wrap required" name="booking_limit" value="3" <?php if(3==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>月
                </label>
                <label class="radio">
                    <input type="radio" class="m-wrap required" name="booking_limit" value="4" <?php if(4==$mallgoods->booking_limit):?>checked="checked"<?php endif;?>/>年
                </label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><em>* </em>限制购买数量</label>
            <div class="controls">
                <input type="text" name="limit_num" class="m-wrap span12 required" placeholder="限制购买数量 ,0代表不限制" value="<?php echo $mallgoods->booking_limit;?>">
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label"><em>* </em>促销开始时间</label>
            <div class="controls">
                <input type="text" name="promote_start_date" class="m-wrap span12 required date-picker date" placeholder="促销开始时间" value="<?php echo date('Y-m-d',strtotime($mallgoods->promote_start_date));?>">
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label"><em>* </em>促销结束时间</label>
            <div class="controls">
                <input type="text" name="promote_end_date" class="m-wrap span12 required date-picker date" placeholder="促销结束时间" value="<?php echo date('Y-m-d',strtotime($mallgoods->promote_end_date));?>">
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label"><em>* </em>用户积分</label>
            <div class="controls">
                <input type="text" name="integral" class="m-wrap span12 required number" placeholder="100积分抵1块钱,0代表不抵，不使用"  value="<?php echo $mallgoods->integral;?>"/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><em>* </em>减库存方式</label>
            <div class="controls">
                <label class="radio">
                    <input type="radio" class="m-wrap required" name="minus_stock" value="1" <?php if(1==$mallgoods->minus_stock):?>checked="checked"<?php endif;?>/>拍下减库存
                </label>
                <label class="radio">
                    <input type="radio" class="m-wrap required" name="minus_stock" value="2" <?php if(2==$mallgoods->minus_stock):?>checked="checked"<?php endif;?>/>付款减库存
                </label>
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label"><em>* </em>浏览量</label>
            <div class="controls">
                <input type="text" name="tour_count" class="m-wrap span12 required number" placeholder="浏览量" value="<?php echo $mallgoods->tour_count;?>"/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><em>* </em>销售数量</label>
            <div class="controls">
                <input type="text" name="sale_count" class="m-wrap span12 required number" placeholder="销售数量" value="<?php echo $mallgoods->sale_count;?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"><em>* </em>库存</label>
            <div class="controls">
                <input type="text" name="in_stock" class="m-wrap span12 required number" placeholder="库存" value="<?php echo $mallgoods->in_stock;?>"/>
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label"><em>* </em>排序</label>
            <div class="controls">
                <input type="text" name="sort_order" class="m-wrap span12 required number" placeholder="排序" value="<?php echo $mallgoods->sort_order;?>" />
            </div>
        </div>

        <div class="control-group add-goods-related-html">
            <label class="control-label">关联产品</label>
            <div class="controls">
                <input type="text" name="related_goods_id" class="m-wrap span12 tooltips related_goods_id" placeholder="关联产品Id" data-original-title="双击可弹框选择关联产品" data-trigger="hover"  autocomplete="off" value="<?php echo count($related_goods) > 0 ? implode(',',$related_goods):'';?>"  disabled="disabled"/>
            </div>
        </div>

        <div class="form-actions">
            <button class="btn green step4" type="submit"><i class="icon-ok"></i> 保存</button>
            <a class="btn step3" href="<?php echo base_url('mall_goods_base/addstep1')?>">返回上一步</a>
        </div>
    </div>
</div>