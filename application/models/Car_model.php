
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car_model extends CI_Model
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
        $this->db->from('car');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function count_car()
    {
        $this->db->select('*');
        $this->db->from('car');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_allcar($limit, $start, $keyword)
    {
        $this->db->select('*');
        $this->db->from('car');
        $this->db->like('car_name',$keyword);

        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function create($data)
    {
        $this->db->insert('car', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('car', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('car', $data);
    }
    //  Driver Read
    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('car');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    //Total Row Pelanggan
    public function total_row_car()
    {
        $this->db->select('*');
        $this->db->from('car');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // SEARCH Driver
    public function get_car_keyword($keyword){
        $this->db->select('*');
        $this->db->from('car');
        $this->db->like('car_name',$keyword);
        $this->db->or_like('car_phone',$keyword);
        return $this->db->get()->result();
    }


}
