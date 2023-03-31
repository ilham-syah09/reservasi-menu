<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Front extends CI_Model
{
	public function getKategori()
	{
		$this->db->order_by('kategori', 'asc');

		return $this->db->get('kategori')->result();
	}

	public function getPopularProducts()
	{
		$this->db->select('SUM(keranjang.total) as total, menu.id, menu.nama_menu, menu.harga, menu.stok');
		$this->db->join('menu', 'menu.id = keranjang.idMenu', 'inner');

		$this->db->group_by('keranjang.idMenu');
		$this->db->order_by('total', 'desc');

		return $this->db->get('keranjang', 8)->result();
	}

	public function getProductKategori()
	{
		$this->db->select('kategori.id, kategori.kategori, COUNT(menu.id) as total, menu.id as idMenu');
		$this->db->join('menu', 'menu.kategori_id = kategori.id', 'inner');

		$this->db->group_by('menu.kategori_id');
		$this->db->order_by('kategori.kategori', 'asc');

		return $this->db->get('kategori', 8)->result();
	}

	public function getProduct($where)
	{
		$this->db->where($where);
		return $this->db->get('menu')->row();
	}

	public function getGambar($where)
	{
		$this->db->where($where);
		$this->db->order_by('createdAt', 'desc');

		return $this->db->get('gambar')->result();
	}

	public function getProductRandom($id)
	{
		$this->db->where('id !=', $id);
		$this->db->order_by('nama_menu', 'RANDOM');

		return $this->db->get('menu', 5)->result();
	}

	public function getProductsShop($where, $limit = null, $offset = null, $like = null)
	{
		$this->db->where($where);
		$this->db->like('nama_menu', $like);

		return $this->db->get('menu', $limit, $offset)->result();
	}

	public function getCountProduct($where, $like = null)
	{
		$this->db->where($where);
		$this->db->like('nama_menu', $like);

		return $this->db->get('menu')->num_rows();
	}

	public function checkCart($where)
	{
		$this->db->where($where);

		return $this->db->get('keranjang')->row();
	}

	public function getMenu($where)
	{
		$this->db->where($where);
		return $this->db->get('menu')->row();
	}

	public function getCart($where)
	{
		$this->db->select('menu.nama_menu, menu.harga, menu.stok, keranjang.*');
		$this->db->join('menu', 'menu.id = keranjang.idMenu', 'inner');

		$this->db->where($where);
		return $this->db->get('keranjang')->result();
	}

	public function getTotalPrice($where)
	{
		$this->db->select('SUM(menu.harga * keranjang.total) AS total');
		$this->db->join('menu', 'menu.id = keranjang.idMenu', 'inner');

		$this->db->where($where);
		return $this->db->get('keranjang')->row();
	}

	public function getListOrders($where)
	{
		if ($where) {
			$this->db->where($where);
		}

		$this->db->group_by('idKhusus,');
		$this->db->order_by('createdAt', 'desc');

		return $this->db->get('orders')->result();
	}

	public function getListProduct($where)
	{
		$this->db->select('menu.nama_menu, menu.harga, keranjang.total, orders.idKhusus, orders.statusPembayaran, orders.createdAt, orders.metodePembayaran, orders.buktiPembayaran');
		$this->db->join('keranjang', 'keranjang.id = orders.idKeranjang', 'inner');
		$this->db->join('menu', 'menu.id = keranjang.idMenu', 'inner');

		$this->db->where($where);

		$this->db->order_by('menu.nama_menu', 'asc');

		return $this->db->get('orders')->result();
	}

	public function getListProgres($where)
	{
		$this->db->where($where);
		$this->db->order_by('createdAt', 'desc');

		return $this->db->get('progres')->result();
	}
}

/* End of file M_Front.php */
