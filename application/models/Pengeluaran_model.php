<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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
        $this->db->where('tipe_transaksi', 'Pemasukan');
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

    //Total Row Transaksi
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

    // FUNGSI HALAMAN FINANCE

    public function get_pemasukan($limit, $start)
    {
        $this->db->select('transaksi.*, driver.driver_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('driver', 'driver.id = transaksi.driver_id', 'LEFT');
        // End Join
        $this->db->where('tipe_transaksi', 'Pemasukan');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_pengeluaran($limit, $start)
    {
        $this->db->select('transaksi.*, driver.driver_name, category_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('driver', 'driver.id = transaksi.driver_id', 'LEFT');
        $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
        // End Join
        $this->db->where('tipe_transaksi', 'Pengeluaran');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_hutang($limit, $start)
    {
        $this->db->select('transaksi.*, driver.driver_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('driver', 'driver.id = transaksi.driver_id', 'LEFT');
        // End Join
        $this->db->where('payment_status', 'Hutang');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    // Detail pemasukan
    public function detail_pemasukan($id)
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
    public function detail_pengeluaran($id)
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
    //Total Row Pemasukan
    public function total_row_pemasukan()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function total_row_hutang()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    // PENJUMLAHAN
    //Total Semua Kas Masuk
    public function total_pemasukan()
    {
        $this->db->select_sum('total_harga');
        $this->db->where('tipe_transaksi', 'Pemasukan');
        $query = $this->db->get('transaksi');
        if ($query->num_rows() > 0) {
            return $query->row()->total_harga;
        } else {
            return 0;
        }
    }
    public function total_hutang()
    {
        $this->db->select_sum('kas_masuk');
        $this->db->where('payment_status', 'Hutang');
        $query = $this->db->get('transaksi');
        if ($query->num_rows() > 0) {
            return $query->row()->kas_masuk;
        } else {
            return 0;
        }
    }
    // Count Pemasukan Update
    public function count_pemasukan()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('payment_status', 'Hutang');
        $this->db->or_where('payment_status', 'Proses');
        $query = $this->db->get();
        return $query->num_rows();
    }
    //Total Semua Kas Keluar
    public function total_pengeluaran()
    {
        $this->db->select_sum('kas_keluar');
        $this->db->where('tipe_transaksi', 'Pengeluaran');
        $query = $this->db->get('transaksi');
        if ($query->num_rows() > 0) {
            return $query->row()->kas_keluar;
        } else {
            return 0;
        }
    }

    // Total Semua Kas
    public function get_allkas($limit, $start)
    {
        $this->db->select('transaksi.*, driver.driver_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('driver', 'driver.id = transaksi.driver_id', 'LEFT');
        // End Join
        // $this->db->like('kode_transaksi',$keyword);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Row Transaksi
    public function total_row_kas()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // FILTER
    // Filter Semua Pemasukan
    public function filter_alpemasukan($startdate, $enddate)
    {

        $this->db->select('transaksi.*,
        category.category_name, user.user_name');
        $this->db->from('transaksi');
        // JOIN
        $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
        $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
        // END JOIN
        $this->db->where('kas_tanggal >=', $startdate);
        $this->db->where('kas_tanggal <=', $enddate);
        $this->db->where('tipe_transaksi', 'Pemasukan');
        $this->db->order_by('transaksi.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function total_pemasukan_aldate($startdate, $enddate)
    {
        $this->db->select_sum('kas_masuk');
        $this->db->where('kas_tanggal >=', $startdate);
        $this->db->where('kas_tanggal <=', $enddate);
        $query = $this->db->get('transaksi');
        if ($query->num_rows() > 0) {
            return $query->row()->kas_masuk;
        } else {
            return 0;
        }
    }
    // Filter Semua Pengeluaran
    public function filter_alpengeluaran($startdate, $enddate)
    {

        $this->db->select('transaksi.*,
        category.category_name, user.user_name');
        $this->db->from('transaksi');
        // JOIN
        $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
        $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
        // END JOIN
        $this->db->where('kas_tanggal >=', $startdate);
        $this->db->where('kas_tanggal <=', $enddate);
        $this->db->where('tipe_transaksi', 'Pengeluaran');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    // KAS
     // Filter By Date Only
     public function searchalkas($startdate, $enddate)
     {

         $this->db->select('transaksi.*,
         category.category_name, user.user_name');
         $this->db->from('transaksi');
         // join
         $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
         $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
         // End Join
         $this->db->where('kas_tanggal >=', $startdate);
         $this->db->where('kas_tanggal <=', $enddate);
         $this->db->order_by('transaksi.kas_tanggal', 'DESC');
         $query = $this->db->get();
         return $query->result();
     }

     //Total Semua Kas Keluar
     public function total_pengeluaran_aldate($startdate, $enddate)
     {
         $this->db->select_sum('kas_keluar');
         $this->db->where('kas_tanggal >=', $startdate);
         $this->db->where('kas_tanggal <=', $enddate);
         $query = $this->db->get('transaksi');
         if ($query->num_rows() > 0) {
             return $query->row()->kas_keluar;
         } else {
             return 0;
         }
     }




}
