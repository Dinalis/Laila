<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksidetail extends MY_Models
{
    protected $table = 'transaksi_detail';
    protected $key = 'idtransdetail';
    protected $schema = '';

    public function getDetail($id)
    {
        $query = "SELECT * FROM transaksi_detail td JOIN barang b ON td.barang=b.idbarang WHERE td.transaksi='$id'";
        return $this->db->query($query);
    }
}
