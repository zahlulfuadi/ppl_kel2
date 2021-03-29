<?php
class Pengeluaran extends CI_Controller
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
		$this->load->model('m_pengeluaran');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$x['sup'] = $this->m_supplier->tampil_supplier();
			$x['judul'] = "Pengeluaran";
			$this->load->view('admin/v_pengeluaran', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function get_barang()
	{
		if ($this->session->userdata('akses') == '1') {
			$kobar = $this->input->post('kode_brg');
			$x['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('admin/v_detail_barang_beli', $x);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function add_to_cart()
	{
		if ($this->session->userdata('akses') == '1') {
			$id_pengeluaran = $this->input->post('id_pengeluaran');
			$tgl = $this->input->post('tgl');
			$supplier = $this->input->post('supplier');
			$this->session->set_userdata('id_pengeluaran', $id_pengeluaran);
			$this->session->set_userdata('tgl', $tgl);
			$this->session->set_userdata('supplier', $supplier);
			$kobar = $this->input->post('kode_brg');
			$produk = $this->m_barang->get_barang($kobar);
			$i = $produk->row_array();
			$data = array(
				'jenis'    => 'pengeluaran',
				'id'       => $i['id_barang'],
				'name'     => $i['nama_barang'],
				'satuan'   => $i['nama_satuan'],
				'price'    => $this->input->post('harpok'),
				'harga'    => $this->input->post('harjul'),
				'qty'      => $this->input->post('jumlah')
			);

			$this->cart->insert($data);
			redirect('admin/pengeluaran');
		} else {
			echo "Halaman tidak ditemukan";
			// $this->session->userdata('akses');
		}
	}
	function remove()
	{
		if ($this->session->userdata('akses') == '1') {
			$row_id = $this->uri->segment(4);
			$this->cart->update(array(
				'rowid'      => $row_id,
				'qty'     => 0
			));
			redirect('admin/pengeluaran');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function simpan_pengeluaran()
	{
		if ($this->session->userdata('akses') == '1') {
			$id_pengeluaran = $this->session->userdata('id_pengeluaran');
			$tglfak = $this->session->userdata('tglfak');
			$supplier = $this->session->userdata('supplier');
			if (!empty($id_pengeluaran) && !empty($tglfak) && !empty($supplier)) {
				$beli_kode = $this->m_pengeluaran->get_kobel();
				$order_proses = $this->m_pengeluaran->simpan_pengeluaran($id_pengeluaran, $tglfak, $supplier, $beli_kode);
				if ($order_proses) {
					$this->cart->destroy();
					$this->session->unset_userdata('id_pengeluaran');
					$this->session->unset_userdata('tglfak');
					$this->session->unset_userdata('supplier');
					echo $this->session->set_flashdata(
						'msg',
						'<div class="alert alert-success alert-dismissible fade show text-white" role="alert">
							pengeluaran Berhasil di Simpan ke Database
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>'
					);
					redirect('admin/pengeluaran');
				} else {
					redirect('admin/pengeluaran');
				}
			} else {
				echo $this->session->set_flashdata(
					'msg',
					'<div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
						pengeluaran Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>'
				);
				redirect('admin/pengeluaran');
			}
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
}
