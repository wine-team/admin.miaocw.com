/**
 * 获取host域名
 * @returns
 */
function hostUrl() {
    return location.protocol+'//'+location.host;
}

/**
 * js日期格式
 * 例：new Date().format('yyyy年MM月dd')
 */
Date.prototype.format = function(format){
    var o = {
        'M+' : this.getMonth()+1, //month
        'd+' : this.getDate(), //day
        'h+' : this.getHours(), //hour
        'm+' : this.getMinutes(), //minute
        's+' : this.getSeconds(), //second
        'q+' : Math.floor((this.getMonth()+3)/3), //quarter
        'S' : this.getMilliseconds() //millisecond
    }

    if(/(y+)/.test(format)) {
        format = format.replace(RegExp.$1, (this.getFullYear()+'').substr(4 - RegExp.$1.length));
    }

    for(var k in o) {
        if(new RegExp('('+ k +')').test(format)) {
            format = format.replace(RegExp.$1, RegExp.$1.length==1 ? o[k] : ('00'+ o[k]).substr((''+ o[k]).length));
        }
    }
    return format;
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
    
    $('.line-form').validate({ignore: '',});

    //CKedit 编辑器 js
    if ($('textarea.textarea-multipart-edit').size() > 0) {
        KindEditor.create('textarea.textarea-multipart-edit', {
            width : '99.5%',
            height : '250px',
            filterMode: false
        });
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


