<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaksi_model');
        $this->load->model('type_model');
        $this->load->model('car_model');
        $this->load->model('paket_model');
        $this->load->model('driver_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 3) {
            redirect('admin/dashboard');
        }
    }
    public function index()
    {

        $config['base_url']       = base_url('admin/transaksi/index/');
        $config['total_rows']     = count($this->transaksi_model->total_row_transaksi());
        $config['per_page']       = 10;
        $config['uri_segment']    = 4;

        //Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';


        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);


        $keyword = $this->input->post('keyword');//Pentransaksiian Driver
        $transaksi = $this->transaksi_model->get_alltransaksi($limit, $start, $keyword);
        $data = [
            'title'                     => 'Data Driver',
            'transaksi'                 => $transaksi,
            'pagination'                => $this->pagination->create_links(),
            'content'                   => 'admin/transaksi/index_transaksi'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function create()
    {
        $car = $this->car_model->get_car();
        $paket = $this->paket_model->get_allpaket();
        $driver = $this->driver_model->get_driver();
        $this->form_validation->set_rules(
            'harga',
            'Harga Sewa',
            'required',
            [
                'required'      => 'Harga Sewa harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'down_payment',
            'DP Sewa',
            'required',
            [
                'required'      => 'DP Harus di isi Atau 0',
            ]
        );
        $this->form_validation->set_rules(
            'uang_makan_inv',
            'Uang makan',
            'required',
            [
                'required'      => 'Uang Makan Harus di isi Atau 0',
            ]
        );
        $this->form_validation->set_rules(
            'uang_inap_inv',
            'Uang Inap',
            'required',
            [
                'required'      => 'Uang Inap Harus di isi Atau 0',
            ]
        );

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Data Driver',
                'car'                   => $car,
                'paket'                 => $paket,
                'driver'                => $driver,
                'content'               => 'admin/transaksi/create_transaksi'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{

            $total_harga = $this->input->post('long_term')*$this->input->post('harga');

            $data  = [
                'user_id'                   => $this->session->userdata('id'),
                'paket_id'                  => $this->input->post('paket_id'),
                'car_name'                  => $this->input->post('car_name'),
                'driver_id'                 => $this->input->post('driver_id'),
                'kode_transaksi'            => $this->input->post('kode_transaksi'),
                'start_date'                => $this->input->post('start_date'),
                'end_date'                  => $this->input->post('end_date'),
                'user_name'                 => $this->input->post('user_name'),
                'user_phone'                => $this->input->post('user_phone'),
                'user_address'              => $this->input->post('user_address'),
                'payment_method'            => $this->input->post('payment_method'),
                'payment_status'            => $this->input->post('payment_status'),
                'long_term'                 => $this->input->post('long_term'),
                'harga'                     => $this->input->post('harga'),
                'total_harga'               => $total_harga,
                'down_payment'              => $this->input->post('down_payment'),
                'uang_makan_inv'            => $this->input->post('uang_makan_inv'),
                'uang_inap_inv'             => $this->input->post('uang_inap_inv'),
                'kas_keluar'                => 0,
                'tipe_transaksi'            => 'Pemasukan',
                'kas_tanggal'               => $this->input->post('kas_tanggal'),
                'date_created'              => time()
            ];
            $this->transaksi_model->create($data);
            $this->session->set_flashdata('message', 'Data Transaksi telah ditambahkan');
            redirect(base_url('admin/transaksi'), 'refresh');
        }
    }
    public function view($id)
    {
      $car = $this->car_model->get_car();
      $paket = $this->paket_model->get_allpaket();
      $driver = $this->driver_model->get_driver();
      $transaksi = $this->transaksi_model->read($id);
      $data = [
          'title'                 => 'Tambah Data Driver',
          'car'                   => $car,
          'paket'                 => $paket,
          'driver'                => $driver,
          'transaksi'             => $transaksi,
          'content'               => 'admin/transaksi/view_transaksi'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    public function print($id)
    {
      $car = $this->car_model->get_car();
      $paket = $this->paket_model->get_allpaket();
      $driver = $this->driver_model->get_driver();
      $transaksi = $this->transaksi_model->read($id);
      $data = [
          'title'                 => 'Tambah Data Driver',
          'car'                   => $car,
          'paket'                 => $paket,
          'driver'                => $driver,
          'transaksi'             => $transaksi,
          'content'               => 'admin/transaksi/print_transaksi'
      ];
      $this->load->view('admin/transaksi/print_transaksi', $data, FALSE);
    }

    // Update Driver
    public function update($id)
    {
        $transaksi = $this->transaksi_model->read($id);
        $this->form_validation->set_rules(
            'transaksi_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama harus di isi',
            ]
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Update Data Driver',
                'transaksi'                => $transaksi,
                'content'               => 'admin/transaksi/update_transaksi'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{

            $data  = [
                'id'                        => $id,
                'transaksi_name'               => $this->input->post('transaksi_name'),
                'transaksi_phone'              => $this->input->post('transaksi_phone'),
                'transaksi_age'                => $this->input->post('transaksi_age'),
                'transaksi_status'             => $this->input->post('transaksi_status'),
                'date_updated'              => time()
            ];
            $this->transaksi_model->update($data);
            $this->session->set_flashdata('message', 'Data Driver telah di update');
            redirect(base_url('admin/transaksi'), 'refresh');
        }

    }

    //DELETE
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $list_pelanggan = $this->user_model->read($id);

        $data = ['id'   => $list_pelanggan->id];
        $this->user_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    //Banned User
  public function banned($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                          => $id,
      'transaksi_status'               => 'Inactive',
    ];
    $this->transaksi_model->update($data);
    $this->session->set_flashdata('message', 'Driver Telah di banned');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function activated($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                          => $id,
      'transaksi_status'               => 'Active',
    ];
    $this->transaksi_model->update($data);
    $this->session->set_flashdata('message', 'Driver Telah di Aktifkan');
    redirect($_SERVER['HTTP_REFERER']);
  }

}
