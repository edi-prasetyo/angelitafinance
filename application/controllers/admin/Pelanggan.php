<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 3) {
            redirect('admin/dashboard');
        }
    }
    public function index()
    {

        $config['base_url']       = base_url('admin/pelanggan/index/');
        $config['total_rows']     = count($this->user_model->total_row_pelanggan());
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

        $keyword = $this->input->post('keyword');
        $list_pelanggan = $this->user_model->get_allpelanggan($limit, $start, $keyword);
        $data = [
            'title'                     => 'Data Pelanggan',
            'list_pelanggan'            => $list_pelanggan,
            'pagination'                => $this->pagination->create_links(),
            'content'                   => 'admin/pelanggan/index_pelanggan'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    // Pencarian Pelanggan
    public function search(){
        $keyword = $this->input->post('keyword');
        $data['user']=$this->user_model->get_user_keyword($keyword);
        $data['title']='Data';
        $data['content']='admin/pelanggan/search_pelanggan';
        $this->load->view('admin/layout/wrapp',$data);
    }
    //Create Pelanggan
    public function create()
    {
        $this->form_validation->set_rules(
            'user_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'user_phone',
            'Nomor Handphone',
            'required|is_unique[user.user_phone]',
            [
                'is_unique'     => '%s <strong>'.$this->input->post('user_phone'). '</strong> sudah digunakan!',
                'required'      => 'Nomor Handphone harus di isi',
            ]
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Data Pelanggan',
                'content'               => 'admin/pelanggan/create_pelanggan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{

            $data  = [

                'user_name'             => $this->input->post('user_name'),
                'user_phone'            => $this->input->post('user_phone'),
                'user_address'          => $this->input->post('user_address'),
                'role_id'               => 4,
                'is_active '            => 1,
                'date_created'          => time()
            ];
            $this->user_model->create($data);
            $this->session->set_flashdata('message', 'Data Pelanggan telah ditambahkan');
            redirect(base_url('admin/pelanggan'), 'refresh');
        }

    }
    // Add Pelanggan dari Halaman TRANSAKSI
    //Create Pelanggan
    public function add()
    {
        $this->form_validation->set_rules(
            'user_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama harus di isi',
            ]
        );
        $this->form_validation->set_rules(
            'user_phone',
            'Nomor Handphone',
            'required|is_unique[user.user_phone]',
            [
                'is_unique'     => '%s <strong>'.$this->input->post('user_phone'). '</strong> sudah digunakan!',
                'required'      => 'Nomor Handphone harus di isi',
            ]
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Data Pelanggan',
                'content'               => 'admin/pelanggan/create_pelanggan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{

            $data  = [

                'user_name'             => $this->input->post('user_name'),
                'user_phone'            => $this->input->post('user_phone'),
                'user_address'         => $this->input->post('user_address'),
                'role_id'               => 4,
                'is_active '            => 1,
                'date_created'          => time()
            ];
            $this->user_model->create($data);
            $this->session->set_flashdata('message', 'Data Pelanggan telah ditambahkan');
            redirect($_SERVER['HTTP_REFERER']);
        }

    }
    // Update Pelanggan
    public function update($id)
    {
        $pelanggan = $this->user_model->read($id);
        $this->form_validation->set_rules(
            'user_name',
            'Nama',
            'required',
            [
                'required'      => 'Nama harus di isi',
            ]
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'                 => 'Tambah Data Pelanggan',
                'pelanggan'             => $pelanggan,
                'content'               => 'admin/pelanggan/update_pelanggan'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        }else{

            $data  = [
                'id'                    => $id,
                'user_name'             => $this->input->post('user_name'),
                'user_phone'            => $this->input->post('user_phone'),
                'user_address'          => $this->input->post('user_address'),
                'role_id'               => 3,
                'is_active '            => 1,
                'date_updated'          => time()
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data Pelanggan telah di Update');
            redirect(base_url('admin/pelanggan'), 'refresh');
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

     // AUTOCOMPLETE
     function get_autocomplete()
     {
         if (isset($_GET['term'])) {
             $result = $this->user_model->search_blog($_GET['term']);
             if (count($result) > 0) {
                 foreach ($result as $row)
                     $arr_result[] = array(
                         'label'                => $row->user_phone,
                         'user_name'            => $row->user_name,
                         'user_address'         => $row->user_address,
                     );
                 echo json_encode($arr_result);
             }
         }
     }

}
