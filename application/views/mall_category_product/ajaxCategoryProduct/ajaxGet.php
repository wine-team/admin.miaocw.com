<div class="ajaxSearch">
    <div class="row-fluid">
        <div class="span3 control-group">
            <span class="help-inline">商品编号 </span>
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
                <option value="">产品设置</option>
            </select>
        </div>
        <div class="span3 control-group">
            <a href="javascript:;" class="btn green submit-search" data-join="inner">搜索</a>
        </div>
    </div>
</div>
<div id="category-product-responsive">

</div>
<script type="text/javascript">
$(document).ready(function(){
    ajaxGetCategoryProduct();

    //搜索
    $('.ajaxSearch').on('click', '.submit-search', function(e){
        ajaxGetCategoryProduct();
        e.preventDefault();
    });
    //搜索
    $('#goods-responsive').on('click', 'button[type="button"]', function(e){
    	var goodsId = new Array;
        $('#goods-responsive input[type="checkbox"]').each(function(index,element){
            if ($(this).is(':checked')) {
            	goodsId[index] = $(this).attr('value');
            }
        });
        goodsBaseId.val(goodsId);
        $('#goods-responsive').modal('hide');
        e.preventDefault();
    });
    //翻页
    $('#goods-responsive').on('click', '.dataTables_paginate a', function(e){
        var url = $(this).attr('href');
        ajaxGetGoodsBase(url)
        e.preventDefault();
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
            url: url ? url : hostUrl()+'/mall_category_product/ajaxGet',
            data: url ? {} : {'category_id':category_id, 'goods_id':goods_id, 'goods_name':goods_name, 'join':join},
            success: function(json) {
                if (json.status) {
                    $('#category-product-responsive').html(json.html);
                }
            }
        });
    }
});
</script>