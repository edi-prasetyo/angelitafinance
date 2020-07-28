<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Type extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('type_model');
        $this->load->model('brand_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 3) {
            redirect('admin/dashboard');
        }
    }
    public function index()
    {

        $config['base_url']       = base_url('admin/type/index/');
        $config['total_rows']     = count($this->type_model->total_row_type());
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

        $keyword = $this->input->post('keyword');//Pentypeian Driver
        $type = $this->type_model->get_alltype($limit, $start, $keyword);
        $data = [
            'title'                     => 'Data Mobil',
            'type'                       => $type,
            'pagination'                => $this->pagination->create_links(),
            'content'                   => 'admin/type/index_type'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    public function create()
    {

        $this->form_validation->set_rules(
            'type_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama Mobil harus di isi',
            ]
        );

        $brand = $this->brand_model->get_allbrand();

        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Data Mobil',
                'brand'                 => $brand,
                'content'               => 'admin/type/create_type'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{


            $slugcode = random_string('numeric', 5);
            $type_slug  = url_title($this->input->post('type_name'), 'dash', TRUE);
            $data  = [
                'type_slug'                  => $slugcode . '-' . $type_slug,
                'brand_id'                  => $this->input->post('brand_id'),
                'type_name'                  => $this->input->post('type_name'),
                'luggage'                   => $this->input->post('luggage'),
                'passenger'                 => $this->input->post('passenger'),
                'date_created'              => time()
            ];
            $this->type_model->create($data);
            $this->session->set_flashdata('message', 'Data Mobil telah ditambahkan');
            redirect(base_url('admin/type'), 'refresh');
        }

    }
    // Update Pelanggan
    public function update($id)
    {
        $type = $this->type_model->read($id);
        $brand = $this->brand_model->get_allbrand();
        $this->form_validation->set_rules(
            'type_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama harus di isi',
            ]
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Update Data Mobil',
                'type'                  => $type,
                'brand'                 => $brand,
                'content'               => 'admin/type/update_type'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{

            $data  = [
                'id'                        => $id,
                'brand_id'                  => $this->input->post('brand_id'),
                'type_name'                 => $this->input->post('type_name'),
                'luggage'                   => $this->input->post('luggage'),
                'passenger'                 => $this->input->post('passenger')

            ];
            $this->type_model->update($data);
            $this->session->set_flashdata('message', 'Data Mobil telah di Update');
            redirect(base_url('admin/type'), 'refresh');
        }

    }

    //DELETE
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $type = $this->type_model->read($id);

        $data = ['id'   => $type->id];
        $this->type_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }



}
