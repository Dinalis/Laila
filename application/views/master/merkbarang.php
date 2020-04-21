<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('master') ?>">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </div>
    <div class="col-md-10 mt-3">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary btn-round ml-auto" data-type="tambah">
                    <i class="fa fa-plus mr-1"></i>
                    Tambah <?= $title ?>
                </button>
            </div>
            <div class="mt-2 mr-3 ml-3">
                <?= $this->session->flashdata('message') ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="add-row" class="display table table-hover table-head-bg-primary" role="grid" aria-describedby="add-row_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">#No</th>
                                            <th scope="col">Merk Barang</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($merk as $b) : ?>
                                            <tr role="row" class="odd">
                                                <td><?= $i++; ?></td>
                                                <td><?= $b['merk']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-type="edit" data-id="<?= $b['idmerk']; ?>" class="badge badge-primary">
                                                            Edit
                                                        </button>
                                                        <button type="button" data-type="hapus" data-id="<?= $b['idmerk']; ?>" class="badge badge-danger">
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
                <form method="post" action="<?= base_url('master/merkbarang') ?>" id="modal_post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Merk Barang</label>
                                <input id="merk" name="merk" type="text" class="form-control" placeholder="Masukkan merk barang" value="" required>
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
        xhrfGetData("<?= site_url('master/getMerk/') ?>" + id, function(data) {
            var modal = $('#addRowModal');
            modal.find('#labelModal').html('Ubah <?= $title ?>');
            modal.find('#merk').val(data.merk);
            modal.find('#act').val('edit');
            modal.find('#key').val(data.idmerk);
            Swal.close();
            modal.modal();
        });
    });

    $('[data-type=tambah]').click(function() {
        var modal = $('#addRowModal');
        $('#modal_post')[0].reset();
        modal.find('#labelModal').html('Tambah <?= $title ?>');
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
        location.href = '<?= site_url('master/hapusMerk/') ?>' + $(this).attr('data-id');
    });
</script>