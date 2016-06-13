<div id="goods-responsive" class="modal hide fade" style="display: none; width: 850px;" aria-hidden="true">
</div>
<script type="text/javascript">
$(document).ready(function(){
    //弹框操作
    $('.table').on('click', '.delivery', function(e){ 
    	var deliver_order_id = $(this).data('deliver_order_id');
    	ajaxGetGoodsBase('', {deliver_order_id:deliver_order_id});
        $('#goods-responsive').modal();
        e.preventDefault();
    });

    //获取数据
    function ajaxGetGoodsBase(url,data) {
        $.ajax({
            type: 'get',
            async: false,
            dataType : 'json',
            url: url ? url : hostUrl()+'/mall_order_base/ajaxGetDelivery',
            data: data,
            success: function(json) {
                if (json.status) {
                    $('#goods-responsive').html(json.html);
                }
            }
        });
    }
});
</script>