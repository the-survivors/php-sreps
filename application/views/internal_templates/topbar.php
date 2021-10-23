<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<style>
    #nav_line {
        border: none;
        border-left: 1px solid hsla(200, 10%, 50%, 100);
        background-color: grey;
        height: auto;
        width: 1px;
        margin-left: 4px;
    }
</style>

<!-- <php $user_role = $this->session->userdata['user_role'];?> -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: #E4C2C1;">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <a class="navbar-brand py-0">
            <img src="<?php echo base_url('assets/img/php_logo.png'); ?>" height="70" width="160" alt="">
        </a>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
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