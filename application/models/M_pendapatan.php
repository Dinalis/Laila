<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pendapatan extends MY_Models
{
    protected $table = 'pendapatan';
    protected $key = 'idpendapatan';
    protected $schema = '';

    public function getPendapatan($from, $to)
    {
        return $this->db->query($this->query($from, $to));
    }

    public function query($from, $to)
    {
        return "SELECT DISTINCT(SUBSTR(a.`tanggal`, 1, 10)) AS tanggal,
        (
            SELECT 
                SUM(b.`pemasukan`) 
            FROM 
                `pendapatan` AS b 
            WHERE 
                SUBSTR(b.`tanggal`, 1, 10) = SUBSTR(a.`tanggal`, 1, 10) 
            LIMIT 1
        ) AS total 
    FROM 
        `pendapatan` AS a 
    WHERE 
        SUBSTR(a.`tanggal`, 1, 10) >= '" . $from . "' 
        AND SUBSTR(a.`tanggal`, 1, 10) <= '" . $to . "' 
    ORDER BY 
        a.`tanggal` ASC";
    }
}
