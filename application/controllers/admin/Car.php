<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Car extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('car_model');
    $this->load->model('type_model');
    $this->load->library('pagination');
    $id = $this->session->userdata('id');
    $user = $this->user_model->user_detail($id);
    if ($user->role_id == 3) {
      redirect('admin/dashboard');
    }
  }
  public function index()
  {
    $config['base_url']         = base_url('admin/car/index/');
    $config['total_rows']       = count($this->car_model->total_row_car());
    $config['per_page']         = 10;
    $config['uri_segment']      = 4;
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
    $limit                      = $config['per_page'];
    $start                      = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);
    $keyword = $this->input->post('keyword');//Pencarian Driver
    $car = $this->car_model->get_allcar($limit, $start, $keyword);
    $data = [
      'title'                     => 'Data Driver',
      'car'                       => $car,
      'pagination'                => $this->pagination->create_links(),
      'content'                   => 'admin/car/index_car'
    ];
    $this->load->view('admin/layout/wrapp', $data, FALSE);
  }
  public function create()
  {
    $type = $this->type_model->get_type();
    $this->form_validation->set_rules(
      'car_color',
      'Warna Mobil',
      'required',
      [
        'required'      => 'Warna Mobil harus di isi',
      ]
    );
    $this->form_validation->set_rules(
      'car_number',
      'Plat Nomor',
      'required|is_unique[car.car_number]',
      [
        'is_unique'     => '%s <strong>'.$this->input->post('car_number'). '</strong> sudah digunakan!',
        'required'      => 'Plat Nomor harus di isi',
      ]
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                 => 'Tambah Data Driver',
        'type'                  => $type,
        'content'               => 'admin/car/create_car'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    }else{
      $data  = [
        'type_id'                   => $this->input->post('type_id'),
        'car_number'                 => $this->input->post('car_number'),
        'car_color'                   => $this->input->post('car_color'),
        'car_status'                => $this->input->post('car_status'),
        'date_created'              => time()
      ];
      $this->car_model->create($data);
      $this->session->set_flashdata('message', 'Data Mobil telah ditambahkan');
      redirect(base_url('admin/car'), 'refresh');
    }
  }
  // Update Driver
  public function update($id)
  {
    $car = $this->car_model->read($id);
    $type = $this->type_model->get_type();
    $this->form_validation->set_rules(
      'car_number',
      'Nama',
      'required',
      [
        'required'      => 'Nama harus di isi',
      ]
    );
    if ($this->form_validation->run() === FALSE) {
      $data = [
        'title'                 => 'Update Data Mobil',
        'car'                   => $car,
        'type'                  => $type,
        'content'               => 'admin/car/update_car'
      ];
      $this->load->view('admin/layout/wrapp', $data, FALSE);
    }else{
      $data  = [
        'id'                        => $id,
        'type_id'                   => $this->input->post('type_id'),
        'car_number'                => $this->input->post('car_number'),
        'car_color'                 => $this->input->post('car_color'),
        'car_status'                => $this->input->post('car_status'),
        'date_updated'              => time()
      ];
      $this->car_model->update($data);
      $this->session->set_flashdata('message', 'Data Driver telah di update');
      redirect(base_url('admin/car'), 'refresh');
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
      'car_status'                  => 'Inactive',
    ];
    $this->car_model->update($data);
    $this->session->set_flashdata('message', 'Driver Telah di banned');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function activated($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                          => $id,
      'car_status'                  => 'Active',
    ];
    $this->car_model->update($data);
    $this->session->set_flashdata('message', 'Driver Telah di Aktifkan');
    redirect($_SERVER['HTTP_REFERER']);
  }
}
