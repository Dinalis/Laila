<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('username'))) {
            redirect('auth');
        }

        $this->load->model('M_users', 'users');
        $this->load->model('M_transaksi', 'transaksi');

        $this->user = $this->users->getBy(['username' => $this->session->userdata('username')])->row_array();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['users'] = $this->user;
        $data['count_user'] = $this->users->get()->num_rows();
        $data['count_trx'] = $this->transaksi->get()->num_rows();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('home/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
