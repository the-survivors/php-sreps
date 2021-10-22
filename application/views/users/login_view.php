<!-- Set base url to javascript variable-->
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row (Start here)-->

                    <div class="limiter">
                        <div class="container-login100">
                            <div class="wrap-login100">
                                <div class="login100-pic js-tilt" data-tilt>
                                    <img src="<?=base_url('assets/img/logo-circle.png'); ?>" alt="IMG">
                                </div>

                                <form class="user" method="post" action=" <?=base_url('users/login/verify_users'); ?>">
                                    <span class="login100-form-title">
                                        PHP - SRePS
                                    </span>

                                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                                        <input class="input100" type="text" name="user_email" placeholder="Email" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                                        <input class="input100" type="password" name="user_password" placeholder="Password" required>
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>

                                    <div class="container-login100-form-btn">
                                        <button class="login100-form-btn">
                                            Login
                                        </button>
                                    </div>
                                    <br><br><br><br><br><br><br>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        $('.js-tilt').tilt({
                            scale: 1.1
                        })
                    </script>
                    <!-- /. Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
