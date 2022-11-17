<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('testing_model');
        $this->load->library('pagination');


    }
    public function search()
    {

        //end load data
        $user_name    = urldecode($this->input->get('user_name', TRUE));
        $user_address = urldecode($this->input->get('user_address', TRUE));
        $start = intval($this->input->get('start'));

        if ($user_name <> '' || $user_address <> '') {
            $config['base_url'] = base_url() . '/admin/testing/search?user_name=' . urlencode($user_name) . '&user_address=' . urlencode($user_address);
            $config['first_url'] = base_url() . '//admin/testing/search?user_name=' . urlencode($user_name) . '&user_address=' . urlencode($user_address);
        } else {
            $config['base_url'] = base_url() . '/admin/testing/search';
            $config['first_url'] = base_url() . '/admin/testing/search';
        }

        $config['per_page'] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'page';
        $config['total_rows'] = $this->testing_model->total_rows($user_name, $user_address);
        $menu = $this->testing_model->get_limit_data($config['per_page'], $start, $user_name, $user_address);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(

            'title'       => 'Result',
            'deskripsi'   => 'deskripsi',
            'keywords'    => 'Key',
            'tampil' => $menu,

            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'content'         => 'admin/testing/search'
        );

        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

   }
