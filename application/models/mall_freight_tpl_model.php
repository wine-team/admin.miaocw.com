<?php
class Mall_freight_tpl_model extends CI_Model
{
    private $table   = 'mall_freight_tpl';
    private $table_2 = 'mall_freight_price';
    private $table_3 = 'user';

    public function total($param)
    {
        $this->db->from($this->table.' AS mall_freight_tpl');
        $this->db->join($this->table_3.' AS user', 'mall_freight_tpl.uid = user.uid');
        if (!empty($param['name'])) {
            $this->db->like('mall_freight_tpl.name', $param['name']);
        }
        if (!empty($param['uid'])) {
            $this->db->where('user.uid', (int)$param['uid']);
        }
        if (!empty($param['provider_name'])) {
            $this->db->like('user.phone', $param['provider_name']);
            $this->db->or_like('user.email', $param['provider_name']);
        }
        return $this->db->count_all_results();
    }

    public function page_list($page_num, $num, $param = array())
    {
        $this->db->select('user.phone,user.email,user.uid,mall_freight_tpl.*');
        $this->db->from($this->table.' AS mall_freight_tpl');
        $this->db->join($this->table_3.' AS user', 'mall_freight_tpl.uid = user.uid');
        if (!empty($param['name'])) {
            $this->db->like('mall_freight_tpl.name', $param['name']);
        }
        if (!empty($param['uid'])) {
            $this->db->where('user.uid', (int)$param['uid']);
        }
        if (!empty($param['provider_name'])) {
        	$this->db->like('user.phone', $param['provider_name']);
        	$this->db->or_like('user.email', $param['provider_name']);
        }
        $this->db->order_by('mall_freight_tpl.freight_id', 'DESC');
        $this->db->limit($page_num, $num);
        return $this->db->get();
    }

    public function add($template_param, $list_params)
    {
        $this->db->insert($this->table, $template_param);
        $insert_id = $this->db->insert_id();
        if (!$insert_id) {
            return false;
        }
        foreach ($list_params as $key => $item) {
            $list_params[$key]['freight_id'] = $insert_id;
            $item['freight_id'] = $insert_id;
            $this->db->insert($this->table_2, $item);
        }
        return $insert_id;
    }

    public function delete($id)
    {
        $this->db->where('freight_id', $id);
        $delete_id = $this->db->delete($this->table);
        
        $this->db->where('freight_id', $id);
        $this->db->delete($this->table_2);
        return $delete_id ? $delete_id : 0;
    }

    public function getTemplate($id = 0)
    {
        $this->db->select('u.phone,u.email,t.*');
        $this->db->from($this->table . ' as t');
        $this->db->join($this->table_3 . ' as u', 't.uid = u.uid');
        $this->db->where('freight_id', $id);
        return $this->db->get();
    }

    public function update($id, $template_param, $list_params)
    {
        $this->db->where('freight_id', $id);
        $this->db->update($this->table, $template_param);

        $this->db->where('freight_id', $id);
        $this->db->delete($this->table_2);

        foreach ($list_params as $key => $item) {
            $list_params[$key]['freight_id'] = $id;
            $item['freight_id'] = $id;
            $this->db->insert($this->table_2, $item);
        }
        return $id;
    }

    public function getTransport($uid = 0)
    {
        $this->db->where('uid', $uid);
        return $this->db->get($this->table);
    }
}