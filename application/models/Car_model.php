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
    public function get_car()
    {
        $this->db->select('car.*, type.type_name');
        $this->db->from('car');
        // Join
        $this->db->join('type', 'type.id = car.type_id', 'LEFT');
        // End Join
        $this->db->where(['car_status' => 'Active']);
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
        $this->db->select('car.*, type.type_name');
        $this->db->from('car');
        // Join
        $this->db->join('type', 'type.id = car.type_id', 'LEFT');
        // End Join
        $this->db->like('car_number',$keyword);
        $this->db->order_by('car_status', 'ASC');
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
    //  Car Read
    public function read($id)
    {
        $this->db->select('car.*, type.type_name');
        $this->db->from('car');
        // Join
        $this->db->join('type', 'type.id = car.type_id', 'LEFT');
        // End Join
        $this->db->where('car.id', $id);
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
    // SEARCH Car
    public function get_car_keyword($keyword){
        $this->db->select('*');
        $this->db->from('car');
        $this->db->like('car_name',$keyword);
        $this->db->or_like('car_phone',$keyword);
        return $this->db->get()->result();
    }


}
