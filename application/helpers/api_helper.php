<?php
	/**
	 * @name api接口
     * @param unknown_type $method 访问的方法名
     * @param unknown_type $apiParas 参数
     * @param unknown_type $ishttps true表示是https，false表示是http
	 */
	function getApiDynamic($apiParas,$url)
	{
		return apiCurl($url,$apiParas);
	}
	
	function apiCurl($url,$curlPost)
	{
		// 初始化一个 cURL 对象
		$ch = curl_init();
		// 设置你需要抓取的URL
		curl_setopt($ch, CURLOPT_URL, $url);
		// 设置header
		curl_setopt($ch, CURLOPT_HEADER, 0);
		// 设置cURL参数，要求结果保存到字符串中还是输出到屏幕上。
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// post提交
		curl_setopt($ch, CURLOPT_POST, 1);
		//post参数设置
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
		// 运行cURL，请求网页
		$data = curl_exec($ch);
		// 关闭URL请求
		curl_close($ch);
		
		return $data;
	}
?>