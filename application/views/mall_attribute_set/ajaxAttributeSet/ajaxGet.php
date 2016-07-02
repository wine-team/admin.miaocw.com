<div id="attribute-responsive" class="modal hide fade" style="display: none; width: 850px;" aria-hidden="true">
    <?php //$this->load->view('linemanage/ajaxDestinationData');?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    //弹框操作
    $('.add-attributeSet-html').on('dblclick', '.attributeSet', function(){
        supplieruid = $(this);
        $('#attribute-responsive').modal();
    });
    
    //弹框之前触发
    $('#attribute-responsive').on('show', function(e){
        ajaxGetUser();
    });

    //搜索
    $('#attribute-responsive').on('submit', '.ajaxSearch', function(e){
        ajaxGetUser();
        e.preventDefault();
    });

    //翻页
    $('#attribute-responsive').on('click', '.dataTables_info a', function(e){
        var url = $(this).attr('href');
        ajaxGetUser(url);
        return e.preventDefault();
    });

    //选择数据
    $('#attribute-responsive').on('click', 'table input[name=uid]', function(e){
        supplieruid.val($(this).val());
        $('#attribute-responsive').modal('hide');
        e.preventDefault();
    });

    //获取数据
    function ajaxGetUser(url) {
        $.ajax({
            type: 'get',
            async: false,
            dataType : 'json',
            url: url ? url : hostUrl()+'/supplier/ajaxAttributeSet',
            data: url ? {} : $('.ajaxSearch').serialize(),
            success: function(json) {
                if (json.status) {
                    $('#attribute-responsive').html(json.html);
                }
            }
        });
    }
});
</script>