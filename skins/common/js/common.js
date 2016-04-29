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

//jquery 源程序
$(document).ready(function () {
    $('#datepicker').datepicker({
        showOn: "button",
        buttonImage: $('#datepicker').attr('src'),
        buttonImageOnly: true,
        buttonText: "Select date",
        dateFormat: 'yy-mm-dd'
    });
    
    function autocompleteInfo(url, documentId)
    {
        $.getJSON(url,function(json) { 
            $(documentId).autocomplete(json, {
                max: 13, //列表里的条目数
                minChars: 0, //自动完成激活之前填入的最小字符
                width: 385, //提示的宽度，溢出隐藏
                scrollHeight: 300, //提示的高度，溢出显示滚动条
                matchContains: true, //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示
                autoFill: false, //自动填充
                minChars:1,
                formatItem: function(data, i, max) {
                    return data.region_name + '（' + data.region_pinyin +'）';
                },
                formatMatch: function(data, i, max) {
                    return data.region_name + data.region_pinyin + data.region_abbr;
                },
                formatResult: function(data) {
                    return data.region_name;
                },
                resultsClass:'search-text'
            }).result(function(event, data, formatted) {
                $("#hid_city_name").val(data.region_pinyin);
                $('#pop_cities').hide();
            });
        });
    }
    
    
    //自动查询城市
    if ($('#start_address, #end_address').size() > 0) {
        var url = hostUrl()+'/region/autocompleteCity';
        autocompleteInfo(url, '#start_address, #end_address');
    }
    
    //自动加供应商
    if ($('#supplier-uid').size() > 0) {
        $.getJSON(hostUrl()+'/account/autocompleteUser',function(json) { 
            $('#supplier-uid').autocomplete(json, {
                max: 13, //列表里的条目数
                minChars: 0, //自动完成激活之前填入的最小字符
                width: 385, //提示的宽度，溢出隐藏
                scrollHeight: 300, //提示的高度，溢出显示滚动条
                matchContains: true, //包含匹配，就是data参数里的数据，是否只要包含文本框里的数据就显示
                autoFill: false, //自动填充
                minChars:1,
                formatItem: function(data, i, max) {
                    return data.user_name + '/' + data.alias_name + '（' + data.uid +'）';
                },
                formatMatch: function(data, i, max) {
                    return data.user_name + data.alias_name + data.uid;
                },
                formatResult: function(data) {
                    return data.uid;
                },
                resultsClass:'search-text'
            });
        });
    }
    
    //添加多个input框   上传多张图片
	$('.add-img-html').on('click', '.add-img-attr', function () {
		var img = $('.add-img-object:first').clone();  //复制对象 
		img.children('a').remove();                    // 删除a标签
		img.append('<a href="javascript:;" class="btn green remove-img-attr">删除</a>'); //添加a标签
		img.children('input').val('');  //赋值空
		$('.add-img-html').append(img);
    });
    $('.add-img-html').on('click', '.remove-img-attr', function () {
        $(this).parent('.controls').remove();
    });
    
    
});