<?php
class User_account_model extends CI_Model
{
    private $table   = 'user_account';
    private $table_1 = 'user';

    public function add($postData, $uid)
    {
        $data = array(
            'uid'               => $uid,
            'over_beizhu'       => !empty($postData['over_beizhu']) ? (float)$postData['over_beizhu'] : 0,
            'poundage'          => !empty($postData['poundage']) ? (float)$postData['poundage'] : 0,
            'bargaining'        => !empty($postData['bargaining']) ? (int)$postData['bargaining'] : 0,
            'amount_carry'      => 0,
            'amount_settlement' => 0,
            'amount_bonus'      => ttrim($postData, 'amount_bonus', 0),
            'amount_month'      => 0,
            'outlay_total'      => 0,
            'income_total'      => 0,
            'outlay_history'    => '',
            'income_history'    => '',
            'rank'              => 0
        );
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function update($postData)
    {
        $data = array(
            'over_beizhu' => $postData['over_beizhu'],
            'poundage'    => $postData['poundage'],
            'bargaining'  => $postData['bargaining'],
        );
        $this->db->where('uid', $postData['uid']);
        return  $this->db->update($this->table, $data);
    }
    
    public function delete($id)
    {
        return $this->db->delete($this->table, array('uid'=>$id));
    }
    
    public function findByUid($uid)
    {
        $this->db->where('uid', $uid);
        $result = $this->db->get($this->table);
        if($result->num_rows() > 0){
            return $result;
        }
        return false;
    }
    
    public function updateUserAcount($uid, $account=array())
    {
        $data = array();
        if (!empty($account['amount_month'])) {
            $this->db->set('amount_month', 'amount_month-'.$account['amount_month'], FALSE);
        }
        if (!empty($account['amount_carry'])) {
            $this->db->set('amount_carry', 'amount_carry+'.$account['amount_carry'], FALSE);
        }
        if (!empty($account['amount_bonus'])) {
            $this->db->set('amount_bonus', 'amount_bonus+'.$account['amount_bonus'], FALSE);
        }
        $this->db->where('uid', $uid);
        return $this->db->update($this->table, $data);
    }

    public function findByRechargeTotal($data = array())
    {
        $this->db->select('*');
        $this->db->from($this->table_1.' AS user');
        $this->db->join($this->table.' AS user_account', 'user.uid=user_account.uid', 'inner');
        if(isset($data['userName']) && $data['userName']){
            $this->db->like('user.user_name', $data['userName']);
            $this->db->or_like('user.alias_name',  $data['userName']);
        }
        return $this->db->count_all_results();
    }
    
    public function findByRecharge($num, $data = array())
    {
        $this->db->select('*');
        $this->db->from($this->table_1.' AS user');
        $this->db->join($this->table.' AS user_account', 'user.uid=user_account.uid', 'inner');
        if(isset($data['userName']) && $data['userName']){
            $this->db->like('user.user_name', $data['userName']);
            $this->db->or_like('user.alias_name',  $data['userName']);
        }
        $this->db->limit(20, $num);
        $result = $this->db->get();
        if($result->num_rows() > 0){
            return $result;
        }
        return false;
    }
    
    public function updateUserAccount($uid, $amount_carry)
    {
        $data = array(
            'amount_carry' => $amount_carry,
        );
        $this->db->where('uid', $uid);
        return $this->db->update($this->table, $data);
    }
}