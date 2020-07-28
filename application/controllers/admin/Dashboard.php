<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('transaksi_model');
        $this->load->model('driver_model');

        // $id = $this->session->userdata('id');
        // $user = $this->user_model->user_detail($id);
        // if ($user->role_id == 2) {
        //     redirect('admin/dashboard');
        // }
    }

    public function index()
    {


        $list_user              = $this->user_model->listUser();
        $pelanggan              = $this->user_model->count_pelanggan();
        $transaksi              = $this->transaksi_model->count_transaksi();
        $driver                 = $this->driver_model->count_driver();
        $total_pemasukan        = $this->transaksi_model->total_pemasukan();
        $total_pengeluaran      = $this->transaksi_model->total_pengeluaran();
        // $pengeluaran            = $this->transaksi_model->count_pengeluaran();

        $data = [
            'title'             => 'Dashboard',
            'list_user'         => $list_user,
            'pelanggan'         => $pelanggan,
            'transaksi'         => $transaksi,
            'driver'            => $driver,
            'total_pemasukan'   => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'content'           => 'admin/dashboard/dashboard'

        ];

        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
}
