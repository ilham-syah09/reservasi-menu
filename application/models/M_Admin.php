<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{
    public function getTotalPemasukan()
    {
        $this->db->select('idKhusus, totalBiaya');

        $this->db->group_by('idKhusus');

        $data = $this->db->get('orders')->result();
        $total = 0;

        if ($data) {
            foreach ($data as $dt) {
                $total += $dt->totalBiaya;
            }
        }

        return $total;
    }
    public function getAllUser()
    {
        $this->db->where('role', 2);
        return $this->db->get('user')->result();
    }

    public function getCountUser()
    {
        $this->db->where('role', 2);
        return $this->db->get('user')->num_rows();
    }

    public function getCountMenu()
    {
        return $this->db->get('user')->num_rows();
    }

    public function getCountOrders()
    {
        return $this->db->get('orders')->num_rows();
    }

    public function getKategori()
    {
        $this->db->order_by('kategori', 'asc');

        return $this->db->get('kategori')->result();
    }

    public function getMenu()
    {
        $this->db->select('menu.*, kategori.kategori');
        $this->db->join('kategori', 'menu.kategori_id = kategori.id', 'inner');

        $this->db->order_by('menu.createdAt', 'desc');

        return $this->db->get('menu')->result();
    }

    public function getPesanan($where = null)
    {
        $this->db->select('orders.*, user.name, user.noHp');
        $this->db->join('user', 'user.id = orders.idUser', 'inner');

        if ($where) {
            $this->db->where($where);
        }

        $this->db->group_by('orders.idKhusus, orders.idUser');
        $this->db->order_by('orders.createdAt', 'desc');

        return $this->db->get('orders')->result();
    }

    public function getListPesanan($where)
    {
        $this->db->select('menu.nama_menu, menu.harga, keranjang.total, orders.idKhusus, orders.statusPembayaran, orders.createdAt, orders.metodePembayaran, orders.buktiPembayaran, orders.opsi, user.name, user.noHp, ongkir.kecamatan, ongkir.harga as ongkir');
        $this->db->join('user', 'user.id = orders.idUser', 'inner');
        $this->db->join('keranjang', 'keranjang.id = orders.idKeranjang', 'inner');
        $this->db->join('menu', 'menu.id = keranjang.idMenu', 'inner');
        $this->db->join('ongkir', 'ongkir.id = orders.idOngkir', 'left');

        $this->db->where($where);

        $this->db->order_by('menu.nama_menu', 'asc');

        return $this->db->get('orders')->result();
    }

    public function cekProgres($where)
    {
        $this->db->where($where);

        return $this->db->get('progres')->row();
    }

    public function getListGambar($where)
    {
        $this->db->where($where);
        $this->db->order_by('createdAt', 'desc');

        return $this->db->get('gambar')->result();
    }

    public function getListProgres($where)
    {
        $this->db->where($where);
        $this->db->order_by('createdAt', 'desc');

        return $this->db->get('progres')->result();
    }

    public function getOngkir()
    {
        $this->db->order_by('kecamatan', 'asc');

        return $this->db->get('ongkir')->result();
    }
}

/* End of file M_Admin.php */
