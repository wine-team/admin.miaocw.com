<div id="user-responsive" class="modal hide fade" style="display: none; width: 850px;" aria-hidden="true">
    <?php //$this->load->view('linemanage/ajaxDestinationData');?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    //弹框操作
    $('.add-goodsid-html').on('dblclick', '.related_goods_id', function(){ 
    	relatedgoodsid = $(this);
        $('#user-responsive').modal();
    });
    
    //弹框之前触发
    $('#user-responsive').on('show', function(e){
        ajaxGetUser();
    });

    //搜索
    $('#user-responsive').on('submit', '.ajaxUserSearch', function(e){
        ajaxGetUser();
        e.preventDefault();
    });

    //翻页
    $('#user-responsive').on('click', '.dataTables_info a', function(e){
        var url = $(this).attr('href');
        ajaxGetUser(url);
        return e.preventDefault();
    });

    //选择数据
    $('#user-responsive').on('click', 'table input[name=attr_id]', function(e){
    	relatedgoodsid.val($(this).val());
		var str = $(this).parents('tr').find('.attr_values').html();
        var strs= new Array(); //定义一数组
        strs=str.split(","); //字符分割
        var new_str = '';
        for (i=0;i<strs.length ;i++ )
        {
        	if(strs[i].trim()) new_str += '<option value="'+strs[i]+'">'+strs[i]+'</option>';
        } 
        $('select[name="attr_value"]').html(new_str);
        $('#user-responsive').modal('hide');
        e.preventDefault();
    });

    //获取数据
    function ajaxGetUser(url) {
        $.ajax({
            type: 'get',
            async: false,
            dataType : 'json',
            url: url ? url : hostUrl()+'/mall_attribute/ajaxGetAttr',
            data: url ? {} : $('.ajaxUserSearch').serialize(),
            success: function(json) {
                if (json.status) {
                    $('#user-responsive').html(json.html);
                }
            }
        });
    }
});
</script>