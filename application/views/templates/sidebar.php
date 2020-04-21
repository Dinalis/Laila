<?php
$query = "SELECT * FROM access_menu JOIN user_role USING(idrole) JOIN menu USING(idmenu) WHERE idrole=" . $this->session->userdata('idrole');
$menu = $this->db->query($query)->result_array();
?>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('home') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/img/logo/poslogo.png') ?>">
        </div>
        <div class="sidebar-brand-text mx-3">Point Of Sales</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('home') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    <?php foreach ($menu as $m) : ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap<?= $m['idmenu'] ?>" aria-expanded="true" aria-controls="collapseBootstrap<?= $m['idmenu'] ?>">
                <i class="<?= $m['icon'] ?>"></i>
                <span><?= $m['menu']; ?></span>
            </a>
            <?php
            $query2 = "SELECT * FROM submenu WHERE idmenu=" . $m['idmenu'];
            $submenu = $this->db->query($query2)->result_array();
            ?>
            <div id="collapseBootstrap<?= $m['idmenu'] ?>" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header"><?= $m['menu'] ?></h6>
                    <?php foreach ($submenu as $sm) : ?>
                        <a class="collapse-item" href="<?= base_url($sm['url']) ?>"><?= $sm['submenu'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
<!-- Sidebar -->