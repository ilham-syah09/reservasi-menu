<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
            'title'   => 'Kategori Menu',
            'navbar'  => 'admin/navbar',
            'page'    => 'admin/kategori',
            'kategori'  => $this->admin->getKategori(),
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $gambar = $_FILES['gambar']['name'];

        if ($gambar) {
            $this->load->library('upload');
            $config['upload_path']   = './upload/gambar';
            $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size']             = 3072; // 3 mb
            $config['remove_spaces'] = TRUE;
            $config['detect_mime']   = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());

                redirect('admin/kategori', 'refresh');
            } else {
                $upload_data = $this->upload->data();

                $data = [
                    'kategori' => $this->input->post('kategori'),
                    'gambar'   => $upload_data['file_name']
                ];
            }
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];
        }

        $insert = $this->db->insert('kategori', $data);

        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
        }

        redirect('admin/kategori', 'refresh');
    }

    public function edit()
    {
        $gambar = $_FILES['gambar']['name'];

        if ($gambar) {
            $this->load->library('upload');
            $config['upload_path']   = './upload/gambar';
            $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size']             = 3072; // 3 mb
            $config['remove_spaces'] = TRUE;
            $config['detect_mime']   = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());

                redirect('admin/kategori', 'refresh');
            } else {
                $upload_data = $this->upload->data();

                $this->db->where('id', $this->input->post('id'));
                $data = $this->db->get('kategori')->row();

                if ($data->gambar != null) {
                    unlink(FCPATH . 'upload/gambar/' . $data->gambar);
                }

                $data = [
                    'kategori' => $this->input->post('kategori'),
                    'gambar'   => $upload_data['file_name']
                ];
            }
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];
        }

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('kategori', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal diedit');
        }

        redirect('admin/kategori', 'refresh');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->get('kategori')->row();

        $this->db->where('id', $id);
        $delete = $this->db->delete('kategori');

        if ($delete) {
            if ($data->gambar != null) {
                unlink(FCPATH . 'upload/gambar/' . $data->gambar);
            }

            $this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
        }

        redirect('admin/kategori');
    }
}

/* End of file Home.php */
