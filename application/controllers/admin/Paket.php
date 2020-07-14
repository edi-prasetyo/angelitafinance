<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('paket_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }
    //Index Category
    public function index()
    {
        $keyword = $this->input->post('keyword');
        $paket = $this->paket_model->get_paket($keyword);
        //Validasi
        $this->form_validation->set_rules(
            'paket_name',
            'Nama Brand',
            'required|is_unique[paket.paket_name]',
            array(
                'required'         => '%s Harus Diisi',
                'is_unique'         => '%s <strong>' . $this->input->post('paket_name') .
                    '</strong> Sudah Ada. Buat Nama yang lain!'
            )
        );
        if ($this->form_validation->run() === FALSE) {
            $data = [
                'title'             => 'Paket',
                'paket'             => $paket,
                'content'           => 'admin/paket/index_paket'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
        } else {

            
            $data  = [
                
                'paket_name'        => $this->input->post('paket_name'),
                'paket_term'        => $this->input->post('paket_term'),
                'date_created'      => time()
            ];
            $this->paket_model->create($data);
            $this->session->set_flashdata('message', 'Data telah ditambahkan');
            redirect(base_url('admin/paket'), 'refresh');
        }
    }
    //Update
    public function update($id)
    {
        $paket = $this->paket_model->detail_paket($id);
        //Validasi
        $this->form_validation->set_rules(
            'paket_name',
            'Nama Paket',
            'required',
            array('required'         => '%s Harus Diisi')
        );
        if ($this->form_validation->run() === FALSE) {
            //End Validasi

            $data = [
                'title'             => 'Edit kategori Berita',
                'paket'             => $paket,
                'content'           => 'admin/paket/update_paket'
            ];
            $this->load->view('admin/layout/wrapp', $data, FALSE);
            //Masuk Database
        } else {

            $data  = [
                'id'                => $id,
                'paket_name'        => $this->input->post('paket_name'),
                'paket_term'        => $this->input->post('paket_term'),
                'date_updated'      => time()
            ];
            $this->paket_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di Update');
            redirect(base_url('admin/paket'), 'refresh');
        }
        //End Masuk Database
    }
    //delete Category
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $paket = $this->paket_model->detail_paket($id);
        $data = ['id'   => $paket->id];

        $this->paket_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect(base_url('admin/paket'), 'refresh');
    }
}
