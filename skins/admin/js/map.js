jQuery(document).ready(function($) {
	var baiduMap = new BMap.Map("map");//百度地图加载
	$('#baidulan').click(function(){
		address = findAddress();
		if (address){
			var options = {
					onSearchComplete: function(results){
						// 判断状态是否正确
						if (local.getStatus() == BMAP_STATUS_SUCCESS){
				          var poi = results.getPoi(0);
				          $("input[name=baidulan]").val(poi.point.lng + ','+poi.point.lat);
				          $("input[name=baidulon]").val(poi.point.lng);
				          $("input[name=baidulat]").val(poi.point.lat);
						}else{
							alert('没有搜索到坐标,请输入正确的地址');
						}
					}
				};
				var local = new BMap.LocalSearch(baiduMap, options);
				local.search(address);
		}
	});
	
	var amapMap = new AMap.Map("map"); //高德地图加载
	$('#googlelan').click(function(){
		address = findAddress();
		alert(address);
		if (address){
		    AMap.service(["AMap.PlaceSearch"], function() {       
		        MSearch = new AMap.PlaceSearch();
		        //关键字查询
		        MSearch.search(address, function(status, result){
		        	if(status === 'complete' && result.info === 'OK'){
		        		keywordSearch_CallBack(result);
		        	}else{
		        		alert('没有搜索到坐标,请输入正确的地址');
		        	}
		        }); 
		    });
	    	//回调函数
	    	function keywordSearch_CallBack(data) {
	    	    var poiArr = data.poiList.pois[0];
	    	    $("input[name=googlelan]").val(poiArr.location.lng + ','+poiArr.location.lat);
		        $("input[name=googlelon]").val(poiArr.location.lng);
		        $("input[name=googlelat]").val(poiArr.location.lat);
	    	}
		}
	});
	
	function findAddress(){
		var address =  $("input[name=address]").val();
		var district_id = $("select[name=district_id] option:selected").val();
	    var provinceName = $("select[name=province_id] option:selected").text();
	    var cityName = $("select[name=city_id] option:selected").text();
	    var districtName = $("select[name=district_id] option:selected").text();
	    if (address.length == 0 || district_id.length == 0){
	    	alert('选择地区，然后输入地址!谢谢合作!');
	    	return false;
	    }
	    address = provinceName + cityName + districtName + address;
	    return address;
	}
});
