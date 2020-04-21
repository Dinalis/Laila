<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('laporan') ?>">Laporan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Pendapatan</li>
        </ol>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title"><?= $title ?> Pendapatan</h4>
                </div>
            </div>
            <div class="mt-2">
                <?= $this->session->flashdata('message') ?>
            </div>
            <div class="card-body">
                <div class="mb-3 ml-3">
                    <form action="<?= base_url('laporan') ?>" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tglmulai">Dari tanggal</label>
                                    <input type="date" name="tglmulai" id="tglmulai" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tglsampai">Sampai tanggal</label>
                                    <input type="date" name="tglsampai" id="tglsampai" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary">Tampilkan</button>
                        </div>
                    </form>
                </div>
                <div class="mb-3 ml-3">
                    <button type="button" class="btn btn-sm btn-success">Cetak <i class="fa fa-print"></i></button>
                </div>
                <div class="table-responsive">
                    <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-10">
                                <table id="add-row" class="display table table-hover table-bordered" role="grid" aria-describedby="add-row_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">#No</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Total Pendapatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php $all_total = 0; ?>
                                        <?php if ($pendapatan != null) : ?>
                                            <?php foreach ($pendapatan as $p) : ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $p['tanggal']; ?></td>
                                                    <td><?= toRupiah($p['total']) ?></td>
                                                </tr>
                                                <?php $all_total += $p['total']; ?>
                                            <?php endforeach; ?>
                                        <?php endif ?>
                                        <tr>
                                            <td colspan="2"><b>Total Seluruh Pendapatan</b></td>
                                            <td><b><?= toRupiah($all_total); ?></b></td>
                                        </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>