<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //listing Pendaftaran
    public function get_driver()
    {
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->where(['driver_status' => 'Active']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function count_driver()
    {
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_alldriver($limit, $start, $keyword)
    {
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->like('driver_name',$keyword);
        $this->db->or_like('driver_phone',$keyword);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function create($data)
    {
        $this->db->insert('driver', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('driver', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('driver', $data);
    }
    //  Driver Read
    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    //Total Row Pelanggan
    public function total_row_driver()
    {
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // SEARCH Driver
    public function get_driver_keyword($keyword){
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->like('driver_name',$keyword);
        $this->db->or_like('driver_phone',$keyword);
        return $this->db->get()->result();
    }


}
