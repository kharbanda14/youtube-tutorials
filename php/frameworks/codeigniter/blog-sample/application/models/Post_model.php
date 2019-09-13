<?php

class Post_model extends CI_Model
{

    public function create_post($data)
    {
        $this->db->insert('posts', $data);
        return $this->db->insert_id();
    }

    public function get_post($id)
    {
        return $this->db->where('id', $id)->get('posts')->row();
    }

    public function update_post($id, $data)
    {
        return $this->db->where('id', $id)->update('posts', $data);
    }

    public function all()
    {
        return $this->db->get('posts')->result();
    }

    public function get_where($where)
    {
        return $this->db->where($where)->get('posts')->row();
    }

    public function delete_post($id)
    {
        return $this->db->where('id', $id)->delete('posts');
    }

}
