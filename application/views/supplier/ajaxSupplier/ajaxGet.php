<div id="supplier-responsive" class="modal hide fade" style="display: none; width: 850px;" aria-hidden="true">
    <?php //$this->load->view('linemanage/ajaxDestinationData');?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    //弹框操作
    $('.add-pop-up-html').on('dblclick', '.supplieruid', function(){
        supplieruid = $(this);
        $('#supplier-responsive').modal();
    });
    
    //弹框之前触发
    $('#supplier-responsive').on('show', function(e){
        ajaxGetUser();
    });
    //搜索
    $('#supplier-responsive').on('submit', '.ajaxSearch', function(e){
        ajaxGetUser();
        e.preventDefault();
    });
    //翻页
    $('#supplier-responsive').on('click', '.dataTables_info a', function(e){
        var url = $(this).attr('href');
        ajaxGetUser(url);
        return e.preventDefault();
    });
    //选择数据
    $('#supplier-responsive').on('click', 'table input[type=radio]', function(e){
        supplieruid.val($(this).val());
        $('#supplier-responsive').modal('hide');
        e.preventDefault();
    });
    //获取数据
    function ajaxGetUser(url) {
        $.ajax({
            type: 'get',
            async: false,
            dataType : 'json',
            url: url ? url : hostUrl()+'/supplier/ajaxSupplier',
            data: url ? {} : $('.ajaxSearch').serialize(),
            success: function(json) {
                if (json.status) {
                    $('#supplier-responsive').html(json.html);
                }
            }
        });
    }
});
</script>