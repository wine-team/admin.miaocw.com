<?php
/**
 * 发送邮件
 * @param string $mail_to
 * @param string $mail_subject
 * @param string $mail_message
 * @param string $mail_from
 * @param string $mail_name
 */
function sendEmails($mail_to, $mail_subject, $mail_message, $mail_from, $mail_name='')
{
    $CI = & get_instance();
    $CI->load->library('email');
    $config['protocol'] = 'sendmail';
    $config['charset'] = 'utf-8';
    $config['wordwrap'] = TRUE;
    $config['mailtype'] = 'html';
    $CI->email->initialize($config);
    
    $CI->email->from($mail_from, $mail_name);
    $CI->email->to($mail_to);
    $CI->email->subject($mail_subject);
    $CI->email->message($mail_message);
    $CI->email->send();
    $CI->email->clear();
}

/**
 * Validate email address
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('valid_email'))
{
	function valid_email($address)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $address)) ? FALSE : TRUE;
	}
}

/**
 * Send an email
 *
 * @access	public
 * @return	bool
 */
if ( ! function_exists('send_email'))
{
    function send_email($recipient, $subject = 'Test email', $message = 'Hello World')
    {
        return mail($recipient, $subject, $message);
    }
}