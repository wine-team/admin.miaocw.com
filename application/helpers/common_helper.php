<?php 

 /**
 * 广告位数组
 * @return array
 */
function advertArray()
{
    return array(
        '1' => '首页幻灯片广告',
        '2' => '登陆幻灯片广告'     
    );
}


/**
 *  议价结算方式
 *  @return array
 */
function bargainingNode(){
    return array(
        'system'  =>'系统结算',
        'private' =>'自主结算'
    );
}

/**
 *  议价手续费付费方式
 *  @return array
 */
function bargainingPayer(){
    return array(
            'seller'    => '分销商付手续费',
            'provider'  => '供应商',
            'prosecond' => '二级供应商'
    );
}



/**
 * 获取cmsBlock描述。
 * @param string $blockId
 * @return string
 */
function cmsBlock($blockId)
{
    $CI = & get_instance();
    $CI->load->model('cms_block_model', 'cms_block');
    $result = $CI->cms_block->findByBlockId($blockId);
    $description = '';
    if ($result) {
        $description = $result->row(0)->description;
    }
    return $description;
}





/**
 * 后台左边菜单权限管理
 * @return array
 */
function adminleftmenu()
{
    return array(
        '1'       =>'客服部',
        '2'       =>'营销部',
        '4'       =>'财务部',
        '8'       =>'工程部',
        '16'      =>'新闻管理',
        '32'      =>'景区管理',
        '64'      =>'酒店管理',
        '128'     =>'线路管理',
        '256'     =>'权限菜单管理',
        '512'     =>'网站设置',
    );
}

/**
 * 
 * @param unknown $priv_str
 * @return boolean
 */
function admin_permission($priv_str)
{
    $CI = & get_instance();
    $action_list = $CI->session->userdata('action_list');
    $action_new = explode(',', $action_list);
    if (!in_array($priv_str, $action_new, TRUE)) {
        return false;
    } 

    return true;
}





/**
 * 地区类型
 *
 */
function regionType()
{
    return array(
            '0'=>'国家',
            '1'=>'省份',
            '2'=>'城市',
            '3'=>'县/区'
    );
}

function account_type($type)
{
    $balance = $type;
    $account_type = array(
        1    => '支付',
        2    => '提现',
        4    => '银行充值',
        8    => '退票',
        16   => '虚拟充值',
        32   => '提现驳回',
        64   => '到付反利',
        128  => '在线利润',
        256  => '月结抵扣',
        512  => '抵扣驳回',
        1024 => '月结转余额'
    );
    if (array_key_exists($type, $account_type)) {
        $balance = $account_type[$type];
    }
    return $balance;
}


function apiTypeArray()
{
	return array(
		'1'=>'发送订单',
		'2'=>'取消订单',
		'4'=>'发送短信',
		'5'=>'核销订单',
		'8'=>'发送彩信',
		'9'=>'短信转发',
		'10'=>'彩信转发',
		'16'=>'修改订单',
	    '33'=>'审核订单'
	);
}


/**
 * 短信状态
 */
function smsStatuaArray()
{
	return array(
		'100'=>'100发送成功',
		'101'=>'101验证失败',
		'102'=>'102短信不足',
		'103'=>'103操作失败',
		'104'=>'104非法字符',
		'105'=>'105内容过多',
		'106'=>'106号码过多',
		'107'=>'107频率过快',
		'108'=>'108号码内容空',
		'109'=>'109账号冻结',
		'110'=>'110禁止频繁单条发送',
		'111'=>'111系统暂定发送',
		'112'=>'112有错误号码',
		'113'=>'113定时时间不对',
		'114'=>'114账号被锁，10分钟后登录',
		'115'=>'115连接失败',
		'116'=>'116禁止接口发送',
		'117'=>'117绑定IP不正确',
		'120'=>'120系统升级'	
	);
}

/**
 * 反馈类型数组
 * @return array
 */
function userFeedBackTypeArray()
{
    return array(
        '1'=>'美酒',
    );
}


/**
 * 商品快递物流
 * @return array
 */
function tourismLogisticsTypeArray()
{
    return array(
        'ems'            => 'EMS',
        'shunfeng'       => '顺丰速递',
        'shentong'       => '申通速递',
        'yuantong'       => '圆通速递',
        'zhongtong'      => '中通快递',
        'huitongkuaidi'  => '百世汇通',
        'yunda'          => '韵达快递',
        'zhaijisong'     => '宅急送',
        'tiantian'       => '天天快递',
        'guotongkuaidi'  => '国通快递',
        'zengyisudi'     => '增益速递',
        'ztky'           => '中铁物流',
        'zhongtiewuliu'  => '中铁快运',
        'ganzhongnengda' => '能达速递',
        'quanfengkuaidi' => '全峰快递',
        'jd'             => '京东',
        'bjemstckj'      => '北京EMS',
        'huiqiangkuaidi' => '汇强快递',
        'yuntongkuaidi'  => '运通快递',
        'kuaijiesudi'    => '快捷速递',
        'youzhengguonei' => '邮政包裹',
        'debangwuliu'    => '德邦',
        'tiandihuayu'    => '天地华宇',
        'suer'           => '速尔物流',
        'youshuwuliu'    => '优速',
        'yuanchengwuliu' => '远成物流',
        'jiayiwuliu'     => '佳怡物流',
        'longbanwuliu'   => '龙邦物流',
        'hengluwuliu'    => '恒路物流',
        'xinbangwuliu'   => '新邦物流',
        'tnt'            => 'TNT',
        'dhl'            => 'DHL',
        'fedex'          => 'Fedex',
        'ups'            => 'UPS',
        'usps'           => 'USPS',
    );
}
