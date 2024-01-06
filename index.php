<!-- Header -->
<?php 
require_once 'themeplates/header.php'; 
session_start(); 

if(!isset($_SESSION['id_user'])) {
  header("Location: login.php");
  exit;
}

?>

<!-- /Header -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Rental Mobil HAARIS </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity Log</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Sidebar -->
            <?php require_once 'themeplates/sidebar.php'; ?>
            <!-- /Sidebar -->
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                <!-- <pre><?= var_dump($_SESSION); ?></pre> -->
                    <!-- Content -->
                    <?php require_once 'themeplates/content.php'; ?>
                    <!-- /Content -->
                </div>
            </main>

<!-- Footer -->
<?php require_once 'themeplates/footer.php'; ?>
<!-- /Footer -->
