<div class="control-group">
    <label class="control-label"><em>* </em>商品类别</label>
    <div class="controls">
        <select name="extensionCode" class="m-wrap span12" disabled="disabled">
            <?php foreach ($extension as $key=>$value) : ?>
                <option value="<?php echo $key;?>" <?php if($this->input->get('extension_code')==$key):?>selected="selected"<?php endif;?>><?php echo $value; ?></option>
            <?php endforeach;?>
        </select>
        <input type="hidden" name="attr_set_id" value="<?php echo $this->input->get('attr_set_id');?>" />
        <input type="hidden" name="extension_code" value="<?php echo $this->input->get('extension_code');?>" />
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>商品名称</label>
    <div class="controls">
        <input type="text" name="goods_name" class="m-wrap span12 required">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>商品SKU</label>
    <div class="controls">
        <input type="text" name="goods_sku" class="m-wrap span12 required">
    </div>
</div>
<div class="control-group">
    <label class="control-label">商品品牌</label>
    <div class="controls">
        <select name="brand_id" class="m-wrap span12 chosen" data-placeholder="请选择商品属性">
            <option value="0"></option>
            <?php if ($brand->num_rows() > 0) : ?>
                <?php foreach ($brand->result() as $item) : ?>
                    <option value="<?php echo $item->brand_id ?>"><?php echo $item->brand_name ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>净重（kg）</label>
    <div class="controls">
        <input type="text" name="goods_weight" class="m-wrap span12 required number">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>商品简介</label>
    <div class="controls">
        <textarea name="goods_brief" rows="4" class="m-wrap span12 required"></textarea>
    </div>
</div>
<div class="control-group add-pop-up-html">
    <label class="control-label"><em>* </em>供应商UID</label>
    <div class="controls">
        <input type="text" name="supplier_id" class="m-wrap span12 supplieruid required tooltips" placeholder="默认0为自营商品" data-original-title="双击可弹框选择供应商" data-trigger="hover" autocomplete="off">
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>审核状态</label>
    <div class="controls">
        <select name="is_check" class="m-wrap span12 number required">
            <option value="1">未审核</option>
            <option value="2">审核通过</option>
            <option value="3">审核拒绝</option>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>上下架</label>
    <div class="controls">
        <select name="is_on_sale" class="m-wrap span12 required">
            <option value="1">上架</option>
            <option value="2">下架</option>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>pc商品详情</label>
    <div class="controls">
        <textarea name="goods_desc" class="textarea-multipart-edit m-wrap span12 required"></textarea>
    </div>
</div>
<div class="control-group">
    <label class="control-label"><em>* </em>wap商品详情</label>
    <div class="controls">
        <textarea name="wap_goods_desc" class="textarea-multipart-edit m-wrap span12 required"></textarea>
    </div>
</div>