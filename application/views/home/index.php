        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>

            <div class="row mb-3">
                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h1>Selamat Datang <?= $users['nama']; ?></h1>
                            <h5>Sistem Informasi Penjualan</h5>
                        </div>
                    </div>
                </div>

                <?php if (!in_array($this->session->userdata('idrole'), array(2, 3))) : ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pendapatan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span>Per <?= date('d-M-Y') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Transaksi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_trx ?></div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span>Per <?= date('d-M-Y') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New User Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Jumlah User</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $count_user ?></div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span>Per <?= date('d-M-Y') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <!--Row-->

        </div>
        <!---Container Fluid-->