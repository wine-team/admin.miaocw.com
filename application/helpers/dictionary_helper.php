<?php

/**
 * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
 * @param string $user_name 姓名
 * @return string 格式化后的姓名
 */
function substr_cut($user_name)
{
    $strlen = mb_strlen($user_name, 'utf-8');
    if ($strlen == 0 || $strlen == 1) {
        return $user_name;
    }
    if (preg_match('/^1[34578]\d{9}$/', $user_name)) { //如果是手机号码
        return subStrMobilePhone($user_name);
    }
    $firstStr = mb_substr($user_name, 0, 1, 'utf-8');
    $lastStr  = mb_substr($user_name, -1, 1, 'utf-8');
    return $strlen == 2 ? $firstStr . '*' : $firstStr . str_repeat('*', $strlen - 2) . $lastStr;
}

/**
 * 身份证字符，隐藏中间用*代替（不是18位或15位的直接返回）
 * @param unknown $sfz 身份证
 * @return mixed
 */
function substr_sfz($sfz)
{
    $strlen = strlen($sfz);
    switch ($strlen) {
        case 18 :
            $sfz = substr_replace($sfz,'****', 10, 4);
            break;
        case 15 :
            $sfz = substr_replace($sfz,'****', 8, 4);
            break;
        default:
            break;
    }
    return $sfz;
}

/**
 * 手机号码，中间四位用*代替
 * @param $phone
 * @return mixed|string
 */
function subStrMobilePhone($phone)
{
    $length = strlen($phone);
    if ( $length != 11 ) {
        return '';
    }
    return substr_replace($phone, '****', 3, 4);
}

/**
 * 对固定电话或传真进行拆分。
 * @param unknown $telephone 固定电话或传真
 * @param string $position 为true返回区号，默认返回区号后号码
 * @return unknown|string
 */
function subStrTelephone($telephone, $position=false)
{
    if (empty($telephone)) {
        return $telephone;
    }
    if (strpos($telephone, '-') !== false) {
        return $position ? strstr($telephone, '-', true) : ltrim(strstr($telephone, '-'), '-');//返回前半部分
    }
    if (preg_match('/^(010|021|022|023).*$/', $telephone)) {//如果前三位出现直辖市区号(010|021|022|023)，则返回直辖市电话号码
        return $position ? substr($telephone, 0, 2) : substr($telephone, -3);
    } else {
        return $position ? substr($telephone, 0, 3) : substr($telephone, -4);
    }
}

/**
 * 截取邮箱  显示邮箱第一位 和最后一位
 * @param $email
 */
function subStrEmail($email)
{
    if (empty($email)) {
        return $email;
    }
    $tail = strstr($email, '@');
    $email = substr($email, 0, strpos($email, '@'));
    return substr($email, 0, 1). '*****'. substr($email, -1, 1). $tail;
}

/**
 * 银行卡号 截取
 */
function subBankCard($bankCard, $interval = 4, $symbol = '*')
{
    $len = strlen($bankCard);
    $mod = fmod($len, $interval);
    $value = floor($len / $interval);

    $result = '';
    for ($i=0; $i < $value; $i++) {
        if ($i == 0)
        {
            $result .= '****';
        }
        else
        {
             $result .= ' ****';
        }
    }
    return ($mod == 0) ? $result : $result. substr($bankCard, -$mod);
}

/**
 * @param string $str
 * 字符串格式化为只含数字的字符串，并排序
 * */
function toNumStr($str)
{
    preg_match_all('/\d+/', $str, $matches);
    $str_arr = array();
    if (!empty($matches[0])) {
        $str_arr = array_flip(array_flip($matches[0]));
        foreach ($str_arr as $k=>$s) {
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
    $str_arr = array_flip(array_flip($str_arr));  // 去除重复值
    $new_arr = array();
    foreach ($str_arr as $s) {
        if(!empty(trim($s))) $new_arr[] = trim($s);
    }
    asort($new_arr);
    return @implode(',',$new_arr);
}