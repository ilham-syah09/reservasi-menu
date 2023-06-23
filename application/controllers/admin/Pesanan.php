<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
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
            'title'   => 'Pesanan',
            'navbar'  => 'admin/navbar',
            'page'    => 'admin/pesanan',
            'pesanan' => $this->admin->getPesanan([
                'DATE(orders.createdAt)' => $date
            ]),
            'date'    => $date
        ];

        $this->load->view('index', $data);
    }

    public function getListPesanan()
    {
        $result = [
            'data' => $this->admin->getListPesanan([
                'orders.idUser' => $this->input->get('idUser'),
                'orders.idKhusus' => $this->input->get('idKhusus'),
            ])
        ];

        echo json_encode($result);
    }

    public function status()
    {
        $data = [
            'statusPembayaran' => $this->input->post('statusPembayaran')
        ];

        $this->db->where([
            'idUser' => $this->input->post('idUser'),
            'idKhusus' => $this->input->post('idKhusus')
        ]);
        $update = $this->db->update('orders', $data);

        if ($update) {
            $cek = $this->admin->cekProgres([
                'idUser' => $this->input->post('idUser'),
                'idKhusus' => $this->input->post('idKhusus'),
            ]);

            if (!$cek) {
                $dtProgres = [
                    'idUser'   => $this->input->post('idUser'),
                    'idKhusus' => $this->input->post('idKhusus'),
                    'status'   => 'Sedang diproses'
                ];

                $this->db->insert('progres', $dtProgres);
            }

            $this->session->set_flashdata('toastr-success', 'Status pembayaran berhasil diupdate');
        } else {
            $this->session->set_flashdata('toastr-error', 'Status pembayaran gagal diupdate');
        }

        redirect('admin/pesanan', 'refresh');
    }

    public function cetak($idUser, $idKhusus)
    {
        $data = [
            'pesanan' => $this->admin->getListPesanan([
                'orders.idUser' => $idUser,
                'orders.idKhusus' => $idKhusus,
            ])
        ];

        $this->load->view('admin/pdf_pesanan', $data);
    }

    public function delete($idKhusus)
    {
        $this->db->select('idKeranjang');
        $this->db->where('idKhusus', $idKhusus);
        $cek = $this->db->get('orders')->result();

        $this->db->where('idKhusus', $idKhusus);
        $delete = $this->db->delete('orders');
        if ($delete) {
            foreach ($cek as $dt) {
                $this->db->where('id', $dt->idKeranjang);
                $this->db->delete('keranjang');
            }

            $this->session->set_flashdata('toastr-success', 'Pesanan berhasil dihapus');
        } else {
            $this->session->set_flashdata('toastr-error', 'Pesanan gagal dihapus');
        }

        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
}

/* End of file Pesanan.php */
