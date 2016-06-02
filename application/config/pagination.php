<?php
$config['per_page'] = 20;
$config['num_links'] = 4;
$config['uri_segment'] = 3;
$config['use_page_numbers'] = TRUE;
$config['display_pages'] = TRUE;
$config['first_link'] = '首页';
$config['last_link'] = '尾页';
$config['next_link'] = '下一页';
$config['prev_link'] = '上一页';
// $config['cur_tag_open'] = '<b>';
// $config['cur_tag_close'] = '</b>';
//$config['query_string_segment'] = '20';

// 如果你希望在整个分页周围围绕一些标签，你可以通过下面的两种方法：

$config['full_tag_open'] = '<ul>';
// 把打开的标签放在所有结果的左侧。

$config['full_tag_close'] = '</ul>';
// 把关闭的标签放在所有结果的右侧。

// $config['first_link'] = '';
// 你希望在分页的左边显示“第一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。

$config['first_tag_open'] = ' <li>';
// “第一页”链接的打开标签。

$config['first_tag_close'] = '</li>';
// “第一页”链接的关闭标签。


// $config['last_link'] = 'Last';
// 你希望在分页的右边显示“最后一页”链接的名字。If you do not want this link rendered, you can set its value to FALSE.
$config['last_tag_open'] = ' <li>';
// “最后一页”链接的打开标签。

$config['last_tag_close'] = '</li>';
// “最后一页”链接的关闭标签。


// $config['prev_link'] = '&lt;';
// 你希望在分页中显示“上一页”链接的名字。If you do not want this link rendered, you can set its value to FALSE.

$config['prev_tag_open'] = '<li>';
// “上一页”链接的打开标签。

$config['prev_tag_close'] = '</li>';
// “上一页”链接的关闭标签。

// $config['next_link'] = '&gt;';
// 你希望在分页中显示“下一页”链接的名字。If you do not want this link rendered, you can set its value to FALSE.

$config['next_tag_open'] = '<li>';
// “下一页”链接的打开标签。

$config['next_tag_close'] = '</li>';
// “下一页”链接的关闭标签。

$config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
// “当前页”链接的打开标签。

$config['cur_tag_close'] = '</a></li>';
// “当前页”链接的关闭标签。

$config['num_tag_open'] = '<li>';
// “数字”链接的打开标签。

$config['num_tag_close'] = '</li>';
// “数字”链接的关闭标签。