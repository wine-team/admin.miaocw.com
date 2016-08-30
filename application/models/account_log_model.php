<?php
class Account_log_model extends CI_Model
{
    private $table = 'account_log';

    public function total($params=array()) 
    {
        if (!empty($params['uid'])) {
            $this->db->where('uid', $params['uid']);
        }
        if (!empty($params['order_id'])) {
            $this->db->where('order_id', $params['order_id']);
        }
        if (!empty($params['account_type'])) {
            $this->db->where('account_type', $params['account_type']);
        }
        if (!empty($params['flow'])) {
            $this->db->where('flow', $params['flow']);
        }
        if (!empty($params['trade_type'])) {
            $this->db->where('trade_type', $params['trade_type']);
        }
        if (!empty($param['start_date'])) {
            $this->db->where(array('created_at >' => $param['start_date']));
        }
        if (!empty($param['end_date'])) {
            $this->db->where(array('created_at <=' => $param['end_date']));
        }
        return $this->db->count_all_results($this->table);
    }

    public function page_list($page_num, $num, $params=array())
    {
        if (!empty($params['uid'])) {
            $this->db->where('uid', $params['uid']);
        }
        if (!empty($params['order_id'])) {
            $this->db->where('order_id', $params['order_id']);
        }
        if (!empty($params['account_type'])) {
            $this->db->where('account_type', $params['account_type']);
        }
        if (!empty($params['flow'])) {
            $this->db->where('flow', $params['flow']);
        }
        if (!empty($params['trade_type'])) {
            $this->db->where('trade_type', $params['trade_type']);
        }
        if (!empty($param['start_date'])) {
            $this->db->where(array('created_at >' => $param['start_date']));
        }
        if (!empty($param['end_date'])) {
            $this->db->where(array('created_at <=' => $param['end_date']));
        }
        $this->db->order_by('log_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get($this->table);
    }

    public function insertAccountLogRecord($uid,$order_id,$account_type,$flow,$trade_type,$amount,$note)
    {
        //记录现金流
        $data = array(
            'uid'          => $uid,
            'order_id'     => $order_id,
            'account_type' => $account_type, //账户
            'flow'         => $flow, // 退款
            'trade_type'   => $trade_type, // 退款
            'amount'       => $amount,
            'note'         => $note,
            'created_at'   => date('Y-m-d H:i:s')
        );
        return $this->db->insert($this->table, $data);
    }
}