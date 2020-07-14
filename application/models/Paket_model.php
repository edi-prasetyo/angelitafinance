<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_paket($keyword)
    {
        $this->db->select('*');
        $this->db->from('paket');
        $this->db->like('paket_name',$keyword);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_allpaket()
    {
        $this->db->select('*');
        $this->db->from('paket');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_paket_pengeluaran()
    {
        $this->db->select('*');
        $this->db->from('paket');
        $this->db->where('paket_type', 'Pengeluaran');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function detail_paket($id)
    {
        $this->db->select('*');
        $this->db->from('paket');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($paket_slug)
    {
        $this->db->select('*');
        $this->db->from('paket');
        // Join

        //End Join
        $this->db->where(array(
            'paket.paket_slug'      =>  $paket_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('paket', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('paket', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('paket', $data);
    }
}
