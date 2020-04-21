<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Pendapatan', 'pendapatan');
    }

    public function index()
    {
        if (!empty($_POST)) {
            $tglmulai = $this->input->post('tglmulai');
            $tglsampai = $this->input->post('tglsampai');
            $data['pendapatan'] = $this->pendapatan->getPendapatan($tglmulai, $tglsampai)->result_array();
        } else {
            $data['pendapatan'] = null;
        }
        $data['title'] = 'Laporan';
        $data['menu_now'] = 'Laporan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
