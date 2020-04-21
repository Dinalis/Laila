<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manajemen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Users', 'users');
    }

    public function index()
    {
        $data['title'] = 'Manajemen User';
        $data['menu_now'] = 'Manajemen';
        $data['users_list'] = $this->users->joins(['user_role'], ['idrole'])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manajemen/index', $data);
        $this->load->view('templates/footer', $data);

        if (!empty($_POST)) {
        }
    }

    public function gantipassword()
    {
        $data['title'] = 'Ganti Password';
        $data['menu_now'] = '';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('manajemen/gantipassword', $data);
        $this->load->view('templates/footer', $data);

        $userid = $this->session->userdata('iduser');
        $pwuser = $this->users->getByKey($userid)->row_array()['password'];

        if (!empty($_POST)) {
            $pwlama = $this->input->post('passwordlama');
            $pwbaru = $this->input->post('passwordbaru');
            $pwbaru2 = $this->input->post('passwordbaru2');

            if (password_verify($pwlama, $pwuser)) {
                if ($pwbaru == $pwbaru2) {
                    if ($pwbaru != $pwlama) {
                        if (strlen($pwbaru) > 7) {
                            $data = [
                                'password' => password_hash($pwbaru, PASSWORD_DEFAULT)
                            ];
                            $ins = $this->users->update($data, ['iduser' => $userid], true);
                            $ins ? setFlashMessage('Berhasil merubah password!', 'success') : setFlashMessage('Gagal merubah password!', 'danger');
                        } else {
                            setFlashMessage('Masukkan password minimal 8 karakter!', 'danger');
                        }
                    } else {
                        setFlashMessage('Password baru tidak boleh sama dengan password lama!', 'danger');
                    }
                } else {
                    setFlashMessage('Password tidak cocok!', 'danger');
                }
            } else {
                setFlashMessage('Password lama salah!', 'danger');
            }
            redirect('manajemen/gantipassword');
        }
    }

    public function userstatus($id, $status)
    {
        if ($status == 1) {
            $val = 0;
            $arg = 'Menon-aktifkan user';
        } else {
            $val = 1;
            $arg = 'Meng-aktifkan user';
        }
        $data = [
            'status' => $val
        ];

        $up = $this->users->update($data, ['iduser' => $id], true);
        $up ? setFlashMessage('Berhasil ' . $arg, 'success') : setFlashMessage('Gagal ' . $arg, 'danger');
        redirect('manajemen');
    }
}
