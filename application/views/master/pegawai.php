<div class="container-fluid mb-3" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('master') ?>">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
        </ol>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary btn-round ml-auto mt-2" data-type="tambah">
                    <i class="fa fa-plus mr-1"></i>
                    Tambah <?= $title ?>
                </button>
            </div>
            <div class="mt-2 mr-3 ml-3">
                <?= $this->session->flashdata('message') ?>
            </div>
            <?php
            function jeniskelamin($val)
            {
                if ($val > 0) {
                    return 'Perempuan';
                } else {
                    return 'Laki - Laki';
                }
            } ?>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="add-row" class="display table table-hover table-head-bg-primary" role="grid" aria-describedby="add-row_info">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID Pegawai</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Posisi</th>
                                            <th scope="col">No Telp</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pegawai as $b) : ?>
                                            <tr role="row" class="odd">
                                                <td><?= $b['idpegawai']; ?></td>
                                                <td><?= $b['namapegawai']; ?></td>
                                                <td><?= jeniskelamin($b['jeniskelamin']); ?></td>
                                                <td><?= $b['role']; ?></td>
                                                <td><?= $b['telp']; ?></td>
                                                <td><?= $b['alamat']; ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" title="" data-type="edit" data-id="<?= $b['idpegawai']; ?>" class="badge badge-primary">
                                                            Edit
                                                        </button>
                                                        <button type="button" title="" data-type="hapus" data-id="<?= $b['idpegawai']; ?>" class="badge badge-danger">
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
                <form method="post" action="<?= base_url('master/pegawai') ?>" id="modal_post">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>ID Pegawai</label>
                                <input id="idpegawai" name="idpegawai" type="text" class="form-control" placeholder="isi id pegawai">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="isi nama" value="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control" required>
                                    <option value="0">Laki-Laki</option>
                                    <option value="1">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Tgl lahir</label>
                                <input id="ttl" name="ttl" type="date" class="form-control" placeholder="isi ttl">
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="isi email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>No Telp</label>
                                <input id="telp" name="telp" type="number" class="form-control" placeholder="isi Alamat">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control" placeholder="isi Alamat">
                            </div>
                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="form-group form-group-default">
                                <label>Posisi</label>
                                <select name="idrole" id="idrole" class="form-control" required>
                                    <?php foreach ($role as $r) : ?>
                                        <option value="<?= $r['idrole'] ?>"><?= $r['role'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default">
                                <label>Pendidikan terakhir</label>
                                <select name="idpendidikan" id="idpendidikan" class="form-control" required>
                                    <?php foreach ($pendidikan as $pd) : ?>
                                        <option value="<?= $pd['idpendidikan'] ?>"><?= $pd['pendidikan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
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
        xhrfGetData("<?= site_url('master/getpegawai/') ?>" + id, function(data) {
            var modal = $('#addRowModal');
            modal.find('#labelModal').html('Ubah <?= $title ?>');
            modal.find('#idpegawai').val(data.idpegawai).attr('disabled', true);
            modal.find('#nama').val(data.namapegawai);
            modal.find('#jk').val(data.jeniskelamin);
            modal.find('#alamat').val(data.alamat);
            modal.find('#idrole').val(data.idrole);
            modal.find('#ttl').val(data.ttl);
            modal.find('#email').val(data.email);
            modal.find('#telp').val(data.telp);
            modal.find('#idpendidikan').val(data.idpendidikan);
            modal.find('#act').val('edit');
            modal.find('#key').val(data.idpegawai);
            Swal.close();
            modal.modal();
        });
    });

    $('[data-type=tambah]').click(function() {
        var modal = $('#addRowModal');
        $('#modal_post')[0].reset();
        modal.find('#labelModal').html('Tambah <?= $title ?>');
        modal.find('#idpegawai').attr('disabled', false);
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
        location.href = '<?= site_url('master/hapusPegawai/') ?>' + $(this).attr('data-id');
    });
</script>