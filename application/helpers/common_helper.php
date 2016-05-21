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

/**
 * @param string $str
 * 字符串格式化为只含数字的字符串，并排序
 * */
function toNumStr($str)
{
    preg_match_all('/\d+/', $str, $matches);var_dump($matches[0]);
    $str_arr = array();
    if(!empty($matches[0]))
    {
        $str_arr = array_flip(array_flip($matches[0]));
        foreach ($str_arr as $k=>$s)
        {
            if(!$s) unset($str_arr[$k]);
        }
        asort($str_arr);
    }
    return @implode(',',$str_arr);
}

/**
 * @param string $str
 * 字符串格式化为英文逗号的字符串，并排序
 * */
function toEnComma($str)
{
    $str = str_replace('，',',',$str);
    $str_arr = @explode(',',$str); 
    $str_arr = array_flip(array_flip($str_arr)); 
    $new_arr = array();
    foreach ($str_arr as $s)
    {
        if(!empty(trim($s))) $new_arr[] = trim($s);
    }
    asort($new_arr);
    return @implode(',',$new_arr);
}
