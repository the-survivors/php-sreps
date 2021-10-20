<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

<style>
.user_logo {
    width: 60px;
    height: 60px;
}
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

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                                   
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <span class="mr-2 d-none d-lg-inline text-gray-800 font-weight-bold"><= $this->session->userdata['user_role']; ?></span> -->
                            <img class="rounded-circle user_logo" src="<?= base_url('assets/img/php-logo.png') ?>">
                    </a>
                    
                    <!-- Dropdown - Logout -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a onclick="logout()" style = "cursor: pointer;" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Log Out
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <script>
            function logout(){

            Swal.fire({
                text: 'Are you sure you want to Log Out?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Log Out'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo base_url('user/login/Auth/logout'); ?>";
                }
            })
            }
        </script>