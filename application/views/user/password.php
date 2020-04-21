        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                </ol>
            </div>

            <div class="row mb-3">
                <div class="col-xl-8 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <?= $this->session->flashdata('message') ?>
                                    <form action="<?= base_url('user/gantipassword') ?>" method="POST">
                                        <div class="form-group">
                                            <label for="nama">Password sekarang</label>
                                            <input type="password" name="oldpassword" id="oldpassword" placeholder="Masukkan password sekarang" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpassword">Password baru</label>
                                            <input type="password" name="newpassword" id="newpassword" placeholder="Masukkan password baru" class="form-control" s>
                                        </div>
                                        <div class="form-group">
                                            <label for="newpasswordconf">Ulangi password</label>
                                            <input type="password" name="newpasswordconf" id="newpasswordconf" placeholder="Ulangi Password" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Ganti Password <i class="fa fa-key"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Row-->
        </div>
        <!---Container Fluid-->