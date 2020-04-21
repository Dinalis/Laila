<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_transaksi extends MY_Models
{
    protected $table = 'transaksi';
    protected $key = 'idtransaksi';
    protected $schema = '';

    public function getData()
    {
        $query = "SELECT * FROM transaksi_detail t JOIN transaksi td ON t.transaksi=td.idtransaksi JOIN users u ON td.kasir=u.iduser JOIN pelanggan p ON td.idpelanggan=p.idpelanggan JOIN barang b ON t.barang=b.idbarang";

        return $this->db->query($query);
    }

    public function getDataByKey($key)
    {
        $query = "SELECT * FROM transaksi_detail t JOIN transaksi td ON t.transaksi=td.idtransaksi JOIN users u ON td.kasir=u.iduser JOIN pelanggan p ON td.idpelanggan=p.idpelanggan JOIN barang b ON t.barang=b.idbarang WHERE td.idtransaksi='$key'";

        return $this->db->query($query);
    }
}
