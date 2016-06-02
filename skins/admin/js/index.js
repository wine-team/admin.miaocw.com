/**
 * 获取host域名
 * @returns
 */
function hostUrl() {
    return location.protocol+'//'+location.host;
}
jQuery(document).ready(function($) {
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
            height : '250px',
            filterMode: false
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
});


