<div class="main-panel">
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-3">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold"><?= $title; ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"><?= $title ?></h4>
                    </div>
                </div>
                <div class="mt-2 ml-3 mr-3">
                    <?= $this->session->flashdata('message') ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <form action="<?= base_url('manajemen/gantipassword') ?>" method="post">
                                <div class="form-group">
                                    <label for="passwordlama">Password Lama</label>
                                    <input type="password" class="form-control" id="passwordlama" name="passwordlama" placeholder="Isi password lama" required>
                                    <small id="passwordlama" class="form-text text-muted">Pastikan password lama yang anda inputkan valid.</small>
                                </div>
                                <div class="form-group">
                                    <label for="passwordbaru">Password Baru</label>
                                    <input type="password" class="form-control" id="passwordbaru" name="passwordbaru" placeholder="isi password baru" required>
                                </div>
                                <div class="form-group">
                                    <label for="passwordbaru2">Ulangi Password</label>
                                    <input type="password" class="form-control" id="passwordbaru2" name="passwordbaru2" placeholder="ulangi password" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-key mr-2"></i> Ganti Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>