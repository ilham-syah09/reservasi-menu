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
        $this->db->from('menu');
        $this->db->join('kategori', 'menu.kategori_id = kategori.id', 'inner');
        return $this->db->get()->result();
    }
}

/* End of file M_Admin.php */
