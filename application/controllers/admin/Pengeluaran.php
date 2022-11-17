<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends CI_Controller
{
    //load Model & Library
    public function __construct()
    {
        parent::__construct();
        $this->load->model('kas_model');
        $this->load->model('category_model');
        $this->load->model('user_model');
        $this->load->model('transaksi_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //listing data Pemasukan
    public function index()
    {

        $config['base_url']       = base_url('admin/pengeluaran/index/');
        $config['total_rows']     = count($this->kas_model->total_row_pengeluaran());
        $config['per_page']       = 3;
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


        $pengeluaran                = $this->transaksi_model->get_pengeluaran($limit, $start);
        $total_pengeluaran          = $this->transaksi_model->total_pengeluaran();
        $data = [
            'title'                 => 'Data Pengeluaran',
            'pengeluaran'           => $pengeluaran,
            'total_pengeluaran'     => $total_pengeluaran,
            'pagination'            => $this->pagination->create_links(),
            'content'               => 'admin/pengeluaran/index_pengeluaran'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Filter Semua Pengeluaran
    public function filter_alpengeluaran()
    {
        // $startdate = '2020-04-26';
        // $enddate = '2020-04-25';

        // $startdate = $this->input->post('start_date');
        // $enddate = $this->input->post('end_date');


        $startdate = "";
        $enddate = "";


        if (isset($_POST['start_date'])) {
            $startdate = $_POST['start_date'];
        }

        if (isset($_POST['end_date'])) {
            $enddate = $_POST['end_date'];
        }

        $filter_alpengeluaran            = $this->transaksi_model->filter_alpengeluaran($startdate, $enddate);
        $total_pengeluaran_aldate        = $this->transaksi_model->total_pengeluaran_aldate($startdate, $enddate);



        // $total_pemasukan        = $this->kas_model->total_pemasukan();
        // $total_pengeluaran      = $this->kas_model->total_pengeluaran();

        $data = [
            'title'                     => 'Data Pengeluaran tanggal',
            'filter_pengeluaran'        => $filter_alpengeluaran,
            'total_pengeluaran_date'    => $total_pengeluaran_aldate,
            'content'                   => 'admin/pengeluaran/filter_alpengeluaran'
        ];

        $this->session->set_flashdata('messagefilter',  'Menampilkan Data dari Tanggal ' . $startdate . ' Sampai Tanggal ' .$enddate);
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //Buat Data Pengeluaran
    public function create()
    {
        $category       = $this->category_model->get_category_pengeluaran();

        $this->form_validation->set_rules(
            'kas_description',
            'Keterangan',
            'required',
            [
                'required'      => 'Keterangan harus di isi',
            ]
        );

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Data Driver',
                'category'              => $category,
                'content'               => 'admin/pengeluaran/create_pengeluaran'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{


            $data  = [
                'user_id'                   => $this->session->userdata('id'),
                'category_id'               => $this->input->post('category_id'),
                'kas_tanggal'               => $this->input->post('kas_tanggal'),
                'kas_description'           => $this->input->post('kas_description'),
                'kas_keluar'                => $this->input->post('kas_keluar'),
                'kas_masuk'                 => 0,
                'status_update'             => 1,
                'tipe_transaksi'            => 'Pengeluaran',
                'date_created'              => time()
            ];
            $this->transaksi_model->create($data);
            $this->session->set_flashdata('message', 'Data Pengeluaran telah ditambahkan');
            redirect(base_url('admin/pengeluaran'), 'refresh');
        }
    }
    // Update Data Pengeluaran
    public function update($id)
    {
      $category       = $this->category_model->get_category_pengeluaran();
      $pengeluaran    = $this->transaksi_model->detail_pengeluaran($id);

      $this->form_validation->set_rules(
          'kas_description',
          'Keterangan',
          'required',
          [
              'required'      => 'Keterangan harus di isi',
          ]
      );

      if ($this->form_validation->run() === FALSE) {
          $data = [
              'title'                 => 'Tambah Data Driver',
              'category'              => $category,
              'pengeluaran'           => $pengeluaran,
              'content'               => 'admin/pengeluaran/update_pengeluaran'
          ];
          $this->load->view('admin/layout/wrapp', $data, FALSE);
      }else{


          $data  = [
              'user_id'                   => $this->session->userdata('id'),
              'id'                        => $id,
              'category_id'               => $this->input->post('category_id'),
              'kas_tanggal'               => $this->input->post('kas_tanggal'),
              'kas_description'           => $this->input->post('kas_description'),
              'kas_keluar'                => $this->input->post('kas_keluar'),
              'kas_masuk'                 => 0,
              'status_update'             => 1,
              'tipe_transaksi'            => 'Pengeluaran',
              'date_updated'              => time()
          ];
          $this->transaksi_model->update($data);
          $this->session->set_flashdata('message', 'Data Pengeluaran telah ditambahkan');
          redirect(base_url('admin/pengeluaran'), 'refresh');
      }
    }

    // View Detail Pemasukan
    public function view($id)
    {
        $category = $this->category_model->get_category_donasi();
        $pemasukan = $this->kas_model->kas_detail($id);

        //End Validasi
        $data = [
            'title'                 => 'Detail Data',
            'category'              => $category,
            'pemasukan'             => $pemasukan,
            'error_upload'          => $this->upload->display_errors(),
            'content'               => 'admin/pemasukan/view_pemasukan'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    // HAPUS DATA PEMASUKAN
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $pengeluaran = $this->transaksi_model->detail_pengeluaran($id);
        $data = ['id'   => $pengeluaran->id];
        $this->transaksi_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
