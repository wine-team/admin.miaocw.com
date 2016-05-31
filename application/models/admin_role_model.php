<?php
class Admin_role_model extends CI_Model
{
    private $table = 'admin_role';

    public function find($isArray=false)
    {
        $result = $this->db->get($this->table);
        if ($isArray) {
            $rows = array();
            foreach ($result->result_array() as $row) {
                $rows[$row['id']] = $row;
            }
            return $rows;
        }
        return $result;
    }

    public function findById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    public function total()
    {
        return $this->db->count_all_results($this->table);
    }

    public function page_list($pageNum, $num)
    {
        $this->db->order_by('id', 'asc');
        $this->db->limit($pageNum, $num);
        return $this->db->get($this->table);
    }

    public function deleteById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    function updateRole($role_id, $name, $action_list)
    {
        $data = array(
            'name'        => $name,
            'action_list' => $action_list,
            'updated_at'  => date('Y-m-d H:i:s', time())
        );

        $this->db->where('id', $role_id);
        return $this->db->update($this->table, $data);
    }

    function updateRoleMenuId($role_id, $menu_id)
    {
        $data = array(
            'menu_id'    => $menu_id,
            'updated_at' => date('Y-m-d H:i:s', time())
        );

        $this->db->where('id', $role_id);
        return $this->db->update($this->table, $data);
    }

    function insertRole($name, $action_list)
    {
        $data = array(
            'name'        => $name,
            'action_list' => $action_list,
            'created_at'  => date('Y-m-d H:i:s', time()),
            'updated_at'  => date('Y-m-d H:i:s', time())
        );

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}