<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-error', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_user = $this->db->get('user')->row();

        $this->load->model('M_Admin', 'admin');
    }

    public function index()
    {
        $totalPemasukan = $this->admin->getTotalPemasukan();

        $data = [
            'title'          => 'Dashboard Admin',
            'navbar'         => 'admin/navbar',
            'page'           => 'admin/dashboard',
            'user'           => $this->admin->getCountUser(),
            'menu'           => $this->admin->getCountMenu(),
            'orders'         => $this->admin->getCountOrders(),
            'totalPemasukan' => $totalPemasukan
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Home.php */
