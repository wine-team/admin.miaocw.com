<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//用户类型定义    范围[1-2147483647] 依赖LEVEL的前32位和php int最大值    2147483647 matrix的X轴
define('UTID_PROVIDER',   1);     //供货商
define('UTID_PROSECOND',  2);     //二级商
define('UTID_PURCHASER',  4);     //采购商
define('UTID_BEIZHU',      16);    //贝竹总部
define('UTID_MANAGER_L1', 64);    //一级代理 收一级代理费
define('UTID_MANAGER_L2', 256);   //二级代理 收二级代理费
define('UTID_GROWTH',      1024);  //发展商    收发展费
define('UTID_SELLER',      4096);  //分销商    收销售费
define('UTID_CUSTOMER',   16384); //消费者     查看订单列表

//资金类型(type)
define('PAY',             1);    //支付
define('CASH',            2);    //提现
define('RECHARGE',        4);    //银行充值 recharge recharge
define('CANCEL',          8);    //退票 CANCEL
define('VIR_RECH',        16);   //虚拟充值 virtual recharge
define('REBUT',           32);   //提现驳回 rebut
define('DFPROFIT',        64);   //到付反利
define('ZFPROFIT',        128);  //在线利润

//account_type
define('ACCOUNT_TYPE_CARRY',      1); //可提现
define('ACCOUNT_TYPE_SETTLEMENT', 2); //冻结
define('ACCOUNT_TYPE_BONUS',      4); //游币
define('ACCOUNT_TYPE_RANK',       8); //积份
define('ACCOUNT_TYPE_MONTH',      16);//月结

/* End of file constants.php */
/* Location: ./application/config/constants.php */