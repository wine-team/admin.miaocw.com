<?php
/**
 * 添加js文件
 * @param unknown $dirname
 * @param unknown $file_name
 */
function js($dirname, $file_name) 
{
    echo '<script type="text/javascript" src="'.base_url().'skins/'.$dirname.'/js/'.$file_name.'.js"></script>';
}
/**
 * 添加css文件
 * @param unknown $dirname
 * @param unknown $file_name
 */
function css($dirname, $file_name) {
    echo '<link rel="stylesheet" type="text/css" href="'.base_url().'skins/'.$dirname.'/css/'.$file_name.'.css" />';
}

/**
 * 返回html提示信息
 * @return string
 */
function execute_alert_message()
{
    $CI = & get_instance();
    $CI->load->library('session');
    if ($CI->session->flashdata('success')) {
        return '<div class="alert alert-success">
                    <button class="close" data-dismiss="alert"></button>
                    <a class="glyphicons no-js ok_2" href="javascript:;"><i></i>' . $CI->session->flashdata('success') . '</a>
                </div>';
    } elseif ($CI->session->flashdata('error')) {
        return '<div class="alert alert-error">
                    <button class="close" data-dismiss="alert"></button>
                    <a class="glyphicons no-js remove_2" href="javascript:;"><i></i>' . $CI->session->flashdata('error') . '</a>
                </div>';
    }
}

function warning_alert_message($warning)
{
    return '<div class="alert">
                <button class="close" data-dismiss="alert"></button>
                <strong>Warning!</strong> ' . $warning . '
            </div>';
}

function info_alert_message($info)
{
    return '<div class="alert-info">
                <button class="close" data-dismiss="alert"></button>
                <strong>Warning!</strong> ' . $info . '
            </div>';
}

/**
 * 例如: 数组最后一个不用填写key值，可接受数组和字符串。
 * array(
 *       'admin/linemanage/grid'=>'线路管理',
 *       '添加线路'
 *      )
 */
function breadcrumb($urlInfo)
{
    $breadcrumb = '<ul class="breadcrumb">';
    if (is_array($urlInfo)) {
        foreach ($urlInfo as $url => $name) {
            if (!is_numeric($url)) {
                $breadcrumb .= '<li>
                                    <a href="' . base_url($url) . '">'.$name.'</a>
                                    <i class="icon-angle-right"></i>
                                </li>';
            } else {
                $breadcrumb .= '<li>'.$name.'<i class="icon-angle-right"></i></li>';
            }
        }
    } else {
        $breadcrumb .= '<li>'.$urlInfo.'<i class="icon-angle-right"></i></li>';
    }

    $breadcrumb .= '</ul>';
    return $breadcrumb;
}

 /**
 * 获取时间的周
 * @return string
 */
function get_week_name($date)
{
    $weekarray=array('日','一','二','三','四','五','六'); //先定义一个数组
    return '周'.$weekarray[date('w',strtotime($date))];
}

/**
 *  对象转换成数组
 * @param unknown $obj
 * @return unknown
 */
function ob2ar($obj)
{
    if(is_object($obj)) {
        $obj = (array)$obj;
        $obj = ob2ar($obj);
    } elseif (is_array($obj)) {
        foreach($obj as $key => $value) {
            $obj[$key] = ob2ar($value);
        }
    }
    return $obj;
}

/**
 * 可视化打印。
 * @param mixed $data
 */
function pr($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function redirectAction($uri = '', $method = 'location', $http_response_code = 302)
{
    if (!preg_match('#^https?://#i', $uri)) {
        $uri = base_url($uri);
    }

    switch($method) {
        case 'refresh' : 
            header("Refresh:0;url=".$uri);
            break;
        default : 
            header("Location: ".$uri, TRUE, $http_response_code);
            break;
    }
    exit;
}

/**
 * 功能：检查权限
 */
function admin_priv($action_list, $priv_str)
{
    if ($action_list == 'all') {
        return true;
    }
    $action_new = explode(',', $action_list);
    if (!in_array($priv_str, $action_new, TRUE)) {
        return false;
    }
    return true;
}

