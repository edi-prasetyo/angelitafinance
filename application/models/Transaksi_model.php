<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
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
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function count_transaksi()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_alltransaksi($limit, $start, $keyword)
    {
        $this->db->select('transaksi.*, driver.driver_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('driver', 'driver.id = transaksi.driver_id', 'LEFT');
        // End Join
        $this->db->like('kode_transaksi',$keyword);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function create($data)
    {
        $this->db->insert('transaksi', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaksi', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('transaksi', $data);
    }
    //  Transaksi Read
    public function read($id)
    {
        $this->db->select('transaksi.*, driver.driver_name, paket.paket_term, paket.paket_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('driver', 'driver.id = transaksi.driver_id', 'LEFT');
        $this->db->join('paket', 'paket.id = transaksi.paket_id', 'LEFT');
        // End Join
        $this->db->where('transaksi.id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    //Total Row Pelanggan
    public function total_row_transaksi()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // SEARCH Transaksi
    public function get_transaksi_keyword($keyword){
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->like('transaksi_name',$keyword);
        $this->db->or_like('transaksi_phone',$keyword);
        return $this->db->get()->result();
    }


}
