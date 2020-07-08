<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function listUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function count_pelanggan()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where(['role_id'     =>  3]);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_allpelanggan($limit, $start, $keyword)
    {
        $this->db->select('user.*, user_role.role');
        $this->db->from('user');
        // join
        $this->db->join('user_role', 'user_role.id = user.role_id', 'LEFT');
        // End Join
        
        $this->db->like('user_name',$keyword);
        $this->db->or_like('user_phone',$keyword);
        $this->db->where('role_id', 3);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function user_detail()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where(array(
            'user.email'    => $this->session->userdata('email')
        ));
        $query = $this->db->get();
        return $query->row();
    }
    public function create($data)
    {
        $this->db->insert('user', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('user', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('user', $data);
    }

    // Dashboard

    public function get_pelanggan()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 3);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Product User Read
    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    //Total Row Pelanggan
    public function total_row_pelanggan()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where(['role_id'     =>  3]);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // SEARCH PELANGGAN
    public function get_user_keyword($keyword){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->like('user_name',$keyword);
        $this->db->or_like('user_phone',$keyword);
        $this->db->where(['role_id'     =>  3]);
        return $this->db->get()->result();
    }

    // GET DATA AUTOCOMPLETE
    function search_blog($title)
    {
        $this->db->like('user_phone', $title, 'both');
        $this->db->order_by('id', 'ASC');
        $this->db->limit(10);
        return $this->db->get('user')->result();
    }

}
