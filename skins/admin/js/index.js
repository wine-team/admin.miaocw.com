/**
 * 获取host域名
 * @returns
 */
function hostUrl() {
    if (window.attachEvent) {
        var host = window.location.pathname.split( '/' )
        return host[0];
    }
    return location.origin;
}
jQuery(document).ready(function($) {
    /*admin 左侧菜单栏当前位置*/
    var currentUrl = window.location.href;
    $('ul.page-sidebar-menu li a').each(function(index, element) {
        $href = $(this).attr('href');
        if (currentUrl == $href) {
            var parentsLi = $(element).parents('li');
            parentsLi.addClass('active');
            parentsLi.find('span.arrow').addClass('open');
        }
    });
    
    /* 重置搜索条件 */
    $('.reset_button_search').click(function(){
        var currentUrl = window.location.href;
        if (currentUrl.indexOf('?') != '-1') {
            var currentUrlPre = currentUrl.split('?')[0];
            window.location.href = currentUrlPre;
        } else {
            $('.form-search')[0].reset();
        }
    });
    
    $('.line-form').validate();

    //CKedit 编辑器 js
    if ($('textarea.textarea-multipart-edit').size() > 0) {
        KindEditor.create('textarea.textarea-multipart-edit', {
            width : '73%',
            height : '250px'
        });
    }
    
    //wysiwyg 编辑器 js
    if ($('textarea.textarea-wysiwyg-edit').size() > 0) {
        $('.textarea-wysiwyg-edit').wysiwyg();
    }
    
    //table list 全选或全不选操作
    jQuery('#sample_1 .group-checkable, #sample_1 .group-checkable2').change(function () {
        var set = jQuery(this).attr('data-set');
        var checked = jQuery(this).is(':checked');
        jQuery(set).each(function () {
            if (checked) {
                $(this).prop('checked', true);
            } else {
                $(this).attr('checked', false);
            }
        });
        jQuery.uniform.update(set);
    });
    
    $('.table-hover').on('click','.freeze',function(){
    	var obj = $(this);
    	var name = (obj.text()=='冻结') ? "解冻" : "冻结";
    	if(confirm('你确定要将该机器'+name+"吗？")){
    		var url = location.origin+'/macs/doFree';
    		var mac_id = obj.attr("mac_id");
			var isfree = (obj.text()=='冻结') ? 'N' :'Y';
			$.post(url,{mac_id:mac_id,isfree:isfree},function(data){
				if(data.status){
					var con = (data.isfree=='Y') ? '冻结' :'正常';
					obj.text(con);
				}
			},"json");
    	}
     });

    $('.portlet-body').on('click','.reply',function(){
    	$(this).attr('href','#stack1');
    	var hpcid = $(this).attr('hpcid');
    	var flag = $(this).attr('flag');
    	$('.modal-footer').on('click','.ok',function(){
    		var content = $('.modal-body').find('textarea').val();
    		location.href=location.origin+'/applyroomprice/reject?hpcid='+hpcid+'&flag='+flag+'&content='+content
    		$(this).attr('data-dismiss','modal');//消失
    	})
    })
    
    $('.portlet-body').on('click','.status',function(){
    	var id = $(this).attr('id');
    	$(this).attr('href','#stack1');
    	$('.modal-footer').on('click','.ok',function(){
    		var status = $('input:radio[name="status"]:checked').val();
    		location.href=location.origin+'/lineproductreviews/updateStatus?id='+id+'&status='+status;
    		$(this).attr('data-dismiss','modal');//消失
    	})
    })
    
    $('.portlet-body').on('click','.hotelreviews-status',function(){
    	var id = $(this).attr('id');
    	$(this).attr('href','#stack1');
    	$('.modal-footer').on('click','.ok',function(){
    		var status = $('input:radio[name="status"]:checked').val();
    		location.href=location.origin+'/hotelreviews/updateStatus?id='+id+'&status='+status;
    		$(this).attr('data-dismiss','modal');//消失
    	})
    })
});


