<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<style>
    .nav-link {
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #4D252A !important;
    }

    .dropdown-item {
        color: white;
        font-size: 1.0rem;
        font-weight: 600;
    }

    .dropdown-item>hover {
        background: rgba(255, 255, 255, 0.1) !important;
        color: rgba(255, 237, 109, 1) !important;
    }

    #register_btn>hover {
        opacity: 0.90;
    }

    .navbar-nav>li>a {
        padding-top: 5px !important;
        padding-bottom: 5px !important;
    }

    .navbar {
        min-height: px !important
    }

    #nav_line {
        border: none;
        border-left: 1px solid hsla(200, 10%, 50%, 100);
        background-color: white;
        height: 5vh;
        width: 1px;
    }
</style>

<!-- Topbar -->
<nav class="navbar sticky-top navbar-expand topbar" style="background-color: #e56b6f;">

    <!-- Logo Image-->
    <!-- <nav class="navbar navbar-light bg-light">   -->
    <a class="navbar-brand py-0 " href="<?php echo base_url('external/homepage'); ?>">
        <img src="<?php echo base_url('assets/img/php_logo.png'); ?>" height="70" width="160" alt="">
    </a>
    <!-- </nav> -->

    <!-- Float left Group -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item px-2">
            <a class="nav-link <?php if ($selected == 'dashboard') echo 'active'; ?>" href="<?= base_url('users/Dashboard/Employee'); ?>">Dashboard</a>
        </li>

        <li class="nav-item px-2">
            <a class="nav-link <?php if ($selected == 'sales') echo 'active'; ?>" href="<?= base_url('sales/sales/'); ?>">Sales</a>
        </li>

        <li class="nav-item px-2">
            <a class="nav-link <?php if ($selected == 'items') echo 'active'; ?>" href="<?= base_url('items/Items/items_categories_log'); ?>">Items</a>
        </li>

        <li class="nav-item px-2">
            <a class="nav-link <?php if ($selected == 'stock') echo 'active'; ?>" href="<?= base_url('items/Items/items_low_on_stock'); ?>">Items Running Low on Stock</a>
        </li>

        <li class="nav-item px-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-secondary badge-counter text-dark" style="background-color: #FFF1F3;">3+</span>
            </a>

            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div class ="text-dark">
                        <div class="text-primary">Item Name 1</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div class="text-dark">
                        <div class="text-primary">Item Name 2</div>
                        $290.29 has been deposited into your account!
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div class="text-dark">
                        <div class="text-primary">Item Name 3</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>
        </li>

        <li class="nav-item pl-1">
            <a class="nav-link" onclick="logout()" ?>
                <button type="button" id="register_btn" class="btn" style="background-color: white; color: #e56b6f; font-size: 0.9em; border-radius:15px; font-weight: 800;"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</button>
            </a>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<script>
    function logout() {
        Swal.fire({
            text: 'Are you sure you want to Log Out?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Log Out'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('users/login/logout'); ?>";
            }
        })
    }
</script>