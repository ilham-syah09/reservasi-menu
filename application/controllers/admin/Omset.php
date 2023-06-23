<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Omset extends CI_Controller
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

	public function index($th_ini = null, $bln_ini = null)
	{
		if (!$th_ini) {
			$th_ini = $this->admin->getTahunIni();
			if (!$th_ini) {
				$th_ini = date('Y');
			}
		}

		if (!$bln_ini) {
			$bln_ini = $this->admin->getBulanIni($th_ini);
			if (!$bln_ini) {
				$bln_ini = date('m');
			}
		}

		// tahunan
		$this->db->select('YEAR(tanggal) as tahun');
		$this->db->group_by('tahun');
		$this->db->order_by('tahun', 'asc');

		$tahun = $this->db->get('orders')->result();

		$dataTahunan = [];

		if ($tahun) {
			foreach ($tahun as $th) {
				$this->db->select('idKhusus, totalBiaya as subTotal');
				$this->db->where('YEAR(tanggal)', $th->tahun);

				$this->db->group_by('idKhusus');
				$tahunan = $this->db->get('orders')->result();

				$subTotal = 0;

				foreach ($tahunan as $thn) {
					$subTotal += $thn->subTotal;
				}

				array_push($dataTahunan, [
					'tahun'	=> $th->tahun,
					'subTotal' => $subTotal
				]);
			}
		}

		// bulanan
		$this->db->select('MONTH(tanggal) as bulan');
		$this->db->where('YEAR(tanggal)', $th_ini);
		$this->db->group_by('bulan');
		$this->db->order_by('bulan', 'asc');

		$bulan = $this->db->get('orders')->result();

		$dataBulanan = [];

		if ($bulan) {
			foreach ($bulan as $bl) {
				$this->db->select('idKhusus, totalBiaya as subTotal');
				$this->db->group_start();
				$this->db->where('YEAR(tanggal)', $th_ini);
				$this->db->where('MONTH(tanggal)', $bl->bulan);
				$this->db->group_end();
				$this->db->group_by('idKhusus');
				$bulanan = $this->db->get('orders')->result();

				$subTotal = 0;

				foreach ($bulanan as $bln) {
					$subTotal += $bln->subTotal;
				}

				array_push($dataBulanan, [
					'bulan'    => $bl->bulan,
					'subTotal' => $subTotal
				]);
			}
		}

		// harian
		$this->db->select('tanggal');
		$this->db->group_start();
		$this->db->where('YEAR(tanggal)', $th_ini);
		$this->db->where('MONTH(tanggal)', $bln_ini);
		$this->db->group_end();
		$this->db->group_by('tanggal');
		$this->db->order_by('tanggal', 'asc');

		$hari = $this->db->get('orders')->result();

		$dataHarian = [];

		if ($hari) {
			foreach ($hari as $hr) {
				$this->db->select('idKhusus, totalBiaya as subTotal');
				$this->db->where('tanggal', $hr->tanggal);
				$this->db->group_by('idKhusus');
				$harian = $this->db->get('orders')->result();

				$subTotal = 0;

				foreach ($harian as $hrn) {
					$subTotal += $hrn->subTotal;
				}

				array_push($dataHarian, [
					'tanggal'    => $hr->tanggal,
					'subTotal' => $subTotal
				]);
			}
		}

		$data = [
			'title'       => 'Rekap Omset',
			'navbar'      => 'admin/navbar',
			'page'        => 'admin/omset',
			'dataTahunan' => $dataTahunan,
			'dataBulanan' => $dataBulanan,
			'dataHarian'  => $dataHarian,
			'tahun'       => $this->admin->getTahun(),
			'th_ini'      => $th_ini,
			'bln_ini'     => $bln_ini
		];

		$this->load->view('index', $data);
	}
}

/* End of file Omset.php */
