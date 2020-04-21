<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('auth/index');

        if ($_POST) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if (!empty($username) && !empty($password)) {
                $getData = $this->db->get_where('users', ['username' => $username]);
                if ($getData->num_rows() > 0) {
                    $data = $getData->row_array();
                    if (password_verify($password, $data['password'])) {
                        $session = [
                            'iduser' => $data['iduser'],
                            'idrole' => $data['idrole'],
                            'nama' => $data['nama'],
                            'username' => $data['username'],
                            'email' => $data['email']
                        ];
                        $this->session->set_userdata($session);
                        redirect('home');
                    } else {
                        setFlashMessage('Password salah!', 'danger');
                    }
                } else {
                    setFlashMessage('Akun tidak terdaftar', 'danger');
                }
            } else {
                setFlashMessage('Isi username dan password!', 'danger');
            }

            redirect('auth');
        }
    }

    public function logout()
    {
      $this->session->unset_userdata('username');
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('idrole');
      $this->session->unset_userdata('nama');
      $this->session->unset_userdata('iduser');
 
      redirect('auth');  
    }
}
