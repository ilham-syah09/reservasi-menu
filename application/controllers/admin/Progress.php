<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progress extends CI_Controller
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

    public function index($date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        $data = [
            'title'   => 'Progress Pesanan',
            'navbar'  => 'admin/navbar',
            'page'    => 'admin/progress',
            'pesanan' => $this->admin->getPesanan([
                'orders.statusPembayaran' => 1,
                'orders.tanggal' => $date
            ]),
            'date'    => $date
        ];

        $this->load->view('index', $data);
    }

    public function getListProgres()
    {
        $progres = $this->admin->getListProgres([
            'idUser' => $this->input->get('idUser'),
            'idKhusus' => $this->input->get('idKhusus'),
        ]);

        $result = [
            'data' => ($progres) ? $progres : null
        ];

        echo json_encode($result);
    }

    public function add()
    {
        $data = [
            'idUser'   => $this->input->post('idUser'),
            'idKhusus' => $this->input->post('idKhusus'),
            'status'   => $this->input->post('status'),
        ];

        $this->db->insert('progres', $data);
        $this->session->set_flashdata('toastr-success', 'Berhasil tambah progres');
        redirect('admin/progress');
    }
}

/* End of file Home.php */
