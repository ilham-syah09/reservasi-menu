<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Admin extends CI_Model
{

    public function getAllUser()
    {
        $this->db->where('role', 2);
        return $this->db->get('user')->result();
    }

    public function getKategori()
    {
        return $this->db->get('kategori')->result();
    }

    public function getMenu()
    {
        $this->db->select('menu.*, kategori.kategori');
        $this->db->join('kategori', 'menu.kategori_id = kategori.id', 'inner');

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
        $this->db->select('menu.nama_menu, menu.harga, keranjang.total, orders.idKhusus, orders.statusPembayaran, orders.createdAt, user.name, user.noHp');
        $this->db->join('user', 'user.id = orders.idUser', 'inner');
        $this->db->join('keranjang', 'keranjang.id = orders.idKeranjang', 'inner');
        $this->db->join('menu', 'menu.id = keranjang.idMenu', 'inner');

        $this->db->where($where);

        $this->db->order_by('menu.nama_menu', 'asc');

        return $this->db->get('orders')->result();
    }

    public function cekProgres($where)
    {
        $this->db->where($where);

        return $this->db->get('progres')->row();
    }

    public function getListProgres($where)
    {
        $this->db->where($where);
        $this->db->order_by('createdAt', 'desc');

        return $this->db->get('progres')->result();
    }
}

/* End of file M_Admin.php */
