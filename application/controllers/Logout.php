<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->session->unset_userdata('iduser');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('idrole');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('email');
        redirect(base_url());
    }
}
