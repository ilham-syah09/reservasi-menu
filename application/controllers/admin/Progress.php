<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progress extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_user = $this->db->get('user')->row();
    }

    public function index()
    {
        $data = [
            'title'   => 'Progress Pesanan',
            'navbar'  => 'admin/navbar',
            'page'    => 'admin/progress',
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Home.php */
