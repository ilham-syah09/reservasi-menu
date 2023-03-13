<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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

        $this->load->model('M_Admin', 'admin');
    }

    public function index()
    {
        $data = [
            'title'   => 'Daftar Menu',
            'navbar'  => 'admin/navbar',
            'page'    => 'admin/daftar-menu',
            'kategori'  => $this->admin->getKategori(),
            'menu'      => $this->admin->getMenu(),
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $data = [
            'nama_menu'    => $this->input->post('nama_menu'),
            'harga'        => $this->input->post('harga'),
            'kategori_id'  => $this->input->post('kategori_id'),
        ];

        $this->db->insert('menu', $data);
        $this->session->set_flashdata('toastr-success', 'Berhasil tambah menu');
        redirect('admin/menu');
    }

    public function edit()
    {
        $data = [
            'nama_menu'    => $this->input->post('nama_menu'),
            'harga'        => $this->input->post('harga'),
            'kategori_id'  => $this->input->post('kategori_id'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('menu', $data);
        $this->session->set_flashdata('toastr-success', 'Berhasil edit menu');
        redirect('admin/menu');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('menu');
        $this->session->set_flashdata('toastr-success', 'Berhasil hapus menu');
        redirect('admin/menu');
    }
}

/* End of file Menu.php */
