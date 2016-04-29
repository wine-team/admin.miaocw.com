<?php
class Role_model extends CI_Model
{
    private $table = 'role';
        
    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    public function find()
    {
    	return $this->db->get($this->table);
    }
    
    public function total()
    {
        return $this->db->count_all_results($this->table);
    }
    
    public function page_list($num)
    {
        $this->db->order_by('id','asc');
        $this->db->limit(20, $num);
        return $this->db->get($this->table);
    }
    
    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
    
    function updateRole($role_id, $name)
    {
        $data = array(
            'name'        => $name,
            'updated_at'  => date('Y-m-d H:i:s', time())
        );
        
        $this->db->where('id', $role_id);
        return $this->db->update('role', $data);
    }
    
    function insertRole($name, $action_list)
    {
        $data = array(
            'name'        => $name,
            'created_at'  => date('Y-m-d H:i:s', time()),
            'updated_at'  => date('Y-m-d H:i:s', time())
        );
    
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}