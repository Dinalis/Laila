<?php

function setFlashMessage($msg, $type)
{
    //type adalah tipe dari alert
    //message pesan nya
    $ci = get_instance();
    $ci->session->set_flashdata('message', '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' . $msg . '               
        <button type="button" class="close mb-3" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" >&times;</span>
        </button></div>');
}

function toRupiah($x)
{

    $hasil_rupiah = "Rp " . number_format($x, 0, ',', '.');
    return $hasil_rupiah;
}
