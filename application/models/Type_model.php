
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Type_model extends CI_Model
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
        $this->db->from('type');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function count_type()
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_alltype($limit, $start, $keyword)
    {
        $this->db->select('type.*, brand.brand_name');
        $this->db->from('type');
        // Join
        $this->db->join('brand', 'brand.id = type.brand_id', 'LEFT');
        // End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function create($data)
    {
        $this->db->insert('type', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('type', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('type', $data);
    }
    //  Driver Read
    public function read($id)
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    //Total Row Pelanggan
    public function total_row_type()
    {
        $this->db->select('*');
        $this->db->from('type');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // SEARCH Driver
    public function get_type_keyword($keyword){
        $this->db->select('*');
        $this->db->from('type');
        $this->db->like('type_name',$keyword);
        $this->db->or_like('type_phone',$keyword);
        return $this->db->get()->result();
    }


}
