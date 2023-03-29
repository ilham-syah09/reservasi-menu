<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
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
            'nama_menu'   => $this->input->post('nama_menu'),
            'harga'       => $this->input->post('harga'),
            'kategori_id' => $this->input->post('kategori_id'),
            'deskripsi'   => $this->input->post('deskripsi')
        ];

        $insert = $this->db->insert('menu', $data);

        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
        }

        redirect('admin/menu', 'refresh');
    }

    public function edit()
    {
        $data = [
            'nama_menu'   => $this->input->post('nama_menu'),
            'harga'       => $this->input->post('harga'),
            'kategori_id' => $this->input->post('kategori_id'),
            'deskripsi'   => $this->input->post('deskripsi')
        ];

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('menu', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal diedit');
        }

        redirect('admin/menu', 'refresh');
    }

    public function stok()
    {
        $data = [
            'stok' => ($this->input->post('stokLama') + $this->input->post('stok'))
        ];

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('menu', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Stok berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Stok gagal ditambahkan');
        }

        redirect('admin/menu', 'refresh');
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $delete = $this->db->delete('menu');

        if ($delete) {
            $this->db->where('idMenu', $id);
            $this->db->delete('gambar');

            $this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
        }

        redirect('admin/menu');
    }

    public function getListGambar()
    {
        $gambar = $this->admin->getListGambar([
            'idMenu' => $this->input->get('idMenu')
        ]);

        $res = [
            'data' => ($gambar) ? $gambar : null
        ];

        echo json_encode($res);
    }

    public function addGambar()
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

                redirect('admin/menu', 'refresh');
            } else {
                $upload_data = $this->upload->data();

                $data = [
                    'idMenu' => $this->input->post('idMenu'),
                    'gambar'   => $upload_data['file_name']
                ];
            }
        } else {
            $this->session->set_flashdata('toastr-error', 'Gambar harus diisi');

            redirect('admin/menu', 'refresh');
        }

        $insert = $this->db->insert('gambar', $data);

        if ($insert) {
            $this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
        }

        redirect('admin/menu', 'refresh');
    }

    public function deletegambar($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->get('gambar')->row();

        $this->db->where('id', $id);
        $delete = $this->db->delete('gambar');

        if ($delete) {
            if ($data->gambar != null) {
                unlink(FCPATH . 'upload/gambar/' . $data->gambar);
            }

            $this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
        }

        redirect('admin/menu');
    }
}

/* End of file Menu.php */
