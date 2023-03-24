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
        $foto = $_FILES['foto']['name'];

        if ($foto) {
            $this->load->library('upload');
            $config['upload_path']   = './upload/menu';
            $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size']             = 3072; // 3 mb
            $config['remove_spaces'] = TRUE;
            $config['detect_mime']   = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());

                redirect('admin/menu', 'refresh');
            } else {
                $upload_data = $this->upload->data();

                $data = [
                    'nama_menu'   => $this->input->post('nama_menu'),
                    'harga'       => $this->input->post('harga'),
                    'kategori_id' => $this->input->post('kategori_id'),
                    'foto'        => $upload_data['file_name']
                ];
            }
        } else {
            $data = [
                'nama_menu'   => $this->input->post('nama_menu'),
                'harga'       => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id')
            ];
        }

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
        $foto = $_FILES['foto']['name'];

        if ($foto) {
            $this->load->library('upload');
            $config['upload_path']   = './upload/menu';
            $config['allowed_types'] = 'jpg|jpeg|png';
            // $config['max_size']             = 3072; // 3 mb
            $config['remove_spaces'] = TRUE;
            $config['detect_mime']   = TRUE;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('toastr-error', $this->upload->display_errors());

                redirect('admin/menu', 'refresh');
            } else {
                $upload_data = $this->upload->data();

                $this->db->where('id', $this->input->post('id'));
                $data = $this->db->get('menu')->row();

                if ($data->foto != null) {
                    unlink(FCPATH . 'upload/menu/' . $data->foto);
                }

                $data = [
                    'nama_menu'   => $this->input->post('nama_menu'),
                    'harga'       => $this->input->post('harga'),
                    'kategori_id' => $this->input->post('kategori_id'),
                    'foto'        => $upload_data['file_name']
                ];
            }
        } else {
            $data = [
                'nama_menu'   => $this->input->post('nama_menu'),
                'harga'       => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id')
            ];
        }

        $this->db->where('id', $this->input->post('id'));
        $update = $this->db->update('menu', $data);

        if ($update) {
            $this->session->set_flashdata('toastr-success', 'Data berhasil ditambahkan');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal ditambahkan');
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
        $data = $this->db->get('menu')->row();

        $this->db->where('id', $id);
        $delete = $this->db->delete('menu');

        if ($delete) {
            if ($data->foto != null) {
                unlink(FCPATH . 'upload/pengaduan/' . $data->foto);
            }

            $this->session->set_flashdata('toastr-success', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('toastr-error', 'Data gagal dihapus!!');
        }

        redirect('admin/menu');
    }
}

/* End of file Menu.php */
