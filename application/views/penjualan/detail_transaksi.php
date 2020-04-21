<div class="container-fluid" id="container-wrapper">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-2 mr-3 ml-3">
                    <?= $this->session->flashdata('message') ?>
                </div>
                <div class="card-body">
                    <div class="container">
                        <h3 class="mb-3">Detail Transaksi</h3>
                    </div>
                    <div class="table-responsive">
                        <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="add-row" class="display table table-hover table-sm table-bordered" role="grid" aria-describedby="add-row_info">
                                        <thead>
                                            <tr>
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $grand_total = 0; ?>
                                            <?php foreach ($detail as $b) : ?>
                                                <tr role="row">
                                                    <td><?= $b['idbarang']; ?></td>
                                                    <td><?= $b['namabarang']; ?></td>
                                                    <td><?= toRupiah($b['hargajual']) ?></td>
                                                    <td><?= $b['jumlah']; ?></td>
                                                    <td><?= toRupiah($b['jumlah'] * $b['hargajual']); ?></td>
                                                </tr>
                                                <?php $grand_total += $b['jumlah'] * $b['hargajual'] ?>
                                            <?php endforeach; ?>
                                            <tr class="table table-primary">
                                                <td colspan="3">
                                                </td>
                                                <td>
                                                    <h4><b>Total</b></h4>
                                                </td>
                                                <td colspan="2">
                                                    <h4><b id="grandtotal"><?= toRupiah($grand_total); ?></b></h4>
                                                </td>
                                            </tr>
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
</div>