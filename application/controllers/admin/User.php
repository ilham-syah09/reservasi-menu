<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data = [
            'title'   => 'Daftar User',
            'navbar'  => 'admin/navbar',
            'page'    => 'admin/listuser',
            'user'    => $this->admin->getAllUser(),
        ];

        $this->load->view('index', $data);
    }

    public function aktifkan($id)
    {
        $this->db->where('id', $id);
        $update = $this->db->update('user', [
            'is_active' => 1
        ]);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Akun berhasil diaktifkan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Akun gagal diaktifkan');
        }

        redirect('admin/user', 'refresh');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('user');

        if ($delete) {
            $this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal dihapus');
        }

        redirect('admin/user', 'refresh');
    }
}

/* End of file Home.php */
