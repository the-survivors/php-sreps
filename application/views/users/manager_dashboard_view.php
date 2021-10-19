<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/vendor/chart.js/Chart.min.js"></script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manager Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Card 1 - Sales -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="<?php echo base_url('internal/level_2/academic_counsellor/ac_course_applicants'); ?>" style="text-decoration:none">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body" href="">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Sales</div>
                                            <div id="sales_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <!-- Card 2 - Item -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <!-- <a href="<?php echo base_url('internal/level_2/academic_counsellor/ac_course_applicants'); ?>" style="text-decoration:none"> -->
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Item</div>
                                            <div id="items_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                         <!-- Card 3 - Total price of Latest Sales -->
                         <div class="col-xl-4 col-md-6 mb-4">
                            <!-- <a href="<?php echo base_url('internal/level_2/academic_counsellor/ac_course_applicants'); ?>" style="text-decoration:none"> -->
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Toda total sales</div>
                                            <div id="today_total_counter" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- End of Main Content -->

                <script>
                    var counter1 = <?= $total_sales ?>;
                    var counter2 = <?= $total_items ?>;
                    var counter3=<?= $total_latest_sales ?>;
                </script>