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

		$this->load->library('pdf');
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

	public function all()
	{
		$pdf = new FPDF('p', 'mm', 'A4');
		$pdf = new PDF_Dash();

		$pdf->AddPage();

		$pdf->Image('assets/logo/logo.png', 18, 9, 18, 18);

		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell(190, 6, 'CITRA BAKERY', 0, 1, 'C');
		$pdf->Cell(190, 6, 'Jl. Surabayan No. 46 Kota Tegal Kecamatan Tegal Timur', 0, 1, 'C');
		$pdf->Cell(190, 6, '08156900053', 0, 1, 'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10, 30, 200, 30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10, 31, 200, 31);

		$pdf->Ln(8);

		$pdf->Cell(190, 6, 'REKAP SEMUA OMSET', 0, 1, 'C');

		$pdf->Ln(2);

		$pdf->Cell(20, 10, 'NO', 1, 0, 'C');
		$pdf->Cell(50, 10, 'TAHUN', 1, 0, 'C');
		$pdf->Cell(120, 10, 'PEMASUKAN', 1, 1, 'C');

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
		$no = 1;
		$total = 0;

		$pdf->SetFont('Times', '', 12);

		foreach ($dataTahunan as $hasil) {
			$total += $hasil['subTotal'];

			$pdf->Cell(20, 8, $no++, 1, 0, 'C');
			$pdf->Cell(50, 8, $hasil['tahun'], 1, 0, 'C');
			$pdf->Cell(120, 8, 'Rp. ' . number_format($hasil['subTotal'], 0, ',', '.'), 1, 1);
		}

		$pdf->Cell(70, 8, 'Total Pemasukan', 1, 0, 'C');
		$pdf->Cell(120, 8, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 1);

		$pdf->SetFont('Times', 'B', 12);

		$pdf->Ln(15);
		$pdf->Cell(128.6, 8, '', 0, 0);
		$pdf->Cell(13, 5, 'Tegal, ', 0, 0);
		$pdf->Cell(1, 5, date('d') . ' ' . bulan(date('m')) . ' ' . date('Y'), 0, 1);

		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);

		$pdf->Cell(128.6, 5, '', 0, 0);
		$pdf->Cell(64.3, 5, '( SPV Citra Bakery )', 0, 0);

		$pdf->Output('Rekap-semua-omset.pdf', 'I');
	}

	public function tahunan($th_ini)
	{
		$pdf = new FPDF('p', 'mm', 'A4');
		$pdf = new PDF_Dash();

		$pdf->AddPage();

		$pdf->Image('assets/logo/logo.png', 18, 9, 18, 18);

		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell(190, 6, 'CITRA BAKERY', 0, 1, 'C');
		$pdf->Cell(190, 6, 'Jl. Surabayan No. 46 Kota Tegal Kecamatan Tegal Timur', 0, 1, 'C');
		$pdf->Cell(190, 6, '08156900053', 0, 1, 'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10, 30, 200, 30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10, 31, 200, 31);

		$pdf->Ln(8);

		$pdf->Cell(190, 6, 'REKAP OMSET TAHUN ' . $th_ini, 0, 1, 'C');

		$pdf->Ln(2);

		$pdf->Cell(20, 10, 'NO', 1, 0, 'C');
		$pdf->Cell(50, 10, 'TAHUN', 1, 0, 'C');
		$pdf->Cell(120, 10, 'PEMASUKAN', 1, 1, 'C');

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

		$no = 1;
		$total = 0;

		$pdf->SetFont('Times', '', 12);

		foreach ($dataBulanan as $hasil) {
			$total += $hasil['subTotal'];

			$pdf->Cell(20, 8, $no++, 1, 0, 'C');
			$pdf->Cell(50, 8, bulan($hasil['bulan']), 1, 0, 'C');
			$pdf->Cell(120, 8, 'Rp. ' . number_format($hasil['subTotal'], 0, ',', '.'), 1, 1);
		}

		$pdf->Cell(70, 8, 'Total Pemasukan', 1, 0, 'C');
		$pdf->Cell(120, 8, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 1);

		$pdf->SetFont('Times', 'B', 12);

		$pdf->Ln(15);
		$pdf->Cell(128.6, 8, '', 0, 0);
		$pdf->Cell(13, 5, 'Tegal, ', 0, 0);
		$pdf->Cell(1, 5, date('d') . ' ' . bulan(date('m')) . ' ' . date('Y'), 0, 1);

		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);

		$pdf->Cell(128.6, 5, '', 0, 0);
		$pdf->Cell(64.3, 5, '( SPV Citra Bakery )', 0, 0);

		$pdf->Output('Rekap-omset-tahun-' . $th_ini . '.pdf', 'I');
	}

	public function bulanan($th_ini, $bln_ini)
	{
		$pdf = new FPDF('p', 'mm', 'A4');
		$pdf = new PDF_Dash();

		$pdf->AddPage();

		$pdf->Image('assets/logo/logo.png', 18, 9, 18, 18);

		$pdf->SetFont('Times', 'B', 12);
		$pdf->Cell(190, 6, 'CITRA BAKERY', 0, 1, 'C');
		$pdf->Cell(190, 6, 'Jl. Surabayan No. 46 Kota Tegal Kecamatan Tegal Timur', 0, 1, 'C');
		$pdf->Cell(190, 6, '08156900053', 0, 1, 'C');

		$pdf->SetLineWidth(1);
		$pdf->Line(10, 30, 200, 30);
		$pdf->SetLineWidth(0);
		$pdf->Line(10, 31, 200, 31);

		$pdf->Ln(8);

		$pdf->Cell(190, 6, 'REKAP OMSET BULAN ' . strtoupper(bulan($bln_ini)) . ' ' . $th_ini, 0, 1, 'C');

		$pdf->Ln(2);

		$pdf->Cell(20, 10, 'NO', 1, 0, 'C');
		$pdf->Cell(50, 10, 'TAHUN', 1, 0, 'C');
		$pdf->Cell(120, 10, 'PEMASUKAN', 1, 1, 'C');

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

		$no = 1;
		$total = 0;

		$pdf->SetFont('Times', '', 12);

		foreach ($dataHarian as $hasil) {
			$total += $hasil['subTotal'];

			$pdf->Cell(20, 8, $no++, 1, 0, 'C');
			$pdf->Cell(50, 8, date('d M Y', strtotime($hasil['tanggal'])), 1, 0, 'C');
			$pdf->Cell(120, 8, 'Rp. ' . number_format($hasil['subTotal'], 0, ',', '.'), 1, 1);
		}

		$pdf->Cell(70, 8, 'Total Pemasukan', 1, 0, 'C');
		$pdf->Cell(120, 8, 'Rp. ' . number_format($total, 0, ',', '.'), 1, 1);

		$pdf->SetFont('Times', 'B', 12);

		$pdf->Ln(15);
		$pdf->Cell(128.6, 8, '', 0, 0);
		$pdf->Cell(13, 5, 'Tegal, ', 0, 0);
		$pdf->Cell(1, 5, date('d') . ' ' . bulan(date('m')) . ' ' . date('Y'), 0, 1);

		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);
		$pdf->Cell(1, 5, '', 0, 1);

		$pdf->Cell(128.6, 5, '', 0, 0);
		$pdf->Cell(64.3, 5, '( SPV Citra Bakery )', 0, 0);

		$pdf->Output('Rekap-omset-tahun-' . $th_ini . '.pdf', 'I');
	}
}

/* End of file Omset.php */
