<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    protected $user = '';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Transaksi', 'transaksi');
        $this->load->model('M_Keranjang', 'keranjang');
        $this->load->model('M_Transaksidetail', 'detail');
        $this->load->model('M_Pendapatan', 'pendapatan');
        $this->load->model('Model_Barang', 'barang');
        $this->user = $this->session->userdata('iduser');
    }

    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['menu_now'] = 'Penjualan';
        $data['transaksi'] = $this->keranjang->joins(['barang'], ['idbarang'], null, ['idpegawai' => $this->user])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/index', $data);
        $this->load->view('templates/footer', $data);

        if (!empty($_POST)) {
            $idtransaksi = 'TR' . time();
            $idpelanggan = $this->input->post('pelanggan');
            $idkasir = $this->session->userdata('iduser');
            $total = $this->input->post('grandtotal');
            $diskon = 0;
            $grandtotal = $this->input->post('grandtotal');
            $bayar = $this->input->post('bayar');
            $kembalian = $this->input->post('kembalian');
            $waktu = time();


            $data_trans = [
                'idtransaksi' => $idtransaksi,
                'idpelanggan' => (int) $idpelanggan,
                'kasir' => (int) $idkasir,
                'total' => (int) $total,
                'diskon' => (int) $diskon,
                'grand_total' => (int) $grandtotal,
                'bayar' => (int) $bayar,
                'kembalian' => (int) $kembalian,
                'waktutransaksi' => (int) $waktu

            ];

            $a_pendapatan = [
                'idtransaksi' => $idtransaksi,
                'kasir' => (int) $idkasir,
                'tanggal' => date('Y-m-d'),
                'pemasukan' => (int) $grandtotal,
                'insert_at' => time()
            ];

            $detail_trans = $this->db->get_where('keranjang', ['idpegawai' => $this->session->userdata('iduser')])->result_array();
            $this->transaksi->beginTrans();
            $this->transaksi->insert($data_trans);
            foreach ($detail_trans as $key) {
                $a_detail = [
                    'transaksi' => $idtransaksi,
                    'barang' => $key['idbarang'],
                    'jumlah' => $key['jumlah']
                ];
                $stok = $this->barang->getBy(['idbarang' => $key['idbarang']])->row_array()['stok'];
                $this->detail->insert($a_detail);
                $this->barang->update(['stok' => $stok - $key['jumlah']], ['idbarang' => $key['idbarang']]);
            }
            $this->pendapatan->insert($a_pendapatan);
            $ok = $this->transaksi->statusTrans();
            $this->transaksi->commitTrans($ok);

            if ($ok) {
                $this->db->delete('keranjang', ['idpegawai' => $this->session->userdata('iduser')]);
                setFlashMessage('Berhasil menyimpan data', 'success');
            } else {
                setFlashMessage('Gagal menyimpan data', 'danger');
            }

            redirect('penjualan');
        }
    }

    public function riwayat()
    {
        $data['title'] = 'Riwayat Transaksi';
        $data['menu_now'] = 'Penjualan';
        $data['transaksi'] = $this->transaksi->getData()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/riwayat_transaksi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function riwayatDetail($id = null)
    {
        $found = false;

        $num = $this->detail->getDetail($id)->num_rows();
        $found = $num > 0 ? true : false;

        if (empty($id) || !$found) {
            redirect('penjualan/riwayat');
        }

        $data['title'] = 'Detail Transaksi';
        $data['menu_now'] = 'Penjualan';
        $data['detail'] = $this->detail->getDetail($id)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('penjualan/detail_transaksi', $data);
        $this->load->view('templates/footer', $data);
    }

    public function keranjang()
    {
        $idbarang = $this->input->post('idbarang');
        $jumlah = $this->input->post('jumlah');
        $iduser = $this->input->post('iduser');

        $stok = $this->barang->getBy(['idbarang' => $idbarang])->row_array()['stok'];
        if ($stok >= $jumlah) {
            $data = [
                'idpegawai' => $iduser,
                'idbarang' => $idbarang,
                'jumlah' => $jumlah
            ];
            $get = $this->keranjang->getBy(['idpegawai' => $iduser, 'idbarang' => $idbarang]);
            if ($get->num_rows() < 1) {
                $this->keranjang->insert($data, true);
            } else {
                $jumlah += $get->row_array()['jumlah'];
                $this->db->update('keranjang', ['jumlah' => $jumlah], ['idpegawai' => $iduser, 'idbarang' => $idbarang]);
            }
        } else {
            if ($stok == 0) {
                setFlashMessage('Maaf stok habis', 'danger');
            } else {
                setFlashMessage('Stok tidak mencukupi', 'danger');
            }
        }
    }

    public function hapusbarang()
    {
        $id = $this->input->post('id');
        $this->db->delete('keranjang', ['id' => $id]);
    }

    public function getPelanggan()
    {
        $keyword = $this->input->post('cari');
        $query = "SELECT * FROM pelanggan WHERE lower(namapelanggan) LIKE '%$keyword%'";
        $pelanggan = $this->db->query($query);

        if ($pelanggan->num_rows() < 1) {
            echo json_encode(array());
        } else {
            $data = array();
            foreach ($pelanggan->result_array() as $val) {
                $data[] = array('id' => $val['idpelanggan'], 'text' => $val['namapelanggan'] . ' - ' . $val['telp']);
            }
            echo json_encode($data);
        }
    }

    public function getBarang()
    {
        $keyword = $this->input->post('cari');
        $query = "SELECT * FROM barang WHERE lower(namabarang) LIKE '%$keyword%' OR lower(idbarang) LIKE '%$keyword%'";
        $barang = $this->db->query($query);

        if ($barang->num_rows() < 1) {
            echo json_encode(array());
        } else {
            $data = array();
            foreach ($barang->result_array() as $val) {
                $data[] = array('id' => $val['idbarang'], 'text' => $val['idbarang'] . ' - ' . $val['namabarang']);
            }
            echo json_encode($data);
        }
    }

    public function getPegawai()
    {
        $keyword = $this->input->post('cari');
        $query = "SELECT * FROM pegawai WHERE lower(namapegawai) LIKE '%$keyword%'";
        $pegawai = $this->db->query($query);

        if ($pegawai->num_rows() < 1) {
            echo json_encode(array());
        } else {
            $data = array();
            foreach ($pegawai->result_array() as $val) {
                $data[] = array('id' => $val['idpegawai'], 'text' => $val['namapegawai'] . ' - ' . $val['telp']);
            }
            echo json_encode($data);
        }
    }

    public function hapusTransaksi($id)
    {
        $del = $this->transaksi->delete(['idtransaksi' => $id], true);
        $del ? setFlashMessage('Berhasil menghapus data!', 'success') : setFlashMessage('Gagal menghapus data!', 'danger');
        redirect('penjualan');
    }
}
