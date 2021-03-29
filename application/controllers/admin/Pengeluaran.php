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
		$this->load->model('m_pengguna');
	}
	function index()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');

			$data['sup'] = $this->m_supplier->tampil_supplier();
			$data['profil'] = $this->m_pengguna->get_pengguna_by_id($id_user)->result_array()[0];
			$data['judul'] = "Input Pengeluaran";
			$this->load->view('admin/v_pengeluaran', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function get_barang()
	{
		if ($this->session->userdata('masuk') == true) {
			$kobar = $this->input->post('kode_brg');
			$data['brg'] = $this->m_barang->get_barang($kobar);
			$this->load->view('admin/v_detail_barang_beli', $data);
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function add_to_cart()
	{
		if ($this->session->userdata('masuk') == true) {
			$id_user = $this->session->userdata('idadmin');
			// $id_pengeluaran = $this->input->post('id_pengeluaran');
			$tgl = $this->input->post('tgl');
			$supplier = $this->input->post('supplier');
			// $this->session->set_userdata('id_pengeluaran', $id_pengeluaran);
			$this->session->set_userdata('tgl', $tgl);
			$this->session->set_userdata('supplier', $supplier);
			$kobar = $this->input->post('kode_brg');
			$produk = $this->m_barang->get_barang($kobar);
			$i = $produk->row_array();
			$data = array(
				'jenis'    		=> 'pengeluaran',
				'id'       		=> $i['id_barang'],
				'name'     		=> $i['nama_barang'],
				'satuan'   		=> $i['satuan_barang'],
				'price'    		=> $this->input->post('harpok'),
				'harga'   		=> $this->input->post('harjul'),
				'qty'      		=> $this->input->post('jumlah'),
				'id_supplier'   => $supplier,
				'id_user' 		=> $id_user
			);

			$this->cart->insert($data);
			redirect('admin/pengeluaran');
		} else {
			echo "Halaman tidak ditemukan";
		}
	}
	function remove()
	{
		if ($this->session->userdata('masuk') == true) {
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
		if ($this->session->userdata('masuk') == true) {
			// $id_pengeluaran = $this->session->userdata('id_pengeluaran');
			$id_pengeluaran = "";
			$tgl = $this->session->userdata('tgl');
			$id_supplier = $this->session->userdata('supplier');
			$ket = "keterangan"; //ini tes aja dulu
			if (!empty($tgl)) {
				// $beli_kode = $this->m_pengeluaran->get_kobel();
				$order_proses = $this->m_pengeluaran->simpan_pengeluaran($id_pengeluaran, $tgl, $id_supplier, $ket);
				if ($order_proses) {
					$this->cart->destroy();
					$this->session->unset_userdata('id_pengeluaran');
					$this->session->unset_userdata('tgl');
					$this->session->unset_userdata('supplier');
					echo $this->session->set_flashdata(
						'msg',
						'<div class="alert alert-success alert-dismissible fade show text-white" role="alert">
							Pengeluaran Berhasil di Simpan ke Database
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
						Pengeluaran Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!
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
