<div id="goods-responsive" class="modal hide fade" style="display: none; width: 850px;" aria-hidden="true">
</div>
<script type="text/javascript">
$(document).ready(function(){
    //弹框操作
    $('.add-goods-related-html').on('dblclick', '.related_goods_id', function(e){
    	related_goods_id = $(this);
        $('#goods-responsive').modal();
        e.preventDefault();
    });
    
    //弹框之前触发
    $('#goods-responsive').on('show', function(e){
        ajaxGetGoodsBase();
    });

    //搜索
    $('#goods-responsive').on('click', 'button[type="submit"]', function(e){
   	    ajaxGetGoodsBase();
        e.preventDefault();
    });

    //搜索
    $('#goods-responsive').on('click', 'button[type="button"]', function(e){

    	var goodsId = new Array;
        $('#goods-responsive input[type="checkbox"]').each(function(index,element){
            if($(this).is(':checked')){
            	goodsId[index] = $(this).attr('value');
            }
        })
    	related_goods_id.val(goodsId);
        $('#goods-responsive').modal('hide');
        e.preventDefault();
    });

    //翻页
    $('#goods-responsive').on('click', '.dataTables_paginate a', function(e){
    	e.preventDefault();
        var url = $(this).attr('href');
        ajaxGetGoodsBase(url)
        return false;
    });

    //获取数据
    function ajaxGetGoodsBase(url) {
        $.ajax({
            type: 'get',
            async: true,
            dataType : 'json',
            url: url ? url : hostUrl()+'/mall_goods_base/ajaxGetMallGoods',
            data: url ? {} : $('.ajaxGoodsBaseSearch').serialize(),
            success: function(json) {
                if (json.status) {
                    $('#goods-responsive').html(json.html);
                }
            }
        });
    }
});
</script>