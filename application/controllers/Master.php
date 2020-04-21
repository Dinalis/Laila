<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Barang', 'barang');
        $this->load->model('Model_Pegawai', 'pegawai');
        $this->load->model('Model_Kategori', 'kategori');
        $this->load->model('Model_Pelanggan', 'pelanggan');
        $this->load->model('M_Users', 'user');
    }

    public function index()
    {
        $data['title'] = 'Data Barang';
        $data['menu_now'] = 'Master';
        $data['barang'] = $this->barang->joins(['merk_barang'], ['idmerk'])->result_array();
        $data['kategori'] = $this->kategori->get()->result_array();
        $data['merk'] = $this->db->get('merk_barang')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/index', $data);
        $this->load->view('templates/footer', $data);

        if (!empty($_POST)) {
            $act = $this->input->post('act');
            $key = $this->input->post('key');
            $idbarang = $this->input->post('idbarang');
            $idkategori = $this->input->post('idkategori');
            $namabarang = $this->input->post('namabarang');
            $keterangan = $this->input->post('keterangan');
            $stok = $this->input->post('stok');
            $merk = $this->input->post('merk');
            $hargabeli = $this->input->post('hargabeli');
            $hargajual = $this->input->post('hargajual');

            $data = [
                'idbarang' => $act == 'edit' ? $key : $idbarang,
                'idkategori' => $idkategori,
                'idmerk' => $merk,
                'namabarang' => $namabarang,
                'keterangan' => $keterangan,
                'stok' => $stok,
                'hargabeli' => $hargabeli,
                'hargajual' => $hargajual
            ];

            if ($act == 'tambah') {
                if (!empty($idbarang)) {
                    $ins = $this->barang->insert($data, true);
                    $ins ? setFlashMessage('Berhasil menambah barang', 'success') : setFlashMessage('Gagal menambah barang', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master');
            } else if ($act == 'edit') {
                if (!empty($key)) {
                    $ins = $this->barang->update($data, ['idbarang' => $key], true);
                    $ins ? setFlashMessage('Berhasil merubah barang', 'success') : setFlashMessage('Gagal merubah barang', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master');
            }
        }
    }

    public function pegawai()
    {
        $data['title'] = 'Data Pegawai';
        $data['menu_now'] = 'Master';
        $data['pegawai'] = $this->pegawai->joins(['user_role'], ['idrole'])->result_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['pendidikan'] = $this->db->get('pendidikan')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/pegawai', $data);
        $this->load->view('templates/footer', $data);

        if (!empty($_POST)) {
            $act = $this->input->post('act');
            $key = $this->input->post('key');
            $idpegawai = $this->input->post('idpegawai');
            $idrole = $this->input->post('idrole');
            $nama = $this->input->post('nama');
            $jk = $this->input->post('jk');
            $telp = (string) $this->input->post('telp');
            $alamat = $this->input->post('alamat');
            $ttl = $this->input->post('ttl');
            $email = $this->input->post('email');
            $idpendidikan = $this->input->post('idpendidikan');
            $iduser = (int) $this->user->getAutoIncrement();

            $data = [
                'idpegawai' => $idpegawai,
                'iduser' => $iduser,
                'namapegawai' => $nama,
                'jeniskelamin' => $jk,
                'telp' => $telp,
                'ttl' => $ttl,
                'email' => $email,
                'alamat' => $alamat,
                'idrole' => $idrole,
                'idpendidikan' => $idpendidikan
            ];

            $data_user = [
                'idrole' => $idrole,
                'nama' => $nama,
                'username' => $email,
                'password' => password_hash('easyprinting123', PASSWORD_DEFAULT),
                'email' => $email,
                'create_at' => time(),
                'status' => 1
            ];

            if ($act == 'tambah') {
                if (!empty($idpegawai)) {
                    $us = $this->user->insert($data_user, true);
                    $ins = $this->pegawai->insert($data, true);
                    $ins && $us ? setFlashMessage('Berhasil menambah pegawai', 'success') : setFlashMessage('Gagal menambah pegawai', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/pegawai');
            } else if ($act == 'edit') {
                if (!empty($key)) {
                    $ins = $this->pegawai->insert($data, true);
                    $ins ? setFlashMessage('Berhasil merubah pegawai', 'success') : setFlashMessage('Gagal merubah pegawai', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/pegawai');
            } else {
                setFlashMessage('Method tidak valid!', 'danger');
                redirect('master/pegawai');
            }
        }
    }

    public function role()
    {
        $data['title'] = 'List Role';
        $data['menu_now'] = 'Master';
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/role', $data);
        $this->load->view('templates/footer', $data);

        if (!empty($_POST)) {
            $act = $this->input->post('act');
            $key = $this->input->post('key');
            $role = $this->input->post('role');

            if ($act == 'tambah') {
                if (!empty($role)) {
                    $ins = $this->db->insert('user_role', ['role' => $role]);
                    $ins ? setFlashMessage('Berhasil menambah role!', 'success') : setFlashMessage('Gagal menambah role!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/role');
            } else if ($act == 'edit') {
                if (!empty($role)) {
                    $up = $this->db->update('user_role', ['role' => $role], ['idrole' => $key]);
                    $up ? setFlashMessage('Berhasil merubah role!', 'success') : setFlashMessage('Gagal merubah role!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/role');
            }
        }
    }

    public function kategori()
    {
        $data['title'] = 'List Kategori';
        $data['menu_now'] = 'Master';
        $data['kategori'] = $this->kategori->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/kategori', $data);
        $this->load->view('templates/footer', $data);

        if ($_POST) {
            $act = $this->input->post('act');
            $key = $this->input->post('key');
            $kategori = $this->input->post('kategori');

            if ($act == 'tambah') {
                if (!empty($kategori)) {
                    $ins = $this->db->insert('kategoribarang', ['kategori' => $kategori]);
                    $ins ? setFlashMessage('Berhasil menambah kategori!', 'success') : setFlashMessage('Gagal menambah kategori!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/kategori');
            } else if ($act == 'edit') {
                if (!empty($kategori)) {
                    $up = $this->db->update('kategoribarang', ['kategori' => $kategori], ['idkategori' => $key]);
                    $up ? setFlashMessage('Berhasil merubah kategori!', 'success') : setFlashMessage('Gagal merubah kategori!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/kategori');
            }
        }
    }

    public function merkbarang()
    {
        $data['title'] = 'List Merk';
        $data['menu_now'] = 'Master';
        $data['merk'] = $this->db->get('merk_barang')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/merkbarang', $data);
        $this->load->view('templates/footer', $data);

        if ($_POST) {
            $act = $this->input->post('act');
            $key = $this->input->post('key');
            $merk = $this->input->post('merk');

            if ($act == 'tambah') {
                if (!empty($merk)) {
                    $ins = $this->db->insert('merk_barang', ['merk' => $merk]);
                    $ins ? setFlashMessage('Berhasil menambah merk!', 'success') : setFlashMessage('Gagal menambah merk!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/merkbarang');
            } else if ($act == 'edit') {
                if (!empty($merk)) {
                    $up = $this->db->update('merk_barang', ['merk' => $merk], ['idmerk' => $key]);
                    $up ? setFlashMessage('Berhasil merubah merk!', 'success') : setFlashMessage('Gagal merubah merk!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/merkbarang');
            }
        }
    }

    public function Pelanggan()
    {
        $data['title'] = 'Data Pelanggan';
        $data['menu_now'] = 'Master';
        $data['pelanggan'] = $this->pelanggan->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('master/pelanggan', $data);
        $this->load->view('templates/footer', $data);

        if (!empty($_POST)) {
            $act = $this->input->post('act');
            $key = $this->input->post('key');
            $nama = $this->input->post('nama');
            $jk = $this->input->post('jk');
            $alamat = $this->input->post('alamat');
            $notelp = $this->input->post('telp');
            $info = $this->input->post('info');

            $data = [
                'namapelanggan' => $nama,
                'jeniskelamin' => $jk,
                'telp' => $notelp,
                'alamat' => $alamat,
                'infotambahan' => $info
            ];


            if ($act == 'tambah') {
                if (!empty($nama)) {
                    $ins = $this->pelanggan->insert($data, true);
                    $ins ? setFlashMessage('Berhasil menambah pelanggan!', 'success') : setFlashMessage('Gagal menambah pelanggan!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/pelanggan');
            } else if ($act == 'edit') {
                if (!empty($nama)) {
                    $up = $this->pelanggan->update($data, ['idpelanggan' => $key], true);
                    $up ? setFlashMessage('Berhasil merubah pelanggan!', 'success') : setFlashMessage('Gagal merubah pelanggan!', 'danger');
                } else {
                    setFlashMessage('Data tidak lengkap!', 'danger');
                }
                redirect('master/pelanggan');
            }
        }
    }

    public function getBarang($key)
    {
        echo json_encode($this->barang->getByKey($key)->row_array());
    }

    public function getPegawai($key)
    {
        echo json_encode($this->pegawai->getByKey($key)->row_array());
    }

    public function getPelanggan($key)
    {
        echo json_encode($this->pelanggan->getByKey($key)->row_array());
    }

    public function getRole($key)
    {
        echo json_encode($this->db->get_where('user_role', ['idrole' => $key])->row_array());
    }

    public function getKategori($key)
    {
        echo json_encode($this->db->get_where('kategoribarang', ['idkategori' => $key])->row_array());
    }

    public function getMerk($key)
    {
        echo json_encode($this->db->get_where('merk_barang', ['idmerk' => $key])->row_array());
    }

    public function hapusBarang($key)
    {
        $del = $this->barang->delete(['idbarang' => $key], true);
        $del ? setFlashMessage('Berhasil menghapus barang!', 'success') : setFlashMessage('Gagal menghapus barang!', 'danger');
        redirect('master');
    }

    public function hapusPegawai($key)
    {
        $del = $this->pegawai->delete(['idpegawai' => $key], true);
        $del ? setFlashMessage('Berhasil menghapus pegawai!', 'success') : setFlashMessage('Gagal menghapus pegawai!', 'danger');
        redirect('master/pegawai');
    }

    public function hapusRole($key)
    {
        $del = $this->db->delete('user_role', ['idrole' => $key]);
        $del ? setFlashMessage('Berhasil menghapus role!', 'success') : setFlashMessage('Gagal menghapus role!', 'danger');
        redirect('master/role');
    }

    public function hapusKategori($key)
    {
        $del = $this->db->delete('kategoribarang', ['idkategori' => $key]);
        $del ? setFlashMessage('Berhasil menghapus kategori barang!', 'success') : setFlashMessage('Gagal menghapus kategori barang!', 'danger');
        redirect('master/kategori');
    }

    public function hapusPelanggan($key)
    {
        $del = $this->pelanggan->delete(['idpelanggan' => $key], true);
        $del ? setFlashMessage('Berhasil menghapus pelanggan!', 'success') : setFlashMessage('Gagal menghapus pelanggan!', 'danger');
        redirect('master/pelanggan');
    }
}
