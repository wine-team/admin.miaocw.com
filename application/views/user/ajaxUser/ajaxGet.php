<div id="user-responsive" class="modal hide fade" style="display: none; width: 850px;" aria-hidden="true">
    <?php //$this->load->view('linemanage/ajaxDestinationData');?>
</div>
<script type="text/javascript">
$(document).ready(function(){
    //弹框操作
    $('.add-pop-up-html').on('dblclick', '.useruid', function(){
        useruid = $(this);
        $('#user-responsive').modal();
    });
    
    //弹框之前触发
    $('#user-responsive').on('show', function(e){
        ajaxGetUser();
    });

    //搜索
    $('#user-responsive').on('submit', '.ajaxSearch', function(e){
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
    $('#user-responsive').on('click', 'table input[type=radio]', function(e){
        useruid.val($(this).val());
        $('#user-responsive').modal('hide');
        e.preventDefault();
    });

    //获取数据
    function ajaxGetUser(url) {
        $.ajax({
            type: 'get',
            async: false,
            dataType : 'json',
            url: url ? url : hostUrl()+'/user/ajaxGet',
            data: url ? {} : $('.ajaxSearch').serialize(),
            success: function(json) {
                if (json.status) {
                    $('#user-responsive').html(json.html);
                }
            }
        });
    }
});
</script>