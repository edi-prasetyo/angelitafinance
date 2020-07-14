<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('driver_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 3) {
            redirect('admin/home');
        }
    }
    public function index()
    {

        $config['base_url']       = base_url('admin/driver/index/');
        $config['total_rows']     = count($this->driver_model->total_row_driver());
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

        $keyword = $this->input->post('keyword');//Pencarian Driver
        $driver = $this->driver_model->get_alldriver($limit, $start, $keyword);
        $data = [
            'title'                     => 'Data Driver',
            'driver'                    => $driver,
            'pagination'                => $this->pagination->create_links(),
            'content'                   => 'admin/driver/index_driver'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    
    public function create()
    {
        $this->form_validation->set_rules(
            'driver_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'driver_phone',
            'Nomor Handphone',
            'required|is_unique[driver.driver_phone]',
            [
                'is_unique'     => '%s <strong>'.$this->input->post('driver_phone'). '</strong> sudah digunakan!',
                'required'      => 'Nomor Handphone harus di isi',
            ]
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Data Driver',
                'content'               => 'admin/driver/create_driver'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{
            $slugcode = random_string('numeric', 5);
            $driver_slug  = url_title($this->input->post('driver_slug'), 'dash', TRUE);
            $data  = [
                'driver_slug'               => $slugcode . '-' . $driver_slug,               
                'driver_name'               => $this->input->post('driver_name'),
                'driver_phone'              => $this->input->post('driver_phone'),
                'driver_age'                => $this->input->post('driver_age'),
                'driver_status'             => $this->input->post('driver_status'),
                'date_created'              => time()
            ];
            $this->driver_model->create($data);
            $this->session->set_flashdata('message', 'Data Diver telah ditambahkan');
            redirect(base_url('admin/driver'), 'refresh');
        }

    }
    // Update Driver
    public function update($id)
    {
        $driver = $this->driver_model->read($id);
        $this->form_validation->set_rules(
            'driver_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama harus di isi',
            ]
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Update Data Driver',
                'driver'                => $driver,
                'content'               => 'admin/driver/update_driver'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{

            $data  = [
                'id'                        => $id,
                'driver_name'               => $this->input->post('driver_name'),
                'driver_phone'              => $this->input->post('driver_phone'),
                'driver_age'                => $this->input->post('driver_age'),
                'driver_status'             => $this->input->post('driver_status'),
                'date_updated'              => time()
            ];
            $this->driver_model->update($data);
            $this->session->set_flashdata('message', 'Data Driver telah di update');
            redirect(base_url('admin/driver'), 'refresh');
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
      'driver_status'               => 'Inactive',
    ];
    $this->driver_model->update($data);
    $this->session->set_flashdata('message', 'Driver Telah di banned');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function activated($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                          => $id,
      'driver_status'               => 'Active',
    ];
    $this->driver_model->update($data);
    $this->session->set_flashdata('message', 'Driver Telah di Aktifkan');
    redirect($_SERVER['HTTP_REFERER']);
  } 

}
