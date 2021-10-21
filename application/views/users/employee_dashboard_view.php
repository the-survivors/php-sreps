<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>

<script src="<?php echo base_url() ?>/assets/vendor/chart.js/Chart.min.js"></script>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" style="background-color: #fef2f2">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-xl-6 col-md-6">
                            <!-- Page Heading -->
                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h1 class="h3 mb-0 mt-4 text-gray-800">Dashboard</h1>
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-md-6">
                            <!-- Current Date & Time -->
                            <div class="align-baseline float-right">
                                <div class="mt-4" style="background-color:#1dd3b0; border-radius:10px; width:13.0em; height:auto;">
                                    <div class="px-1 py-auto mb-2">
                                        <h5 class="py-1" style="font-weight:600;">
                                            <span style="color:white;">
                                                <center>DATE: <?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d'); ?></center>
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Card 1 - Total Sales -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href = "" style = "text-decoration:none">
                                <div class="card border-left-success shadow h-100 py-2" style="background-color: #c5e9d2 ">
                                    <div class="card-body" href="">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Sales</div>
                                                <div id="" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <i class="fas fa-hand-holding-usd fa-2x" style="color: #40916c"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Card 2 - Total Items -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href = "" style = "text-decoration:none">
                                <div class="card border-left-primary shadow h-100 py-2" style="background-color: #bbdefb">
                                    <div class="card-body" href="">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Items</div>
                                                <div id="" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <i class="fas fa-prescription-bottle-alt fa-2x" style="color: #1565c0"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!--Card 3 - Items Running Low on Stock -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href = "" style = "text-decoration:none">
                                <div class="card border-left-danger shadow h-100 py-2" style="background-color: #f9bec7">
                                    <div class="card-body" href="">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Items Running Low on Stock</div>
                                                <div id="" class="h5 mb-0 font-weight-bold text-gray-800 counting_number">0</div>
                                            </div>
                                            
                                            <div class="col-auto">
                                                <i class="fas fa-cart-arrow-down fa-2x" style="color: #ff0a54"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Chart -->
                    <div class="row mb-4">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card h-100 shadow mb-4">
                                <div class="card-header py-3" style="background-color: #e4c2c1">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Items By Category</div>
                            </div>
                            
                            <div class="card-body">
                                <div class="chart-bar">
                                    <canvas id=""></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>