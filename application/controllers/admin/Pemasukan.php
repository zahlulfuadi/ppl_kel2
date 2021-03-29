<?php
class Pemasukan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url();
			redirect($url);
		};
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_supplier');
		$this->load->model('m_pemasukan');
		$this->load->model('m_pengguna');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');

			$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
			$data['data'] = $this->m_barang->tampil_barang();
			$data['judul'] = "Input Pemasukan";
			$this->load->view('admin/v_pemasukan', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function get_barang()
	{
		if ($this->session->userdata('masuk') == true) {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('admin/v_detail_barang_jual', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function add_to_cart()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$kobar = $this->input->post('kode_brg');
			$produk = $this->m_barang->get_barang($kobar);
			$i = $produk->row_array();
			$data = array(
				'jenis'    => 'pemasukan',
				'id'       => $i['id_barang'],
				'name'     => $i['nama_barang'],
				'satuan'   => $i['satuan_barang'],
				'harpok'   => $i['harga_pokok'],
				'price'    => str_replace(",", "", $this->input->post('harjul')) - $this->input->post('diskon'),
				'disc'     => $this->input->post('diskon'),
				'qty'      => $this->input->post('qty'),
				'amount'	  => str_replace(",", "", $this->input->post('harjul'))
			);
			if (!empty($this->cart->total_items())) {
				foreach ($this->cart->contents() as $items) {
					$id = $items['id'];
					$qtylama = $items['qty'];
					$rowid = $items['rowid'];
					$kobar = $this->input->post('kode_brg');
					$qty = $this->input->post('qty');
					if ($id == $kobar) {
						$up = array(
							'rowid' => $rowid,
							'qty' => $qtylama + $qty
						);
						$this->cart->update($up);
					} else {
						$this->cart->insert($data);
					}
				}
			} else {
				$this->cart->insert($data);
			}

			redirect('admin/pemasukan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function remove()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$row_id = $this->uri->segment(4);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     => 0
			));
			redirect('admin/pemasukan');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function simpan_pemasukan()
	{
		if ($this->session->userdata('akses') == '1' || $this->session->userdata('akses') == '2') {
			$total = $this->input->post('total');
			$jml_uang = str_replace(",", "", $this->input->post('jml_uang'));
			$kembalian = $jml_uang - $total;
			if (!empty($total) && !empty($jml_uang)) {
				if ($jml_uang < $total) {
					echo $this->session->set_flashdata(
						'msg',
						'<div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
						Jumlah uang yang Anda Masukkan Kurang!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
					);
					redirect('admin/pemasukan');
				} else {
					$nofak = $this->m_pemasukan->get_nofak();
					$this->session->set_userdata('nofak', $nofak);
					$order_proses = $this->m_pemasukan->simpan_pemasukan($nofak, $total, $jml_uang, $kembalian);
					if ($order_proses) {
						$this->cart->destroy();

						$this->session->unset_userdata('tglfak');
						$this->session->unset_userdata('supplier');
						$this->load->view('admin/alert/alert_sukses');
					} else {
						redirect('admin/pemasukan');
					}
				}
			} else {
				echo $this->session->set_flashdata('msg', '
				<div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
						pemasukan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				');
				redirect('admin/pemasukan');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}

	function cetak_faktur()
	{
		$x['data'] = $this->m_pemasukan->cetak_faktur();
		$this->load->view('admin/laporan/v_faktur', $x);
		//$this->session->unset_userdata('nofak');
	}
}
