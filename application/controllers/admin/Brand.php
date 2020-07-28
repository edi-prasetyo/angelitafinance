<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('brand_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 3) {
            redirect('admin/dashboard');
        }
    }
    //Index Category
    public function index()
    {
        $keyword = $this->input->post('keyword');
        $brand = $this->brand_model->get_brand($keyword);
        //Validasi
        $this->form_validation->set_rules(
            'brand_name',
            'Nama Brand',
            'required|is_unique[brand.brand_name]',
            array(
                'required'         => '%s Harus Diisi',
                'is_unique'         => '%s <strong>' . $this->input->post('brand_name') .
                    '</strong> Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Brand',
                'brand'             => $brand,
                'content'           => 'admin/brand/index_brand'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            $slugcode = random_string('numeric', 5);
            $brand_slug  = url_title($this->input->post('brand_name'), 'dash', TRUE);
            $data  = [
                'brand_slug'        => $slugcode . '-' . $brand_slug,
                'brand_name'        => $this->input->post('brand_name'),
                'date_created'      => time()
            ];
            $this->brand_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/brand'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $brand = $this->brand_model->detail_brand($id);
        //Validasi
        $this->form_validation->set_rules(
            'brand_name',
            'Nama Kategori',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit kategori Berita',
                'brand'             => $brand,
                'content'           => 'admin/brand/update_brand'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'brand_name'        => $this->input->post('brand_name'),
                'date_updated'      => time()
            ];
            $this->brand_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/brand'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Category
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $brand = $this->brand_model->detail_brand($id);
        $data = ['id'   => $brand->id];

        $this->brand_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/brand'), 'refresh');
    }
}
