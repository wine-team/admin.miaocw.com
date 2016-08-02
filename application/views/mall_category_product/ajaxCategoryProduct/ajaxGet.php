<div class="ajaxSearch">
    <div class="row-fluid">
        <div class="span3 control-group">
            <span class="help-inline">商品编号 </span>
            <input type="hidden" name="goods_json" value="{}">
            <input type="hidden" name="category_id" value="<?php echo isset($mallCategory->cat_id) ? $mallCategory->cat_id : $this->input->get('cat_id');?>">
            <input type="text" name="goods_id" value="<?php echo trim($this->input->get('goods_id'));?>" class="m-wrap small">
        </div>
        <div class="span3 control-group">
            <span class="help-inline">商品名称 </span>
            <input type="text" name="goods_name" value="<?php echo $this->input->get('goods_name');?>" class="m-wrap small">
        </div>
        <div class="span3 control-group">
            <span class="help-inline">产品刷选 </span>
            <select name="join" class="m-wrap small">
                <option value="inner" selected="selected">已设置</option>
                <option value="">全部产品</option>
            </select>
        </div>
        <div class="span3 control-group">
            <a href="javascript:;" class="btn green submit-search" data-join="inner">搜索</a>
        </div>
    </div>
</div>
<div class="category-product-responsive">
    <?php //产品内容 ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    ajaxGetCategoryProduct();

    //搜索
    $('.ajaxSearch').on('click', '.submit-search', function(e){
        ajaxGetCategoryProduct();
        e.preventDefault();
    });

    //翻页
    $('.category-product-responsive').on('click', '.dataTables_paginate a', function(e){
        var url = $(this).attr('href');
        ajaxGetCategoryProduct(url)
        e.preventDefault();
    });

    //选择checkbox
    $('.category-product-responsive').on('click', 'input.group-checkable', function(e){
        var goods_json = JSON.parse($('input[name=goods_json]').val());
        if ($(this).is(':checked')) {
            $('input[name=goods_id].checkboxes').each(function() {
                var goods_id = $(this).val();
                var position = $('input[data-goods-id='+goods_id+']').val();
                goods_json[goods_id] = position;
            });
        } else {
            $('input[name=goods_id].checkboxes').each(function() {
                var goods_id = $(this).val();
                var position = $('input[data-goods-id='+goods_id+']').val();
                goods_json[goods_id] = undefined;
            });
        }
        $('input[name=goods_json]').val(JSON.stringify(goods_json));
    });

    //单选
    $('.category-product-responsive').on('click', 'input.checkboxes-goods', function(e){
        var goods_json = JSON.parse($('input[name=goods_json]').val());
        var goods_id = $(this).val();
        var position = $('input[data-goods-id='+goods_id+']').val();
        if ($(this).is(':checked')) {
            goods_json[goods_id] = position;
        } else {
            goods_json[goods_id] = undefined;
        }
        $('input[name=goods_json]').val(JSON.stringify(goods_json));
    });

    //修改排序
    $('.category-product-responsive').on('change', 'input[name=position]', function(e){
        var goods_json = JSON.parse($('input[name=goods_json]').val());
        var goods_id = $(this).attr('data-goods-id');
        var position = $(this).val();
        if ($('input[value='+goods_id+'].checkboxes-goods').is(':checked')) {
            goods_json[goods_id] = position;
        } else {
            goods_json[goods_id] = undefined;
        }
        $('input[name=goods_json]').val(JSON.stringify(goods_json));
    });

    //获取数据
    function ajaxGetCategoryProduct(url) {
        var category_id = $('.ajaxSearch input[name=category_id]').val();
        var goods_id = $('.ajaxSearch input[name=goods_id]').val();
        var goods_name = $('.ajaxSearch input[name=goods_name]').val();
        var join = $('.ajaxSearch select[name=join]').val();
        $.ajax({
            type: 'get',
            async: true,
            dataType : 'json',
            url: url ? url : $('.data-ajax-url').attr('data-ajax-url'),
            data: url ? {} : {'category_id':category_id, 'goods_id':goods_id, 'goods_name':goods_name, 'join':join},
            success: function(data) {
                if (data.status) {
                    $('.category-product-responsive').html(data.html);
                    $('.ajaxSearch input[name=goods_json]').val(data.json);
                }
            }
        });
    }
});
</script>