<div class="container-fluid" id="container-wrapper">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-2 mr-3 ml-3">
                    <?= $this->session->flashdata('message') ?>
                </div>
                <div class="card-body">
                    <div class="container mb-3">
                        <h3><b>Transaksi</b></h3>
                    </div>
                    <form action="<?= base_url('penjualan') ?>" method="post" id="databarang">
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
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="formbarang">
                                                    <td colspan="2">
                                                        <div class="form-group mt-3">
                                                            <select name="barang" id="barang" class="form-control"></select>
                                                            <input type="hidden" id="iduser" name="iduser" value="<?= $this->session->userdata('iduser'); ?>">
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-group">
                                                            <input type="number" id="jumlah" name="jumlah" class="form-control mt-2" placeholder="Qty">
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-group mt-3">
                                                            <button type="button" data-type="btntambahbarang" class="btn btn-sm btn-primary btn-block"><i class="fas fa-plus mr-2"></i> Tambah</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $grand_total = 0; ?>
                                                <?php foreach ($transaksi as $b) : ?>
                                                    <tr role="row">
                                                        <td><?= $b['idbarang']; ?></td>
                                                        <td><?= $b['namabarang']; ?></td>
                                                        <td><?= toRupiah($b['hargajual']) ?></td>
                                                        <td><?= $b['jumlah']; ?></td>
                                                        <td><?= toRupiah($b['jumlah'] * $b['hargajual']); ?></td>
                                                        <td>
                                                            <div class="form-button-action">
                                                                <button type="button" data-toggle="tooltip" title="" data-type="hapus" data-id="<?= $b['id']; ?>" class="badge badge-danger" data-original-title="Hapus">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </td>
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
                                                <tr>
                                                    <td colspan="2">
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-group mt-2">
                                                            <select name="pelanggan" id="pelanggan" class="form-control" required></select>
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-group mt-2">
                                                            <input type="number" name="bayar" id="bayar" placeholder="Bayar" class="form-control" required <?= $grand_total == 0 ? 'readonly' : '' ?>>
                                                            <input type="hidden" name="grandtotal" value="<?= $grand_total; ?>">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-group mt-2">
                                                            <input type="text" data-selisih="" name="kembalian" id="kembalian" placeholder="Kembalian" class="form-control" readonly>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="form-group mt-2">
                                                            <button type="submit" class="btn btn-sm btn-primary btn-block" data-type="btnsimpan" <?= $grand_total == 0 ? 'disabled' : '' ?>><i class="fas fa-save"></i> Simpan</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('keyup', '#bayar', function() {
        var grandtotal = '<?= $grand_total; ?>';
        var uang = $(this).val();

        var selisih = uang - grandtotal;

        if (selisih >= 0) {
            $('#kembalian').val(selisih);
            $('#kembalian').attr('data-selisih', selisih);
        } else {
            $('#kembalian').val('Rp.0');
            $('#kembalian').attr('data-selisih', selisih);
        }

    });

    $('[data-type=btnsimpan]').click(function() {
        var selisih = $('#kembalian').attr('data-selisih');
        var form = $('#databarang');

        if (selisih >= 0) {
            form.submit();
        }
    });

    function to_rupiah(angka) {
        var rev = parseInt(angka, 10).toString().split('').reverse().join('');
        var rev2 = '';
        for (var i = 0; i < rev.length; i++) {
            rev2 += rev[i];
            if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
                rev2 += '.';
            }
        }
        return 'Rp. ' + rev2.split('').reverse().join('');
    }

    $('[data-type=btntambahbarang]').click(function() {
        var form = $('#formbarang');
        var idbarang = form.find('#barang').val();
        var jumlah = form.find('#jumlah').val();
        var iduser = form.find('#iduser').val();

        $.ajax({
            url: "<?= base_url('penjualan/keranjang') ?>",
            type: 'post',
            data: {
                idbarang: idbarang,
                jumlah: jumlah,
                iduser: iduser
            },
            success: function() {
                document.location.href = "<?= base_url('penjualan') ?>";
            }
        });
    });

    $('#barang').select2({
        minimumInputLength: 3,
        allowClear: true,
        placeholder: 'Masukkan barang',
        ajax: {
            dataType: 'json',
            type: 'POST',
            url: '<?= site_url('penjualan/getbarang/') ?>',
            delay: 250,
            data: function(params) {
                return {
                    cari: params.term
                }
            },
            processResults: function(data, page) {
                return {
                    results: data
                };
            },
        }
    });

    $('#pelanggan').select2({
        minimumInputLength: 3,
        allowClear: true,
        placeholder: 'Masukkan pelanggan',
        ajax: {
            dataType: 'json',
            type: 'POST',
            url: '<?= site_url('penjualan/getpelanggan/') ?>',
            delay: 250,
            data: function(params) {
                return {
                    cari: params.term
                }
            },
            processResults: function(data, page) {
                return {
                    results: data
                };
            },
        }
    });


    $('[data-type=hapus]').click(function() {
        var id = $(this).attr('data-id');

        $.ajax({
            url: '<?= base_url('penjualan/hapusbarang') ?>',
            method: 'post',
            data: {
                id: id
            },
            success: function() {
                document.location.href = "<?= base_url('penjualan') ?>";
            }

        });

    });

    $('[data-type=delete]').click(function() {
        location.href = '<?= site_url('penjualan/hapusTransaksi/') ?>' + $(this).attr('data-id');
    });
</script>