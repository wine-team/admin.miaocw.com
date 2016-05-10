<?php
//图片根网址
define('IMGURL', 'http://img.uhelper.cn/');  
//图片根目录
define('IMGPATH', '../img.uhelper.cn/');

class Base_model extends CI_Model{ 
	
    /******************************
     * 数据库操作
     * ***************************/
    
	/**
	 * @param string $table:数据表
	 * @param string $order：排序
	 * @param string $limit：限制条数
	 * @return Object
	 * */
    public function getTable($table,$order=null,$limit=null)   //获取表数据
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get($table);
	    return $res;
	}
	
	/** 
	 * @param string $table:数据表
	 * @param array $where：条件
	 * @param string $order：排序
	 * @param string $limit：限制条数
	 * @return Object
	 */
	public function getWhere($table,$where,$order=null,$limit=null)  //安条件获取数据
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get_where($table,$where);
	    return $res;
	}
	
	/**
	 * @param string $table:数据表
	 * @param array/string $where：条件
	 * @param array/string $orwhere：或者条件
	 * @param string $order：排序
	 * @param string $limit：限制条数
	 * @return Object
	 */
	public function getORWhere($table,$where,$orwhere,$order=null,$limit=null)  //安条件获取数据
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->where($where);
	    $this->db->or_where($orwhere);
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get($table);
	    return $res;
	}
	
	/**
	 * @param string $table
	 * @param string $item
	 * @param array $arr
	 * @param array $where
	 * @param string $order
	 * @param string $limit
	 * @return Object
	 * */
	
	public function getWherein($table,$item,$arr,$where=null,$order=null,$limit=null)  //在$arr 内
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->where_in($item, $arr);
	    if(!is_empty($where)) $this->db->where($where);
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get($table);
	    return $res;
	}
	
	/**
	 * @param string $table
	 * @param string $item
	 * @param array $arr
	 * @param string $order
	 * @param string $limit
	 * @return Object
	 * */
	
	public function getWhereNotin($table,$item,$arr,$order=null,$limit=null)  //不在$arr内
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->where_not_in($item, $arr);
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get($table);
	    return $res;
	}
	
	/**
	 * @param string $table：数据表
	 * @param number $page：页数
	 * @param number $perpage：每页数量
	 * @param string $where：条件
	 * @param string $order：排序
	 * @return Object 数据
	 */
	public function getRow($table,$page,$perpage,$where=null,$order=null) 
	{
	    $order = $order ? $order : 'id desc';
	    if(!is_empty($where)) $this->db->where($where);
	    if(!empty($order)) $this->db->order_by($order);
	    $res = $this->db->get($table,$perpage,$perpage*$page);
	    return $res;
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $like：限制条件
	 * @return Object
	 */
	public function getLike($table,$like,$order=null,$limit=null)  //按条件模糊获取数据
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->like($like);
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get($table);
	    return $res;
	}
	
	/**
	 * @param string $table：数据表
	 * @param array $orlike：模糊条件
	 * @param array $where：准确条件
	 * @param string $order：排序
	 * @param number $limit：条数
	 * @return Object
	 * */
	public function getOrLike($table,$orlike,$where=null,$order=null,$limit)  //按条件模糊和准确条件获取数据
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->select('*');
	    $this->db->from($table);
	    $where_arr = array();
	    foreach($orlike as $k=>$v)
	    {
	        $where_arr[] = "`$k`"." LIKE '%".$v."%' ";
	    }
	    $where_str = implode(' OR ',$where_arr);
	    $this->db->where("($where_str)");
	    if(!empty($where)) $this->db->where($where);
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get();
	    return $res;
	}
	
	/**
	 * @param string $table：数据表
	 * @param string $distinct：查询字段
	 * @param string $group：分组
	 * @param string $where：限制条件
	 * @param string $order：排序
	 * @param number $limit：条数
	 * @return Object
	 * ---还有一种更简便：select * from table group by name---
	 * */
	public function getDistinct($table,$distinct,$group,$where=null,$order=null,$limit=null)   //查询某字段非重复数据
	{
	    $order = $order ? $order : 'id desc';
	    $this->db->select('*,count(distinct `'.$distinct.'`) as `dis`');
	    if(!empty($where)) $this->db->where($where);
	    $this->db->group_by($group);
	    $this->db->order_by($order);
	    if($limit) $this->db->limit($limit);
	    $res = $this->db->get($table);
	    return $res;
	}
	
	/** $this->db->trans_start();$this->db->trans_complete();
	 * @param string $table:数据表
	 * @param array $data：数据
	 * @return id：插入id
	 */
	public function insert($table,$data)   //插入数据
	{
	    $this->db->insert($table,$data);
	    $id = $this->db->insert_id();
	    return $id;
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $data:二维数组
	 * @return unknown
	 * */
	public function insertArray($table,$data)  //插入多条数据
	{
	    $res = $this->db->insert_batch($table,$data);
	    return $res;
	}
	
	/**
	 * @param string $table：数据表
	 * @param array $where：限制条件
	 * @param array $data：数据
	 * @return $num :影响数据条数
	 */
	public function update($table,$where,$data)  //更新数据
	{
	    $this->db->update($table,$data,$where);
	    $num = $this->db->affected_rows();
	    return $num;
	}
	
	/**
	 * @param string $table：数据表
	 * @param array $data：数据
	 * @param array $field：字段
	 * @return $num :影响数据条数
	 */
	public function updateArray($table,$data,$field) //批量更新数据
	{
	    $res = $this->db->update_batch($table,$data,$field);
	    return $res;
	}
	
	/** 
	 * @param string $table
	 * @param array $where
	 * @return $num :影响数据条数
	 */
	public function delete($table,$where)  //删除数据
	{
	    $this->db->delete($table, $where);
	    $num = $this->db->affected_rows();
	    return $num;
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $item:('id'=>$id);
	 * @return $num:影响数据条数
	 * */
	public function clickAdd($table,$where)  //投票/浏览量/点击量加1
	{
		$this->db->set('click','click +1',false);
		$this->db->where($where);
		$this->db->update($table);
		$num = $this->db->affected_rows();
		return $num;
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $where:限制条件
	 * @return $num:影响数据条数
	 */
	public function clickLess($table,$where)  //投票/浏览量/点击量减1
	{
	    $this->db->set('click','click -1',false);
	    $this->db->where($where);
	    $this->db->update($table);
	    $num = $this->db->affected_rows();
	    return $num;
	}
	
	/**
	 * @param string $table:数据表
	 * @param string/array  $data:单个字段或字段数组
	 * @return Object
	 */
	public function groupBy($table,$group,$where=null)   //分组获取数据
	{
	    if(!is_empty($where)) $this->db->where($where);
		$this->db->group_by($group);
		$res = $this->db->get($table);
		return $res;
	}
	
	/**
	 * @param string $table:数据表
	 * @param array $where:限制条件
	 * @return $num 数据条数
	 */
	public function getTableNum($table,$where=null)  //按条件获取条数
	{ 
	    if(!empty($where)) $this->db->where($where);
	    $num = $this->db->count_all_results($table);
	    return $num;
	}
	
	
	/******************************
	 * 发送邮件
	 * ***************************/
	
	/**
	 * @param string $frome:发送邮箱
	 * @param string $password:发送邮箱密码
	 * @param string $fromu:发送人
	 * @param string $toe:接受邮箱
	 * @param string $info:邮件内容
	 * @param string $copye:抄送邮箱
	 * @param string $theme:主题
	 * @param string $attach:附件
	 */
	public function sendemail($frome,$password,$fromu,$toe,$info,$copye=null,$theme=null,$attach=null)
	{
		$this->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'smtp.126.com';  //  'smtp.qq.com'  'smtp.126.com'
		$config['smtp_user'] = $frome;
		$config['smtp_pass'] = $password;
		$config['smtp_port'] = '25';
		$config['wordwrap'] = TRUE;
		$config['charset'] = 'utf-8';
		$config['validate'] = TRUE;
		$config['mailtype'] = 'html';
		$config['newline'] = "\r\n";   //重要
		$config['crlf'] = "\r\n";      //重要
		$this->email->initialize($config);
		$this->email->from($frome,$fromu);
		$this->email->to($toe);
		if($copye) $this->email->cc($copye);
		if($theme) $this->email->subject($theme);
		if($attach)
		{
			foreach($attach as $a)
			{
				$this->email->attach($a);  //参数用路径而不是URL
			}
		}
		$this->email->message($info);
		$email = $this->email->send();
// 				echo $this->email->print_debugger();
		$this->email->clear(TRUE);
		return $email;
	}
	
	
	/******************************
	 * 图片处理
	 * ***************************/
	
	/**
	 * @param string $path:上传路径
	 * @param string $maxsize:最大文件大小
	 * @param string $width:最大宽度
	 * @param string $height:最大高度
	 * @param string $type:允许上传文件类型,并修改扩展名  //文件不能为空,为空报错
	 * @return boolean|array 图片路径
	 */
	public function dealimg($path='images',$maxsize='1024',$width='1024',$height='1024',$type='gif|jpg|png|jpeg')
	{
		$this->load->library('upload'); 
		$config['upload_path'] = IMGPATH.$path.'/';
		$config['allowed_types'] = $type;
		$config['max_size'] = $maxsize;
		$config['max_width']  = $width;
		$config['max_height']  = $height;
		$config['overwrite'] = true;  
		if(empty($_FILES))
		{
		    return false;
		}else{
		    foreach($_FILES as $key=>$val)
		    {
		        $time = micdate(4);
		        $config['file_name'] = $time.'.jpg';
		        $this->upload->initialize($config);
		        if($this->upload->do_upload($key))
		        {
		            $data =  $this->upload->data();
		            $img['upload'][$key] = './'.$path.'/'.$data['file_name'];
		        }else{
		            $img['error'][$key] = $this->upload->display_errors('<p>', '</p>');
		        }
		    }
		    return $img;
		}
	}
	
	/**
	 * @param string $path:上传路径
	 * @param string $maxsize:最大文件大小
	 * @param string $width:最大宽度
	 * @param string $height:最大高度
	 * @param string $type:允许上传文件类型,并保持扩展名
	 * @return boolean|array 文件路径
	 */
	public function dealfile($path='images',$maxsize='1024',$width='1024',$height='1024',$type='gif|jpg|png|jpeg|txt|doc|docx|xls|xlsx|pdf')  
	{
		$this->load->library('upload');
		$config['upload_path'] = IMGPATH.$path.'/';         
		$config['allowed_types'] = $type;  
		$config['max_size'] = $maxsize;
		$config['max_width']  = $width;
		$config['max_height']  = $height;
		$config['overwrite'] = true;
		if(empty($_FILES))
		{
		    return false;
		}else{
    		foreach($_FILES as $key=>$val)
    		{
    			$time = micdate(4);
    			$config['file_name'] = $time;
    			$this->upload->initialize($config);   
    			if($this->upload->do_upload($key))
    			{
    				$data =  $this->upload->data();
    				$file['upload'][$key] = './'.$path.'/'.$time.$data['file_ext'];
    			}else{
    				$file['error'][$key] = $this->upload->display_errors('<p>','</p>');         // echo $error;
    			}
    		}
    		return $file;
		}
	}
	
	/**
	 * @param string $path:保存地址
	 * @param string $source:源文件路径
	 * @param string $text:水印文字
	 * @return array 图片路径
	 */
	public function waterimg($path='images',$source='./upload/company/source.png',$text)	//水印
	{
		$waterimg = './upload/'.$path.'/'.micdate(4).'.png';
		$copy = copy($source,$waterimg);
		if($copy)
		{
			$this->load->library('image_lib');
			$config['source_image'] = $waterimg;
			$config['wm_text'] = $text;
			$config['wm_type'] = 'text';
// 			$config['wm_font_path'] = './assets/css/YHBold.ttf';
			$config['wm_font_size'] = '20';
			$config['wm_font_color'] = 'ffffff';
			$config['wm_vrt_alignment'] = 'top';
			$config['wm_hor_alignment'] = 'left';
			$config['wm_vrt_offset'] = '20';
// 			$config['wm_padding'] = '20';
			$this->image_lib->initialize($config);
			if($this->image_lib->watermark())
			{
				$img['waterimg'] = $waterimg;
			}else{
				$img['error'] = $this->image_lib->display_errors('<p>','</p>');
			}
		}else{
			$img['error'] = '复制图片失败';
		}
		return $img;
	}
	
	/**
	 * 未完成此函数
	 * @param unknown $s_img
	 * @param number $width
	 * @param number $height
	 * @param number $x_axis
	 * @param number $y_axis
	 * @param string $path
	 */
	public function cropimg($s_img,$width=100,$height=100,$x_axis=30,$y_axis=30,$path='userimg')
	{
		$this->load->library('upload');
		$config['upload_path'] = './upload/'.$path.'/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['overwrite'] = true;
		foreach($_FILES as $key=>$val)
		{
			$time = micdate(4);
			$config['file_name'] = $time;
			$this->upload->initialize($config);
			if($this->upload->do_upload($key))
			{
				$data =  $this->upload->data($key);
				$file['upload'][$key] = './upload/'.$path.'/'.$time.$data['file_ext'];
				vard($data);
				
				$this->load->library('image_lib');
				$conf['image_library'] = 'gd2';
				$conf['source_image'] = './upload/'.$path.'/'.$time.$data['file_ext'];//(必须)设置原始图像的名字/路径
				$conf['new_image'] = './upload/'.$path.'/'.micdate(4).'.jpg'; //(必须)设置图像的目标名/路径。
				$conf['width'] = $width;	//(必须)设置你想要得图像宽度。
				$conf['height'] = $height;//(必须)设置你想要得图像高度
				$conf['maintain_ratio'] = FALSE;//维持比例
				$conf['x_axis'] = $x_axis;//(必须)从左边取的像素值
				$conf['y_axis'] = $y_axis;//(必须)从头部取的像素值
				$this->image_lib->initialize($conf);
				if ($this->image_lib->crop())
				{
					
				}else{
					echo $this->image_lib->display_errors();
				}
			}else{
				$file['error'][$key] = $this->upload->display_errors('<p>','</p>');         // echo $error;
			}
		}
		
		
	}
	
	/**
	 * @param string $upload:input表单域名称
	 * @param string $path:上传地址
	 * @param string $maxsize:最大文件大小
	 * @return array 文件路径
	 */
	public function dealzip($upload='zip',$path='zip',$maxsize='2048')  //压缩文件$path上传地址,$encrypt加密文件名
	{
		$time = micdate(4); 
		$this->load->library('upload');
		$config['upload_path'] = './upload/'.$path.'/';       
		$config['allowed_types'] = 'zip';
		$config['max_size'] = $maxsize;         
		$config['file_name'] = $time.'.zip';
		$this->upload->initialize($config);    //重点
		if($this->upload->do_upload($upload))
		{
			$data =  $this->upload->data($upload);
			$zip['upload'][$upload] = './upload/'.$path.'/'.$data['file_name'];
		}else{
            $zip['error'][$upload] = $this->upload->display_errors('<p>','</p>');     
        }
		return $zip;
	}
	
	
	/******************************
	 * 验证码
	 * ***************************/
	
	/**
	 * @param number $len:验证码长度
	 * @param string $width:验证码宽
	 * @param string $height:验证码高
	 * @param string $size:验证码字体大小
	 * @return 图片
	 */
	public function captcha($len=4,$width='120',$height='30',$size='30')
	{
		$this->load->helper('captcha');
		$word = randomStr($len);
		$config = array(
				'word' => $word,
				'img_path' => IMGPATH.'captcha/',
				'img_url' => 'http://img.uhelper.cn/captcha/',
				'font_path' => './path/to/fonts/texb.ttf',
				'font_size'=> $size,
				'img_width' => $width,
				'img_height' => $height,
				'expiration' => '1200',
// 		        'colors' => array(
//                     'background' => array(0, 0, 0),
//                     'border' => array(255, 255, 255),
//                     'text' => array(0, 0, 0),
//                     'grid' => array(255, 40, 40)
//                 )
		);
		return $captcha = create_captcha($config);
	}
	
	
	/******************************
	 * 短信api
	 * ***************************/
	
	/**
	 * @param string $code:验证码
	 * @param string $limit：有效期
	 * @param string $mobile：发送手机号
	 * @return array $sms：发送结果
	 * */
	public function sendSms($code,$limit,$mobile,$tempId=22680)   //发送短信
	{
	    $data = array($code,$limit);
	    $accountSid= '8a48b551510f653b0151130a74a80b19';
	    $accountToken= '90e8987ccae24a0d863af182596095bd';
	    $appId='aaf98f8952f7367a015317ced8a13d8e';
	
	    $this->load->library('REST');
	    $this->rest->setAccount($accountSid,$accountToken);
	    $this->rest->setAppId($appId);
	    $result = objectToArray($this->rest->sendTemplateSMS($mobile,$data,$tempId));
	    
	    $apiList = getApiList();
	    $api['api'] = $apiList[0];  //短信通知
	    $api['request'] = '用户：'.$mobile.'，短信模板：'.$tempId;
	    $api['time'] = time();
	    if($result == NULL) {
	        $sms['status'] = false;
	        $sms['res'] = $api['status'] = '短信api返回null';
	    }
	    if($result['statusCode'] != '000000')
	    {
	        $sms['status'] = false;
	        $sms['res'] = $result;
	        $api['status'] = '错误码：'.$result['statusCode'].'，错误消息：'.$result['statusMsg'];
	    }else{
	        $sms['status'] = true;
	        $sms['res'] = strtotime($result['TemplateSMS']['dateCreated']);
	        $api['status'] = '发送成功';
	    }
	    $this->insert('api_request',$api);
	    return $sms;
	}
	
	
	/******************************
	 * 极光推送
	 * ***************************/
	
	/**
	 * @param string $msg:消息内容
	 * @param string $title:消息标题
	 * @param array $alia:别名
	 * @param array $tag:标签
	 * @param array $extra:扩展字段
	 * @param array $plat:推送平台
	 * @return blean $send：发送结果
	 */
	public function sendPush($msg,$title,$alia=array(),$tag=array(),$extra=array(),$plat=array('ios','android'))  //极光推送
	{
	    ini_set("display_errors", "On");
	    error_reporting(E_ALL | E_STRICT);
	    $this->load->library('JPush');
	
	    // 完整的推送示例,包含指定Platform,指定Alias,Tag,指定iOS,Android notification,指定Message等
	    if(empty($alia) && empty($tag))
	    {
	        $result = $this->jpush->push()->setPlatform($plat)->addAllAudience();
	        $api['request'] = '用户：ALL';
	    }else{
	        $result = $this->jpush->push()->setPlatform($plat)->addAlias($alia)->addTag($tag);
	        $api['request'] = '用户别名(id)：'.var_export($alia,true).'，标签：'.var_export($tag,true);
	    }
    	$res = $result->setNotificationAlert($msg)
    	    ->addAndroidNotification($msg, $title,1,$extra)
    	    ->addIosNotification($msg, 'iOS sound', JPush::DISABLE_BADGE, true, 'iOS category', $extra)
// 	        ->setMessage("msg content", 'msg title', 'type', array("key1"=>"value1", "key2"=>"value2"))
    	    ->setOptions(null, 86400, null, false)
    	    ->send();
	    $apiList = getApiList();
	    $api['api'] = $apiList[1];  //api接口 极光推送
	    $api['time'] = time();
	    if(isset($res->data))
	    {
	        $api['status'] = '推送成功';
	        $push = true;
	    }else{
	        $api['status'] = '推送失败';
	        $push = false;
	    }
	    $this->insert('api_request',$api);
	    return $push;
	}


}
?>