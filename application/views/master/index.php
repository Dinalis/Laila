<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary btn-round ml-auto" data-type="tambah">
                    <i class="fa fa-plus mr-1"></i>
                    Tambah <?= $title ?>
                </button>
                <div class="mt-2">
                    <?= $this->session->flashdata('message') ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="add-row" class="display table table-hover table-head-bg-primary" role="grid" aria-describedby="add-row_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode Barang</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Merk</th>
                                            <th scope="col">Stok</th>
                                            <?php if ($this->session->userdata('idrole') > 0) : ?>
                                                <th scope="col">Harga Beli</th>
                                            <?php endif; ?>
                                            <th scope="col">Harga Jual</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 1; ?>
                                        <?php foreach ($barang as $b) : ?>
                                            <tr role="row" class="odd">
                                                <td><?= $index++; ?></td>
                                                <td><?= $b['idbarang']; ?></td>
                                                <td><?= $b['namabarang']; ?></td>
                                                <td><?= $b['merk']; ?></td>
                                                <td><?= $b['stok']; ?></td>
                                                <?php if ($this->session->userdata('idrole') > 0) : ?>
                                                    <td><?= toRupiah($b['hargabeli']); ?></td>
                                                <?php endif; ?>
                                                <td><?= toRupiah($b['hargajual']); ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" title="" data-type="edit" data-id="<?= $b['idbarang']; ?>" class="badge badge-primary">
                                                            Edit
                                                        </button>
                                                        <button type="button" title="" data-type="hapus" data-id="<?= $b['idbarang']; ?>" class="badge badge-danger">
                                                            Hapus
                                                        </button>
                                                    </div>
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
<!-- Modal -->
<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <span class="fw-mediumbold" id="labelModal">
                        Tambah <?= $title; ?></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('master') ?>" id="modal_post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Kode Barang</label>
                                <input id="idbarang" name="idbarang" type="text" class="form-control" placeholder="Masukkan kode barang">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Nama</label>
                                <input id="namabarang" name="namabarang" type="text" class="form-control" placeholder="Masukkan nama" value="">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Keterangan</label>
                                <input id="keterangan" name="keterangan" type="text" class="form-control" placeholder="Masukkan keterangan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Kategori</label>
                                <select name="idkategori" id="idkategori" class="form-control" required>
                                    <?php foreach ($kategori as $kt) : ?>
                                        <option value="<?= $kt['idkategori'] ?>"><?= $kt['kategori'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Merk Barang</label>
                                <select name="merk" id="merk" class="form-control" required>
                                    <?php foreach ($merk as $kt) : ?>
                                        <option value="<?= $kt['idmerk'] ?>"><?= $kt['merk'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Stok</label>
                                <input id="stok" name="stok" type="number" class="form-control" placeholder="Masukkan stok barang">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Harga beli</label>
                                <input id="hargabeli" name="hargabeli" type="number" class="form-control" placeholder="Masukkan harga beli">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Harga Jual</label>
                                <input id="hargajual" name="hargajual" type="number" class="form-control" placeholder="Masukkan harga jual">
                            </div>
                        </div>
                    </div>
                    <p class="small text-danger">Harap isi data dengan lengkap.</p>
                    <div class="modal-footer no-bd">
                        <button type="button" data-type="simpan" id="addRowButton" class="btn btn-sm btn-primary">Simpan</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                    <input type="hidden" name="act" id="act">
                    <input type="hidden" name="key" id="key">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="DeleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah anda ingin menghapus <?= $title ?> ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-type="tutup" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" data-type="delete" data-user="" data-id="" class="btn btn-sm btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#add-row').DataTable();

    $('[data-type=simpan]').click(function() {
        var act = $('#modal_post #act').val();
        var key = $('#modal_post #key').val();
        if (act == "") {
            $('#modal_post #act').val('tambah');
        }
        $('#modal_post').submit();
    });

    $('[data-type=edit]').click(function() {
        var id = $(this).attr('data-id');
        Swal.showLoading();
        xhrfGetData("<?= site_url('master/getbarang/') ?>" + id, function(data) {
            var modal = $('#addRowModal');
            modal.find('#labelModal').html('Ubah Barang');
            modal.find('#idbarang').val(data.idbarang).attr('disabled', true);
            modal.find('#namabarang').val(data.namabarang);
            modal.find('#idkategori').val(data.idkategori);
            modal.find('#keterangan').val(data.keterangan);
            modal.find('#stok').val(data.stok);
            modal.find('#hargajual').val(data.hargajual);
            modal.find('#hargabeli').val(data.hargabeli);
            modal.find('#act').val('edit');
            modal.find('#key').val(data.idbarang);
            Swal.close();
            modal.modal();
        });
    });

    $('[data-type=tambah]').click(function() {
        var modal = $('#addRowModal');
        $('#modal_post')[0].reset();
        modal.find('#labelModal').html('Tambah <?= $title ?>');
        modal.find('#idbarang').attr('disabled', false);
        modal.modal();
    });

    $('[data-type=hapus]').click(function() {
        var id = $(this).attr('data-id');
        var iduser = $(this).attr('data-user');
        var modal = $('#DeleteModal');
        modal.find('[data-type=delete]').attr('data-id', id);
        modal.modal();
    });

    $('[data-type=delete]').click(function() {
        location.href = '<?= site_url('master/hapusBarang/') ?>' + $(this).attr('data-id');
    });
</script>