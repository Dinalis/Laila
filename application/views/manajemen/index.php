<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('manajemen') ?>">Manajemen</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manajemen User</li>
        </ol>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                    <i class="fa fa-plus mr-1"></i>
                    Tambah <?= $title ?>
                </button>
            </div>
            <div class="mt-2">
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
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Dibuat pada</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($users_list as $u) : ?>
                                            <tr role="row" class="odd">
                                                <td><?= $i++; ?></td>
                                                <td><?= $u['nama']; ?></td>
                                                <td><?= $u['username']; ?></td>
                                                <td><?= $u['email']; ?></td>
                                                <td><?= $u['role']; ?></td>
                                                <td><?= date('d-m-Y h:i:s', $u['create_at']); ?></td>
                                                <td align="center">
                                                    <?php if ($u['iduser'] != $this->session->userdata('iduser')) : ?>
                                                        <a href="<?= base_url('manajemen/userstatus/') . $u['iduser'] . '/' . $u['status'] ?>" class="badge badge-<?= $u['status'] == 1 ? 'success' : 'danger' ?>"><?= $u['status'] == 1 ? 'Aktif' : 'Non-Aktif' ?></a>
                                                    <?php else : ?>
                                                        <small class="text-success">Aktif</small>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-type="edit" data-id="<?= $u['iduser']; ?>" class="badge badge-primary">
                                                            Edit
                                                        </button>
                                                        <?php if ($u['iduser'] != $this->session->userdata('iduser')) : ?>
                                                            <button type="button" data-type="hapus" data-id="<?= $u['iduser']; ?>" class="badge badge-danger">
                                                                Edit
                                                            </button>
                                                        <?php endif; ?>
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
                <form method="post" action="<?= base_url('master/pelanggan') ?>" id="modal_post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="isi nama" value="" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <option value="0">Laki-Laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control" placeholder="isi alamat" value="" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>No Telp</label>
                                <input id="telp" name="telp" type="text" class="form-control" placeholder="isi no telp" value="" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Info tambahan</label>
                                <input id="info" name="info" type="text" class="form-control" placeholder="isi info tambahan" value="" required>
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
        xhrfGetData("<?= site_url('master/getpelanggan/') ?>" + id, function(data) {
            var modal = $('#addRowModal');
            modal.find('#labelModal').html('Ubah <?= $title ?>');
            modal.find('#nama').val(data.nama);
            modal.find('#jk').val(data.jeniskelamin);
            modal.find('#alamat').val(data.alamat);
            modal.find('#telp').val(data.telp);
            modal.find('#info').val(data.infotambahan);
            modal.find('#act').val('edit');
            modal.find('#key').val(data.idpelanggan);
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
        location.href = '<?= site_url('master/hapusPelanggan/') ?>' + $(this).attr('data-id');
    });
</script>