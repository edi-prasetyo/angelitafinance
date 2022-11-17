<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testing_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function total_rows($user_name = NULL, $user_address = NULL)
    {


        $this->db->select('user.*, COUNT(*) AS jum, ');
        $this->db->from('user');

        $this->db->like('user_name', $user_name);
        $this->db->like('user_address', $user_address);

        $query = $this->db->get('user')->row();

        return $query->jum;



        // $sql = "SELECT *,COUNT(*) jum
        //       FROM properti
        //       WHERE id_market
        //       LIKE '%$market%'
        //       AND id_kota
        //       LIKE '%$kota%'
        //       AND  id_tipe
        //       LIKE '%$tipe%'";
        // $res = $this->db->query($sql)->row();
        // return $res->jum;
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $user_name = NULL, $user_address = NULL)
    {


        $this->db->select('*');
        $this->db->from('user');
        $this->db->like('user_name', $user_name);
        $this->db->like('user_address', $user_address);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();


    }


}
