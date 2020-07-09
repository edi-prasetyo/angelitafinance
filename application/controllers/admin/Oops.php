<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Oops extends CI_Controller
{
    //main page - home page
    public function index()
    {
        $data = array(
            'title' => 'Oops! 404',
            'deskripsi' => 'error 404',
            'keywords' => 'keywords',
            'content'  => 'admin/oops/index_oops'
        );
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
}

 /* End of file Kontak.php */
 /* Location: ./application/controllers/Kontak.php */