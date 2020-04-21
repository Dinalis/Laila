<?php
function getStatus($status)
{
    switch ($status) {
        case 0:
            return 'Belum dicetak';
            $color = 'danger';
            break;
        case 1:
            return 'Sudah dicetak';
            $color = 'warning';
            break;
        case 2:
            return 'Sudah diambil';
            $color = 'success';
            break;
    }
}

function getColor($status)
{
    switch ($status) {
        case 0:
            return 'danger';
            break;
        case 1:
            return 'warning';
            break;
        case 2:
            return 'success';
            break;
    }
}


?>
<style>
    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            margin-top: 20px;
        }
    }
</style>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('penjualan') ?>">Penjualan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Riwayat Penjualan</li>
        </ol>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="mt-2 mr-3 ml-3">
                <?= $this->session->flashdata('message') ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <a href="<?= base_url('penjualan/riwayat') ?>" class="badge badge-success mb-3"><i class="fas fa-sync-alt mr-1"></i> Refresh</a>
                            <div class="col-sm-12">
                                <table id="add-row" class="display table table-hover table-head-bg-primary" role="grid" aria-describedby="add-row_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">ID Transaksi</th>
                                            <th scope="col">Grand Total</th>
                                            <th scope="col">Pelanggan</th>
                                            <th scope="col">Kasir</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($transaksi as $b) : ?>
                                            <tr role="row">
                                                <td><?= date('d M Y', $b['waktutransaksi']); ?></td>
                                                <td><?= $b['idtransaksi']; ?></td>
                                                <td><?= toRupiah($b['grand_total']) ?></td>
                                                <td><?= $b['namapelanggan']; ?></td>
                                                <td><?= $b['nama']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('penjualan/riwayatdetail/' . $b['idtransaksi']) ?>" data-toggle="tooltip" title="" data-type="detail" data-id="<?= $b['idtransaksi']; ?>" class="btn btn-link btn-primary btn-sm" data-original-title="Detail transaksi">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('#add-row').DataTable();
</script>