<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_brand()
    {
        $this->db->select('*');
        $this->db->from('brand');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_brand_donasi()
    {
        $this->db->select('*');
        $this->db->from('brand');
        $this->db->where('brand_type', 'Donasi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_brand_pengeluaran()
    {
        $this->db->select('*');
        $this->db->from('brand');
        $this->db->where('brand_type', 'Pengeluaran');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_brand($id)
    {
        $this->db->select('*');
        $this->db->from('brand');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($brand_slug)
    {
        $this->db->select('*');
        $this->db->from('brand');
        // Join

        //End Join
        $this->db->where(array(
            'brand.brand_slug'      =>  $brand_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('brand', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('brand', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('brand', $data);
    }
}
