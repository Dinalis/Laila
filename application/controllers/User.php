<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('auth');
        }

        $this->load->model('M_users', 'users');

        $this->user = $this->users->getBy(['username' => $this->session->userdata('username')])->row_array();
    }

    public function index()
    {
        $data['title'] = 'Edit Profil';
        $data['users'] = $this->user;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);

        if ($_POST) {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $email = $this->input->post('email');

            $a_user = [
                'nama' => $nama,
                'username' => $username,
                'email' => $email
            ];

            $ok = $this->users->update($a_user, ['iduser' => $this->user['iduser']], true);
            $ok ? setFlashMessage('Berhasil mengedit profil', 'success') : setFlashMessage('Gagal mengedit profil', 'danger');
            redirect('user');
        }
    }

    public function gantipassword()
    {
        $data['title'] = 'Ganti Password';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/password', $data);
        $this->load->view('templates/footer', $data);

        if ($_POST) {
            $oldpass = $this->input->post('oldpassword');
            $newpass = $this->input->post('newpassword');
            $newpassconf = $this->input->post('newpasswordconf');

            if (password_verify($oldpass, $this->user['password'])) {
                if ($newpass == $newpassconf) {
                    if ($newpass != $oldpass) {
                        $update = $this->db->update('users', ['password' => password_hash($newpass, PASSWORD_DEFAULT)], ['iduser' => $this->user['iduser']]);
                        $update ? setFlashMessage('Berhasil merubah password', 'success') : setFlashMessage('Gagal merubah password!', 'danger');
                    } else {
                        setFlashMessage('Password tidak boleh sama dengan yang lama!', 'danger');
                    }
                } else {
                    setFlashMessage('Password tidak cocok!', 'danger');
                }
            } else {
                setFlashMessage('Password salah!', 'danger');
            }

            redirect('user/gantipassword');
        }
    }
}
